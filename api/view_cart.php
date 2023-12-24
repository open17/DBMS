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

    // 查询购物车中的商品类型
    $query = "SELECT goods_type_id FROM cart_contain_goods_type WHERE cart_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $cart_id);
    $stmt->execute();
    $stmt->bind_result($goods_type_id);
    $goods = array();
    while ($stmt->fetch()) {
        $goods[] = $goods_type_id;
    }
    $stmt->close();

    // 查询商品信息和购物车总价
    $query = "SELECT goods_type_name, price FROM goods_type WHERE goods_type_id = ?";
    $total_price = 0;
    $cart_items = array();
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $goods_type_id);
    foreach ($goods as $goods_type_id) {
        $stmt->execute();
        $stmt->bind_result($goods_type_name, $price);
        $stmt->fetch();
 

        $cart_items[] = array(
            'goods_type_id' => $goods_type_id,
            'goods_type_name' => $goods_type_name,
            'price' => $price
        );

        $total_price += $price;
    }
    $stmt->close();
    // 返回购物车信息
    header('Content-Type: application/json');
    echo json_encode(array('cart_items' => $cart_items, 'total_price' => $total_price));
} else {
    // 请求方法不正确，返回错误信息
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method'));
}