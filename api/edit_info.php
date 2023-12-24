<?php
    // 设置响应头为 JSON 类型
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取 POST 请求参数
    $buyer_id = $_POST['buyer_id'];
    $post = $_POST['post'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // 验证参数是否完整
    if (empty($buyer_id) || empty($post) || empty($street) || empty($city) || empty($country) || empty($email) || empty($phone)) {
        // 参数不完整，返回错误信息
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Incomplete parameters'));
        exit;
    }

    // 验证参数是否符合格式（示例中只验证了邮箱格式）
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // 参数格式不正确，返回错误信息
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Invalid parameter format'));
        exit;
    }

    // 连接数据库
    require_once 'db_connect.php';
    // 设置响应头为 JSON 类型
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');

    // 查询info表
    $query = "SELECT * FROM info WHERE buyer_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $buyer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows === 0) {
        // 如果不存在，则插入新记录
        $query = "INSERT INTO info (buyer_id, post, street, city, country, email, phone) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssss', $buyer_id, $post, $street, $city, $country, $email, $phone);
        $stmt->execute();
        $stmt->close();
    } else {
        // 否则，更新现有记录
        $query = "UPDATE info SET post = ?, street = ?, city = ?, country = ?, email = ?, phone = ? WHERE buyer_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssss', $post, $street, $city, $country, $email, $phone, $buyer_id);
        $stmt->execute();
        $stmt->close();
    }

    // 返回成功信息
    header('Content-Type: application/json');
    echo json_encode(array('success' => 'User information updated'));
} else {
    // 请求方法不正确，返回错误信息
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method'));
}