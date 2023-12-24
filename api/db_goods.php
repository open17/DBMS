<?php
// 连接数据库
require_once 'db_connect.php';

// 设置响应头为 JSON 类型
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// 获取 GET 请求参数
$category = isset($_GET['category']) ? $_GET['category'] : '';
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 9;

// 构造不带 LIMIT 和 OFFSET 的查询语句，用于获取总记录数
$countSql = "SELECT COUNT(*) AS total FROM goods WHERE inventory <> 0";

if (!empty($category) && $category != 'All') {
    $countSql .= " AND category = '$category'";
}

if (!empty($keyword)) {
    $countSql .= " AND (name LIKE '%$keyword%' OR description LIKE '%$keyword%')";
}

// 执行查询获取总记录数
$countResult = $conn->query($countSql);
$totalCount = $countResult->fetch_assoc()['total'];

// 计算偏移量
$offset = ($page - 1) * $limit;

// 构造带 LIMIT 和 OFFSET 的查询语句
$sql = "SELECT goods_id, inventory, description, image, name, category
        FROM goods 
        WHERE inventory <> 0";

if (!empty($category) && $category != 'All') {
    $sql .= " AND category = '$category'";
}

if (!empty($keyword)) {
    $sql .= " AND (name LIKE '%$keyword%' OR description LIKE '%$keyword%')";
}

// 添加 LIMIT 子句
$sql .= " LIMIT $limit OFFSET $offset";

// 执行查询
$result = $conn->query($sql);

// 检查查询结果
if ($result->num_rows > 0) {
    // 创建一个数组来存储查询结果
    $goods = array();

    // 遍历结果集，将每一行数据添加到数组中
    while ($row = $result->fetch_assoc()) {
        $goods[] = $row;
    }

    // 构造返回的 JSON 数据
    $response = array(
        'data' => $goods,
        'page' => $page,
        'limit' => $limit,
        'totalCount' => $totalCount
    );

    // 将数组转换为 JSON 字符串
    $json = json_encode($response);

    // 输出 JSON
    echo $json;
} else {
    // 返回空数组的 JSON 字符串
    echo json_encode(array('data' => array(), 'page' => $page, 'limit' => $limit, 'totalCount' => 0));
}

// 关闭数据库连接
$conn->close();
?>