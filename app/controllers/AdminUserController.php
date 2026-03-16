<?php

declare(strict_types=1);
class AdminUserController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      header('Location: ' . BASEURL . '/auth');
      exit;
    }

    if ($_SESSION['role'] !== 'admin_web') {
      header('Location: ' . BASEURL);
      exit;
    }
  }

  public function index(): void
  {
    $user_id = $_SESSION['user_id'];
    $data['judul'] = 'User management | TI MART';
    $data['users'] = $this->model('UserModel')->getAllUsers($user_id);

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('admin_web/users', $data);
    $this->view('templates/footer_admin', $data);
  }

  public function storeUser(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if ($this->model('UserModel')->addUserByAdmin($_POST) > 0) {
        header('Location: ' . BASEURL . '/adminuser');
        exit;
      } else {
        header('Location: ' . BASEURL . '/adminuser');
        exit;
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

      if ($id == $_SESSION['user_id']) {
        header('Location: ' . BASEURL . '/adminuser');
        exit;
      }

      if ($this->model('UserModel')->updateUserByAdmin($_POST, $id) >= 0) {
        header('Location: ' . BASEURL . '/adminuser');
        exit;
      }
    }
  }

  public function deleteUser(string $id): void
  {
    if ($id == $_SESSION['user_id']) {
      header('Location: ' . BASEURL . '/adminuser');
      exit;
    }

    if ($this->model('UserModel')->deleteUser($id) > 0) {
      header('Location: ' . BASEURL . '/adminuser');
      exit;
    } else {
      header('Location: ' . BASEURL . '/adminuser');
      exit;
    }
  }
}
