<?php
class Helper
{
  public static function createSlug(string $string): string
  {
    $slug = strtolower(trim($string));
    $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
    $slug = $slug . '-' . substr(uniqid(), -5);

    return $slug;
  }

  public static function uploadImage(array $fileData, string $targetFolder): string|false
  {
    $fileName = $fileData['name'];
    $fileSize = $fileData['size'];
    $tmpName = $fileData['tmp_name'];

    $ext = ['jpg', 'jpeg', 'png', 'webp'];
    $fileExt = explode('.', $fileName);
    $fileExt = strtolower(end($fileExt));

    if (!in_array($fileExt, $ext)) {
      return false;
    }

    if ($fileSize > 5242880) {
      return false;
    }

    $newFileName = uniqid() . '.' . $fileExt;

    $destination = dirname(__DIR__, 2) . '/public/img/' . $targetFolder . '/';

    if (!is_dir($destination)) {
      mkdir($destination, 0777, true);
    }

    move_uploaded_file($tmpName, $destination . $newFileName);

    return $newFileName;
  }
}
