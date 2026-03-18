<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $data['judul'] ?? 'Dashboard | TI MART'; ?></title>

  <link href="<?= BASEURL; ?>/css/style.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }

    ::-webkit-scrollbar {
      width: 10px;
      height: 10px;
    }

    ::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-left: 2px solid #000;
    }

    ::-webkit-scrollbar-thumb {
      background: #000;
      border: 2px solid #000;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #FF5757;
    }
  </style>
</head>

<body class="bg-[#F8F9FA] text-black overflow-hidden selection:bg-[#FFE600] selection:text-black"></body>