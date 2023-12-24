<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取 POST 请求参数
    $goods_id = $_POST['goods_id'];
    $goods_name = $_POST['goods_name'];
    $goods_description = $_POST['goods_description'];

    // 验证参数是否为空
    if (empty($goods_id) || empty($goods_name) || empty($goods_description) || empty($_FILES['goods_pic']) || empty($_FILES['goods_information_pic'])) {
        // 参数不完整，返回错误信息
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Incomplete parameters'));
        exit;
    }

    require_once 'db_connect.php';

    // 处理商品图片
    $goods_pic = handleUploadedFile($_FILES['goods_pic']);
    if (!$goods_pic) {
        // 图片处理失败，返回错误信息
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Failed to process goods picture'));
        exit;
    }

    // 处理商品信息图片
    $goods_information_pic = handleUploadedFile($_FILES['goods_information_pic']);
    if (!$goods_information_pic) {
        // 图片处理失败，返回错误信息
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Failed to process goods information picture'));
        exit;
    }

    // 插入商品到 goods 表
    $query = "INSERT INTO goods (goods_id, goods_name, goods_description, goods_pic, goods_information_pic) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssss', $goods_id, $goods_name, $goods_description, $goods_pic, $goods_information_pic);
    $stmt->execute();
    $stmt->close();

    // 返回成功信息
    header('Content-Type: application/json');
    echo json_encode(array('success' => 'Product added successfully'));
} else {
    // 请求方法不正确，返回错误信息
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method'));
}

// 处理上传的文件并重命名保存到指定文件夹
function handleUploadedFile($file)
{
    // 验证文件上传是否成功
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    // 获取文件信息
    $file_tmp = $file['tmp_name'];
    $file_type = $file['type'];

    // 验证文件类型是否为图片
    $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
    if (!in_array($file_type, $allowed_types)) {
        return false;
    }

    // 生成新的文件名
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $new_filename = time() . '-' . uniqid() . '.' . $extension;

    // 设置文件保存路径
    $destination = './img/' . $new_filename;

    // 将上传的文件移动到指定位置
    if (move_uploaded_file($file_tmp, $destination)) {
        return $destination; // 返回文件路径
    } else {
        return false;
    }
}