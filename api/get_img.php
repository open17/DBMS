<?php
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
$file = isset($_GET['file']) ? $_GET['file'] : '';
$file = './img/' . $file;

if (empty($file)) {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'File path is missing'));
    exit;
}

if (!file_exists($file)) {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'File not found'));
    exit;
}

header('Content-Type: image/jpeg');
readfile($file);
?>