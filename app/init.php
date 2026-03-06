<?php
require_once 'config/config.php';
require_once 'config/database.php';

spl_autoload_register(function (string $className) {
  $file = '../app/core/' . $className . '.php';
  if (file_exists($file)) {
    require_once $file;
  }
});
