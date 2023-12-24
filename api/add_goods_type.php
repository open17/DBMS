<?php
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取 POST 请求参数
    $goods_type_id = $_POST['goods_type_id'];
    $goods_id = $_POST['goods_id'];
    $goods_type_name = $_POST['goods_type_name'];
    $price = $_POST['price'];

    // 验证参数是否为空
    if (empty($goods_type_id) || empty($goods_id) || empty($goods_type_name) || empty($price)) {
        // 参数不完整，返回错误信息
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Incomplete parameters'));
        exit;
    }

    require_once 'db_connect.php';

    // 插入商品类型到 goods_type 表
    $query = "INSERT INTO goods_type (goods_type_id, goods_id, goods_type_name, price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssd', $goods_type_id, $goods_id, $goods_type_name, $price);
    $stmt->execute();
    $stmt->close();

    // 返回成功信息
    header('Content-Type: application/json');
    echo json_encode(array('success' => 'Product type added successfully'));
} else {
    // 请求方法不正确，返回错误信息
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method'));
}