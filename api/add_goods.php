<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");
require_once 'db_connect.php';

// 生成商品ID
$goodsId = time() . uniqid();

// 获取 POST 请求的商品数据
$goods = json_decode(file_get_contents("php://input"), true);

// 插入商品数据到 goods 表
$sql = "INSERT INTO goods (goods_id, goods_name, goods_description, goods_pic, goods_information_pic)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssss",
    $goodsId,
    $goods['goods_name'],
    $goods['goods_description'],
    $goods['goods_pic'],
    $goods['goods_information_pic']
);

if ($stmt->execute()) {
    // 商品数据插入成功，插入商品类型数据到 goods_type 表
    $goodsTypes = $goods['types'];
    foreach ($goodsTypes as $type) {
        $typeId = time() . uniqid();
        $stmt = $conn->prepare("INSERT INTO goods_type (goods_type_id, goods_id, goods_type_name, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssd", $typeId, $goodsId, $type['name'], $type['price']);
        $stmt->execute();
    }

    // 返回成功响应给前端
    echo json_encode(["success" => true]);
} else {
    // 返回失败响应给前端
    echo json_encode(["success" => false]);
}

$stmt->close();
$conn->close();
?>