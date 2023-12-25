<?php
// 连接数据库
require_once 'db_connect.php';

// 设置响应头为 JSON 类型
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// 获取 GET 请求参数
$goodsId = isset($_GET['gid']) ? $_GET['gid'] : '1';

// 查询商品详情
$goodsSql = "SELECT goods_description, goods_information_pic,goods_pic, goods_name FROM goods WHERE goods_id = '$goodsId' ";
$goodsResult = $conn->query($goodsSql);

// 查询商品类型信息
$typeSql = "SELECT goods_type_name,price,goods_type_id FROM goods_type WHERE goods_id = '$goodsId' ";
$typeResult = $conn->query($typeSql);

// 构造返回的 JSON 数据
$response = array();

// 检查查询结果
if ($goodsResult->num_rows > 0) {
    $goodsData = $goodsResult->fetch_assoc();
    $response['description'] = $goodsData['goods_description'];
    $response['information'] = $goodsData['goods_information_pic'];
    $response['image'] = $goodsData['goods_pic'];
    $response['name'] = $goodsData['goods_name'];
}

if ($typeResult->num_rows > 0) {
    $typeData = array();

    // 遍历结果集，将每一行数据添加到数组中
    while ($row = $typeResult->fetch_assoc()) {
        $typeData[] = $row;
    }

    $response['type'] = $typeData;
}

// 将数组转换为 JSON 字符串
$json = json_encode($response);

// 输出 JSON
echo $json;

// 关闭数据库连接
$conn->close();
?>