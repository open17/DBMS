<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Content-Type");
// 设置图片保存目录（相对路径）
$uploadDirectory = "./img/";

// 检查是否有文件上传错误
if ($_FILES["file"]["error"] !== UPLOAD_ERR_OK) {
    echo json_encode(["success" => false, "message" => "upload failed"]);
    exit;
}

// 获取上传的文件名
$filename = $_FILES["file"]["name"];

// 生成唯一的文件名（包含时间戳）
$uniqueFilename = uniqid() . "_" . time() . "_" . $filename;

// 构建目标路径
$targetPath = $uploadDirectory . $uniqueFilename;

// 移动上传的文件到目标路径
if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath)) {
    echo json_encode(["success" => true, "filename" => $uniqueFilename]);
} else {
    echo json_encode(["success" => false, "message" => "save file"]);
}

?>