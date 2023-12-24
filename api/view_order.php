<?php



// 设置响应头为 JSON 类型
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // 获取 GET 请求参数
    $admin_id = $_GET['admin_id'];

    // 验证参数是否为空
    if (empty($admin_id)) {
        // 参数不完整，返回错误信息
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Incomplete parameters'));
        exit;
    }

    // // 验证管理员权限（示例中简单判断是否为管理员）
    // if ($admin_id !== 'admin123') {
    //     // 非管理员，返回错误信息
    //     header('Content-Type: application/json');
    //     echo json_encode(array('error' => 'Unauthorized access'));
    //     exit;
    // }

    // 连接数据库
    require_once 'db_connect.php';

    // 查询订单历史
    $query = "SELECT * FROM orders";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows === 0) {
        // 如果查询结果为空，返回错误信息
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'No orders found'));
        exit;
    } else {
        // 否则，返回订单历史
        $orders = array();
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($orders);
    }
} else {
    // 请求方法不正确，返回错误信息
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method'));
}