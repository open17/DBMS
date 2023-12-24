<?php
    // 设置响应头为 JSON 类型
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // 获取 GET 请求参数
    $goods_type_id = $_GET['goods_type_id'];
    $buyer_id = $_GET['buyer_id'];

    // 验证参数是否为空
    if (empty($goods_type_id) || empty($buyer_id)) {
        // 参数不完整，返回错误信息
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Incomplete parameters'));
        exit;
    }

    // 连接数据库
    require_once 'db_connect.php';
    // 设置响应头为 JSON 类型
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');

    // 查询购物车 ID
    $query = "SELECT cart_id FROM buyer WHERE buyer_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $buyer_id);
    $stmt->execute();
    $stmt->bind_result($cart_id);
    $stmt->fetch();
    $stmt->close();

    // 将商品类型 ID 插入购物车
    $query = "INSERT INTO cart_contain_goods_type (cart_id, goods_type_id) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $cart_id, $goods_type_id);
    $stmt->execute();
    $stmt->close();

    // 添加商品到购物车成功
    header('Content-Type: application/json');
    echo json_encode(array('success' => 'Goods added to cart'));
} else {
    // 请求方法不正确，返回错误信息
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method'));
}