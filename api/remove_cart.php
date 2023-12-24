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

    // 删除购物车商品
    $query = "DELETE FROM cart_contain_goods_type WHERE goods_type_id = ? AND cart_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $goods_type_id, $cart_id);
    $stmt->execute();
    $stmt->close();

    // 删除购物车商品成功，触发器会自动更新购物车总价

    // 返回成功信息
    header('Content-Type: application/json');
    echo json_encode(array('success' => 'Goods removed from cart'));
} else {
    // 请求方法不正确，返回错误信息
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method'));
}