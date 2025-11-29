<?php 
require __DIR__.'/../config/database.php';

$config = require __DIR__.'/../config/config.php';

define('BASE_PATH', $config['base_url']);
define('RESOURCES_PATH', $config['resources_url']);

function view($template, $data=[]) {
    extract($data);
    $viewsPath = __DIR__.'/../views/';
    $layoutPath = $viewsPath . 'layouts/';
    
    require $layoutPath. 'header.php';
    
    require $viewsPath. $template. '.php';
    
    require $layoutPath. 'footer.php';
    return true;
}

function viewWithoutLayout($template, $data=[]) {
    extract($data);
    $viewsPath = __DIR__.'/../views/';
    
    require $viewsPath. $template. '.php';
    return true;
}

function redirect($path) {
    header('Location: '.BASE_PATH.$path);
    exit;
}

function uploadImage($file, $folder) {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $uploadDir = __DIR__ . "/../../public/resources/$folder/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $originalName = $file['name'];
    $extension = pathinfo($originalName, PATHINFO_EXTENSION);

    $imageName = uniqid($folder . '_') . '.' . $extension;

    $tmpPath = $file['tmp_name'];
    move_uploaded_file($tmpPath, $uploadDir . $imageName);

    return $imageName;
}
function deleteImage($folder, $filename)
{
    $path = __DIR__ . "/../../public/resources/$folder/$filename";

    if ($filename && file_exists($path)) {
        unlink($path);
    }
}

function transformImageArray($images) {
    $imageArray = [];
    foreach ($images['name'] as $key => $name) {
        $imageArray[] = [
            'name' => $name,
            'full_path' => $images['full_path'][$key],
            'type' => $images['type'][$key],
            'tmp_name' => $images['tmp_name'][$key],
            'error' => $images['error'][$key],
            'size' => $images['size'][$key]
        ];
    }
    return $imageArray;
}

function isAuth() {
    return isset($_SESSION['user_id']);
}

function requireAuth() {
    if (!isAuth()) {
        redirect('login');
    }
}