<?php
set_time_limit(0);
require_once '../db_connect.php';


// 遍历 cart 表中的每个 cart_id
$query = "SELECT cart_id FROM cart";
$result = $conn->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $cart_id = $row['cart_id'];
        $goods_type_id = '170351141065898572a2558';

        // 检查 cart_contain_goods_type 表中是否已经存在相同的记录
        $checkQuery = "SELECT * FROM cart_contain_goods_type WHERE cart_id = '$cart_id' AND goods_type_id = '$goods_type_id'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult && $checkResult->num_rows == 0) {
            // 不存在相同记录则插入新记录
            $insertQuery = "INSERT INTO cart_contain_goods_type (cart_id, goods_type_id) VALUES ('$cart_id', '$goods_type_id')";
            $insertResult = $conn->query($insertQuery);

            if ($insertResult) {
                echo "Inserted goods_id '$goods_type_id' for cart_id '$cart_id' successfully.<br>";
            } else {
                echo "Failed to insert goods_id for cart_id '$cart_id'.<br>";
            }
        } else {
            echo "Goods_id '$goods_type_id' already exists for cart_id '$cart_id'.<br>";
        }
    }
} else {
    echo "Failed to fetch cart data.<br>";
}