<?php
class AuthController extends Controller
{
  public function index(): void
  {
    if (isset($_SESSION['user_id'])) {
      $this->redirectBasedOnRole($_SESSION['role']);
    }

    $data['judul'] = 'Login | Ecommerce Bintang';

    $data['error'] = $_SESSION['login_error'] ?? null;
    unset($_SESSION['login_error']);

    $this->view('auth//login' . $data);
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

        $this->redirectBasedOnRole($user['role']);
      } else {
        $_SESSION['login_error'] = 'Email atau password salah';
        header('Location: ' . BASEURL . '/auth');
        exit;
      }
    }
  }

  public function redirectBasedOnRole(string $role): void
  {
    $dashboardUrl = match ($role) {
      'pembeli'    => '/home',
      'admin_toko' => '/admin_toko/dashboard',
      'gudang'     => '/gudang/dashboard',
      'ekspedisi'  => '/ekspedisi/dashboard',
      'admin_web'  => '/admin_web/dashboard',
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

    $data['judul'] = 'Register | Ecommerce Bintang';
    $data['error'] = $_SESSION['register_error'] ?? null;
    unset($$_SESSION['register_error']);

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
        $_SESSION['flash_error'] = 'Semua kolom wajib diisi!';
        header('Location: ' . BASEURL . '/auth/register');
        exit;
      }

      if ($password != $password_confirmation) {
        $_SESSION['flash_error'] = 'Password tidak sama!';
        header('Location: ' . BASEURL . '/auth/register');
        exit;
      }

      if ($this->model('UserModel')->getUserByEmail($email)) {
        $_SESSION['flash_error'] = 'Email sudah terdaftar!';
        header('Location: ' . BASEURL . '/auth/register');
        exit;
      }

      $data = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        // 'role' => 'pembeli'
      ];

      if ($this->model('UserModel')->registerUser($data) > 0) {
        $_SESSION['flash_success'] = 'Registrasi berhasil!';
        header('Location: ' . BASEURL . '/auth');
        exit;
      } else {
        $_SESSION['flash_error'] = 'Registrasi gagal!';
        header('Location: ' . BASEURL . '/auth/register');
        exit;
      }
    }
  }

  public function logout(): void
  {
    session_unset();
    session_destroy();
    header('Location: ' . BASEURL . '/auth');
    exit;
  }
}
