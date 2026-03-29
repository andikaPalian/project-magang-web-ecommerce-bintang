<?php

declare(strict_types=1);
class AuthController extends Controller
{
  public function index(): void
  {
    if (isset($_SESSION['user_id'])) {
      $this->redirectBasedOnRole($_SESSION['role']);
    }

    $data['judul'] = 'Login | TI MART';

    $data['error'] = $_SESSION['flash_error'] ?? null;
    $data['success'] = $_SESSION['flash_success'] ?? null;
    unset($_SESSION['flash_error'], $_SESSION['flash_success']);

    $this->view('templates/header', $data);
    $this->view('auth/login', $data);
  }

  public function authenticate(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'] ?? '';
      $password = $_POST['password'] ?? '';

      $user = $this->model('UserModel')->getUserByEmail($email);

      if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['location_id'] = $user['location_id'] ?? null;

        $this->redirectBasedOnRole($user['role']);
      } else {
        $this->sendResponse('error', 'Email atau password salah.', '/auth', 401);
      }
    }
  }

  public function redirectBasedOnRole(string $role): void
  {
    $dashboardUrl = match ($role) {
      'pembeli'    => '/home',
      'admin_toko' => '/admintoko/dashboard',
      'gudang'     => '/gudang/dashboard',
      'ekspedisi'  => '/ekspedisi/dashboard',
      'admin_web'  => '/adminweb/dashboard',
      'pemilik'    => '/pemilik/dashboard',
      default      => '/auth/logout'
    };

    header('Location: ' . BASEURL . $dashboardUrl);
    exit;
  }

  public function register(): void
  {
    if (isset($_SESSION['user_id'])) {
      $this->redirectBasedOnRole($_SESSION['role']);
    }

    $data['judul'] = 'Register | TI MART';
    $data['error'] = $_SESSION['flash_error'] ?? null;
    unset($_SESSION['flash_error']);

    $this->view('templates/header', $data);
    $this->view('auth/register', $data);
  }

  public function storeRegistration(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = htmlspecialchars(trim($_POST['name'] ?? ''), ENT_QUOTES);
      $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
      $phone = htmlspecialchars(trim($_POST['phone'] ?? ''), ENT_QUOTES);
      $password = $_POST['password'] ?? '';
      $password_confirmation = $_POST['password_confirmation'] ?? '';

      if (empty($name) || empty($email) || empty($password)) {
        $this->sendResponse('error', 'Semua kolom wajib diisi!', '/auth/register', 400);
      }

      if ($password != $password_confirmation) {
        $this->sendResponse('error', 'Password tidak sama!', '/auth/register', 400);
      }

      if ($this->model('UserModel')->getUserByEmail($email)) {
        $this->sendResponse('error', 'Email sudah terdaftar, silahkan gunakan email lain!', '/auth/register', 400);
      }

      $data = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        // 'role' => 'pembeli'
      ];

      if ($this->model('UserModel')->registerUser($data) > 0) {
        $this->sendResponse('success', 'Registrasi berhasil! Silahkan login.', '/auth', 200);
      } else {
        $this->sendResponse('error', 'Registrasi gagal!', '/auth/register', 500);
      }
    }
  }

  public function logout(): void
  {
    session_unset();
    session_destroy();
    session_start();

    $this->sendResponse('success', 'Anda berhasil logout!', '/auth', 200);
  }
}
