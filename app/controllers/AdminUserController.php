<?php

declare(strict_types=1);
class AdminUserController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $this->sendResponse('error', 'Silahkan login terlebih dahulu!', '/auth', 401);
    }

    if ($_SESSION['role'] !== 'admin_web') {
      $this->sendResponse('error', 'Anda tidak memiliki akses ke halaman ini!', '', 403);
    }
  }

  public function index(): void
  {
    $data['judul'] = 'User management | TI MART';
    $data['users'] = $this->model('UserModel')->getAllUsers($_SESSION['user_id']);
    $data['locations'] = $this->model('UserModel')->getAllLocations();

    $totalUsers = count($data['users']) + 1;
    $activeStaff = 1;
    $newUserThisMonth = 0;

    $currentMonth = date('m');
    $currentYear = date('Y');

    foreach ($data['users'] as $user) {
      if ($user['role'] !== 'pembeli') {
        $activeStaff++;
      }

      $userMonth = date('m', strtotime($user['created_at']));
      $userYear = date('Y', strtotime($user['created_at']));

      if ($userMonth === $currentMonth && $userYear === $currentYear) {
        $newUserThisMonth++;
      }
    }

    $data['stats'] = [
      'total_users' => $totalUsers,
      'active_staff' => $activeStaff,
      'new_user_this_month' => $newUserThisMonth
    ];

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('admin_web/users', $data);
    $this->view('templates/footer_admin', $data);
  }

  public function storeUser(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (!isset($_POST['location_id']) || $_POST['location_id'] === '') {
        $_POST['location_id'] = null;
      }

      if ($this->model('UserModel')->addUserByAdmin($_POST) > 0) {
        $this->sendResponse('success', 'User berhasil ditambahkan!', '/adminuser', 200);
      } else {
        $this->sendResponse('error', 'Gagal menambahkan user!', '/adminuser', 400);
      }
    }
  }

  public function updateUser(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = (int) $_POST['id'];

      if (!isset($_POST['address'])) {
        $_POST['address'] = '-';
      }

      if (!isset($_POST['location_id']) || $_POST['location_id'] === '') {
        $_POST['location_id'] = null;
      }

      if ($id == $_SESSION['user_id']) {
        $this->sendResponse('error', 'Anda tidak dapat mengedit diri sendiri!', '/adminuser', 400);
      }

      if ($this->model('UserModel')->updateUserByAdmin($_POST, $id) >= 0) {
        $this->sendResponse('success', 'Data user berhasil diperbarui!', '/adminuser', 200);
      } else {
        $this->sendResponse('error', 'Tidak ada perubahan atau gagal memperbarui data user.', '/adminuser', 400);
      }
    }
  }

  public function deleteUser(string $id): void
  {
    if ($id == $_SESSION['user_id']) {
      $this->sendResponse('error', 'Anda tidak dapat menghapus diri sendiri!', '/adminuser', 400);
    }

    if ($this->model('UserModel')->deleteUser($id) > 0) {
      $this->sendResponse('success', 'User berhasil dihapus!', '/adminuser', 200);
    } else {
      $this->sendResponse('error', 'Gagal menghapus user!', '/adminuser', 400);
    }
  }
}
