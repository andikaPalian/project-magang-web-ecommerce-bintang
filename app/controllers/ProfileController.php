<?php

declare(strict_types=1);
class ProfileController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $this->sendResponse('error', 'Silahkan login terlebih dahulu!', '/auth', 401);
    }
  }

  public function index(): void
  {
    $data['judul'] = 'Profile | TI MART';
    $data['user'] = $this->model("UserModel")->getUserById($_SESSION['user_id']);

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/profile', $data);
    $this->view('templates/footer', $data);
  }

  public function update(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $data = [
        'id' => $_SESSION['user_id'],
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'address' => $_POST['address'] ?? ''
      ];

      $this->model('UserModel')->updateProfile($data);

      $_SESSION['name'] = htmlspecialchars($data['name']);

      $this->sendResponse('success', 'Profile berhasil diperbarui!', '/profile', 200, [
        'new_name' => $_SESSION['name']
      ]);
    }
  }
}
