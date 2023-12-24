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



    // 查询info表
    $query = "SELECT * FROM info WHERE buyer_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $buyer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows === 0) {
        // 如果查询结果为空，返回错误信息
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'User not found'));
        exit;
    } else {
        // 否则，返回用户信息
        $row = $result->fetch_assoc();
        header('Content-Type: application/json');
        echo json_encode($row);
    }
} else {
    // 请求方法不正确，返回错误信息
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method'));
}