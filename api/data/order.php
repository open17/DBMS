<?php
set_time_limit(0);
require_once '../db_connect.php';


// 获取购物车数据
$query = "SELECT cart_id FROM cart";
$result = $conn->query($query);
// 循环遍历购物车
while ($row = $result->fetch_assoc()) {
    $cart_id = $row['cart_id'];
    // 生成多个订单
    $numOrders = rand(8,10); // 生成2到5个订单
    for ($i = 0; $i < $numOrders; $i++) {
        // 生成随机订单数据
        $orderData = generateRandomOrderData();
        // 插入订单数据
        $query = "INSERT INTO orders (order_id, order_date, payment, cart_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssss', $orderData['order_id'], $orderData['order_date'], $orderData['payment'], $cart_id);
        $stmt->execute();
        $stmt->close();
    }
}

// 关闭数据库连接
$conn->close();

// 生成随机订单数据
function generateRandomOrderData()
{
    $order_id = generateRandomOrderId();
    $order_date = generateRandomOrderDate();
    $payment = generateRandomPaymentMethod();
    $cart_id = generateRandomCartId();

    return array(
        'order_id' => $order_id,
        'order_date' => $order_date,
        'payment' => $payment,
        'cart_id' => $cart_id
    );
}

// 生成随机订单ID
function generateRandomOrderId()
{
    return time().uniqid();
}

// 生成随机订单日期
function generateRandomOrderDate()
{
    $startTimestamp = strtotime("2023-01-01");
    $endTimestamp = strtotime("2023-12-31");
    $randomTimestamp = rand($startTimestamp, $endTimestamp);
    return date("Y-m-d H:i:s", $randomTimestamp);
}


function generateRandomPaymentMethod()
{
    $minAmount = 10; // 最小金额
    $maxAmount = 1000; // 最大金额
    $randomAmount = rand($minAmount, $maxAmount);
    return $randomAmount;
}

// 生成随机购物车ID
function generateRandomCartId()
{
    return 'CART-' . rand(1000, 9999);
}

// 调用函数生成随机订单数据
$orderData = generateRandomOrderData();
print_r($orderData);