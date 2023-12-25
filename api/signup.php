<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取 POST 请求参数
    $buyer_name = $_POST['buyer_name'];
    $password = $_POST['password'];
    $is_admin = $_POST['is_admin']; // 新增 is_admin 参数

    // 验证参数是否为空
    if (empty($buyer_name) || empty($password) || empty($is_admin)) {
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
    // echo($is_admin);
    if ($is_admin==='true') {
        // 管理员用户注册逻辑
        // 检查管理员用户名是否已存在
        $query = "SELECT admin_id FROM admin WHERE admin_name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $buyer_name);
        $stmt->execute();
        $stmt->store_result();

        // 检查管理员用户名是否已存在
        if ($stmt->num_rows > 0) {
            // 用户名已存在，返回错误信息
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'Admin username already exists'));
            exit;
        }

        // 生成唯一的 admin_id（使用雪花算法）
        $admin_id = generateUniqueAdminId();

        // 生成随机的 salt
        $salt = generateSalt();

        // 将 admin_id、admin_name、salt 插入 admin 表
        $query = "INSERT INTO admin (admin_id, admin_name, admin_salt) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sss', $admin_id, $buyer_name, $salt);
        $stmt->execute();
        $stmt->close();

        // 将密码与 salt 拼接并进行 MD5 哈希
        $secret_password = md5($password . $salt);

        // 将 secret_password 和 admin_id 插入 security_with_admin 表
        $query = "INSERT INTO security_with_admin (admin_id, hash_password) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $admin_id, $secret_password);
        $stmt->execute();
        $stmt->close();

        // 注册成功，返回成功信息
        header('Content-Type: application/json');
        echo json_encode(array('success' => 'Admin registration successful'));
    } else {
        // 买家用户注册逻辑
        // 检查买家用户名是否已存在
        $query = "SELECT buyer_id FROM buyer WHERE buyer_name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $buyer_name);
        $stmt->execute();
        $stmt->store_result();

        // 检查买家用户名是否已存在
        if ($stmt->num_rows > 0) {
            // 用户名已存在，返回错误信息
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'Buyer username already exists'));
            exit;
        }

        // 生成唯一的 buyer_id（使用雪花算法）
        $buyer_id = generateUniqueBuyerId();

        // 生成随机的 salt
        $salt = generateSalt();

        // 将 buyer_id、buyer_name、salt 插入 buyer 表
        $query = "INSERT INTO buyer (buyer_id, buyer_name, buyer_salt) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sss', $buyer_id, $buyer_name, $salt);
        $stmt->execute();
        $stmt->close();

        // 将密码与 salt 拼接并进行 MD5 哈希
        $secret_password = md5($password . $salt);

        // 将 secret_password 和 buyer_id 插入 security_with_buyer 表
        $query = "INSERT INTO security_with_buyer (buyer_id, hash_password) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $buyer_id, $secret_password);
        $stmt->execute();
        $stmt->close();

        // 生成唯一的 cart_id
        $cart_id = generateUniqueCartId();

        // 创建购物车记录
        $query = "INSERT INTO cart (cart_id, total_price) VALUES (?, 0)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $cart_id);
        $stmt->execute();
        $stmt->close();

        // 更新 buyer 表的 cart_id
        $query = "UPDATE buyer SET cart_id = ? WHERE buyer_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $cart_id, $buyer_id);
        $stmt->execute();
        $stmt->close();

        // 注册成功，返回成功信息
        header('Content-Type: application/json');
        echo json_encode(array('success' => 'Buyer registration successful'));
    }
} else {
    // 请求方法不正确，返回错误信息
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method'));
}

// 生成唯一的 buyer_id
function generateUniqueBuyerId()
{
    $timestamp = time();  // 获取当前的时间戳
    $uuid = uniqid();  // 生成UUID
    $id = $timestamp. "" .$uuid;
    return $id;
}

// 生成唯一的 admin_id
function generateUniqueAdminId()
{
    $timestamp = time();  // 获取当前的时间戳
    $uuid = uniqid();  // 生成UUID
    $id = $timestamp. "" .$uuid;
    return $id;
}

// 生成随机的 salt
function generateSalt()
{
    // 生成随机字符串作为 salt
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $salt = '';
    $length = 16;
    for ($i = 0; $i < $length; $i++) {
        $salt .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $salt;
}

function generateUniqueCartId()
{
    $timestamp = time();  // 获取当前的时间戳
    $uuid = uniqid();  // 生成UUID
    $id = $timestamp. "" .$uuid;
    return $id;
}