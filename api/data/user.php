<?php
set_time_limit(0);
require_once '../db_connect.php';

$a = 0; // 设置管理员数量
$b = 2000; // 设置卖家数量

for ($i = 0; $i < $a + $b; $i++) {
    // 生成随机的用户名和密码
    $buyer_name = generateRandomUsername();
    $password = generateRandomPassword();
    $is_admin = $i < $a ? 'true' : 'false'; // 随机生成 is_admin 参数
    // 验证参数是否为空
    if (empty($buyer_name) || empty($password) || empty($is_admin)) {
        // 参数不完整，返回错误信息
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Incomplete parameters'));
        exit;
    }

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
        // header('Content-Type: application/json');
        // echo json_encode(array('success' => 'Admin registration successful'));
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

        $post = generateRandomPost();
        $street = generateRandomStreet();
        $city = generateRandomCity();
        $country = generateRandomCountry();
        $email = generateRandomEmail();
        $phone = generateRandomPhone();

        $query = "INSERT INTO info (buyer_id, post, street, city, country, email, phone) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssss', $buyer_id, $post, $street, $city, $country, $email, $phone);
        $stmt->execute();
        $stmt->close();


        // 注册成功，返回成功信息
        header('Content-Type: application/json');
        // echo json_encode(array('success' => 'Buyer registration successful'));
    }
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
 
function generateRandomUsername()
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $username = '';
    for ($i = 0; $i < 8; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $username .= $characters[$index];
    }
    return $username;
}

function generateRandomPassword($length = 8)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $password = '';
    $charCount = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, $charCount - 1);
        $password .= $characters[$index];
    }

    return $password;
}

// 生成随机的 post
function generateRandomPost()
{
    $post = rand(10000, 99999);  // 生成一个随机的5位数字邮政编码
    return $post;
}

// 生成随机的 street
function generateRandomStreet()
{
    $streets = array(
        "Main Street",
        "Park Avenue",
        "Elm Street",
        "Oak Lane",
        "Cedar Road"
    );
    $street = $streets[array_rand($streets)];  // 从数组中随机选择一个街道名称
    return $street;
}

// 生成随机的 city
function generateRandomCity()
{
    $cities = array(
        "New York",
        "Los Angeles",
        "Chicago",
        "San Francisco",
        "Seattle"
    );
    $city = $cities[array_rand($cities)];  // 从数组中随机选择一个城市名称
    return $city;
}

// 生成随机的 country
function generateRandomCountry()
{
    $countries = array(
        "United States",
        "Canada",
        "United Kingdom",
        "Australia",
        "Germany"
    );
    $country = $countries[array_rand($countries)];  // 从数组中随机选择一个国家名称
    return $country;
}

// 生成随机的 email
function generateRandomEmail()
{
    $email = substr(md5(rand()), 0, 7) . "@example.com";  // 生成一个随机的邮箱地址
    return $email;
}

// 生成随机的 phone
function generateRandomPhone()
{
    $phone = "1" . rand(100, 999) . "-" . rand(100, 999) . "-" . rand(1000, 9999);  // 生成一个随机的电话号码
    return $phone;
}