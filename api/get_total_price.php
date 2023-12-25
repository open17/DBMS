<?php
// 设置响应头为 JSON 类型
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // 获取 GET 请求参数
    $buyer_id = $_GET['buyer_id'];

    // 验证参数是否为空
    if (empty($buyer_id)) {
        // 参数不完整，返回错误信息
        echo json_encode(array('error' => 'Incomplete parameters'));
        exit;
    }

    // 连接数据库
    require_once 'db_connect.php';

    // 查询购物车信息
    $query = "SELECT c.cart_id, c.total_price FROM buyer AS b
              INNER JOIN cart AS c ON b.cart_id = c.cart_id
              WHERE b.buyer_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $buyer_id);
    $stmt->execute();
    $stmt->bind_result($cart_id, $total_price);
    
    // 检查是否找到匹配的购物车信息
    if ($stmt->fetch()) {
        // 返回购物车信息
        echo json_encode(array('cart_id' => $cart_id, 'total_price' => $total_price));
    } else {
        // 未找到匹配的购物车信息
        echo json_encode(array('error' => 'Cart not found'));
    }

    $stmt->close();
} else {
    // 请求方法不正确，返回错误信息
    echo json_encode(array('error' => 'Invalid request method'));
}
?>