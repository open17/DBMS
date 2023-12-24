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

    // 查询购物车的总价
    $query = "SELECT total_price FROM cart WHERE cart_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $cart_id);
    $stmt->execute();
    $stmt->bind_result($total_price);
    $stmt->fetch();
    $stmt->close();

    // 生成订单（假设为自增的订单号）
    $order_id = generateOrderId(); // 自定义函数生成订单号
    $order_date = date('Y-m-d'); // 获取当前日期
    $payment = $total_price; // 使用购物车的总价作为支付金额

    // 在订单表中插入订单记录
    $query = "INSERT INTO orders (order_id, order_date, payment, cart_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssss', $order_id, $order_date, $payment, $cart_id);
    $stmt->execute();
    $stmt->close();

    // 返回订单信息
    header('Content-Type: application/json');
    echo json_encode(array('order_id' => $order_id, 'order_date' => $order_date, 'payment' => $payment, 'cart_id' => $cart_id));
} else {
    // 请求方法不正确，返回错误信息
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method'));
}


function generateOrderId()
{
    $timestamp = time();  // 获取当前的时间戳
    $uuid = uniqid();  // 生成UUID
    $id = $timestamp. "" .$uuid;
    return $id;
}