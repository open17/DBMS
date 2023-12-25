<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取 POST 请求参数
    $username = $_POST['username'];
    $password = $_POST['password'];
    $is_admin = $_POST['is_admin'];
    // 验证参数是否为空
    if (empty($username) || empty($password) || empty($is_admin)) {
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
    
    // 准备 SQL 查询语句和参数
    if ($is_admin === 'true') {
        $table = 'admin';
        $id_column = 'admin_id';
        $name_column = 'admin_name';
        $salt_column = 'admin_salt';
        $password_column = 'hash_password';
        $security_table = 'security_with_admin';
    } else {
        $table = 'buyer';
        $id_column = 'buyer_id';
        $name_column = 'buyer_name';
        $salt_column = 'buyer_salt';
        $password_column = 'hash_password';
        $security_table = 'security_with_buyer';
    }

    // 查询用户信息
    $query = "SELECT $id_column, $salt_column FROM $table WHERE $name_column = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    // 检查用户是否存在
    if ($stmt->num_rows === 0) {
        // 用户不存在，返回错误信息
        header('Content-Type: application/json');
        echo json_encode(array('error' => $_POST['username'].' not exits'));
        exit;
    }

    // 绑定结果到变量
    $stmt->bind_result($id, $salt);
    $stmt->fetch();
    $stmt->close();

    // 将密码与盐值拼接并进行 MD5 哈希
    $secret_password = md5($password . $salt);

    // 查询密码哈希值
    $query = "SELECT $password_column FROM $security_table WHERE $id_column = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->bind_result($hash_password);
    $stmt->fetch();
    $stmt->close();

    // 检查密码是否匹配
    if ($secret_password !== $hash_password) {
        // 密码不匹配，返回错误信息
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Invalid password'));
        exit;
    }

    // 验证通过，返回成功信息
    header('Content-Type: application/json');
    echo json_encode(array('success' => 'Login successful', 'userId' => $id));
} else {
    // 请求方法不正确，返回错误信息
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method'));
}