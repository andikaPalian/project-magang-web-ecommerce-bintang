<?php

declare(strict_types=1);
class ProfileController extends Controller
{
  private function isAjax(): bool
  {
    return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);
  }

  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $_SESSION['flash_error'] = 'Silahkan login terlebih dahulu!';
      header('Location: ' . BASEURL . '/auth');
      exit;
    }
  }

  public function index(): void
  {
    $user_id = $_SESSION['user_id'];

    $data['judul'] = 'Profile | TI MART';
    $data['user'] = $this->model("UserModel")->getUserById($user_id);

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/profile', $data);
    $this->view('templates/footer', $data);
  }

  public function update(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user_id = $_SESSION['user_id'];

      $data = [
        'id' => $user_id,
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'address' => $_POST['address'] ?? ''
      ];

      $this->model('UserModel')->updateProfile($data);

      $_SESSION['name'] = htmlspecialchars($data['name']);

      $is_ajax = $this->isAjax();
      if ($is_ajax) {
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode([
          'status' => 'success',
          'message' => 'Profile berhasil diperbarui!',
          'new_name' => $_SESSION['name']
        ]);
        exit;
      }

      $_SESSION['flash_success'] = 'Profile berhasil diperbarui!';
      header('Location: ' . BASEURL . '/profile');
      exit;
    }
  }
}
