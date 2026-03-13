<?php

declare(strict_types=1);
class AboutUsController extends Controller
{
  public function index(): void
  {
    $data['judul'] = 'About Us | TI MART';

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/aboutUs', $data);
    $this->view('templates/footer', $data);
  }
}
