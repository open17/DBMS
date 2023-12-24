<?php
// 获取文件路径参数
$file = isset($_GET['file']) ? $_GET['file'] : '';
$file='./img/'.$file;
// 验证文件路径是否为空
if (empty($file)) {
    // 文件路径为空，返回错误信息
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'File path is missing'));
    exit;
}

// 验证文件是否存在
if (!file_exists($file)) {
    // 文件不存在，返回错误信息
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'File not found'));
    exit;
}

// 读取文件内容为二进制数据
$fileData = file_get_contents($file);

// 将二进制数据转换为 Base64 编码
$base64Data = base64_encode($fileData);

// 构造返回的 JSON 数据
$response = array(
    'data' => $base64Data,
);

// 设置响应头为 JSON 类型
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
// 输出 JSON
echo json_encode($response);
?>