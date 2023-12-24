<?php

require_once 'db_connect.php';
mysqli_query($conn, "SET GLOBAL max_allowed_packet=1073741824");
$sql = "DROP DATABASE $database";
if ($conn->query($sql) === TRUE) {
    echo "数据库删除成功";
} else {
    echo "数据库删除失败: " . $conn->error;
}

// 检查数据库是否存在
$createDatabase = false;
$query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$database'";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    // 数据库不存在，设置标志以创建数据库
    $createDatabase = true;
}

if ($createDatabase) {
    $createDbQuery = "CREATE DATABASE $database";
    if ($conn->query($createDbQuery) === TRUE) {
        echo "数据库创建成功<br>";
    } else {
        echo "数据库创建失败: " . $conn->error . "<br>";
    }
}

$conn->select_db($database);

// 创建表格的SQL语句
$createTableQuery = "
CREATE TABLE buyer (
    buyer_id VARCHAR(255),
    buyer_name VARCHAR(255),
    buyer_salt VARCHAR(255),
    cart_id VARCHAR(255),
    PRIMARY KEY (buyer_id, buyer_name)
);

CREATE TABLE admin (
    admin_id VARCHAR(255),
    admin_name VARCHAR(255),
    admin_salt VARCHAR(255),
    PRIMARY KEY (admin_id, admin_name)
);

CREATE TABLE security_with_admin (
    admin_id VARCHAR(255) PRIMARY KEY,
    hash_password VARCHAR(255)
);

CREATE TABLE security_with_buyer (
    buyer_id VARCHAR(255) PRIMARY KEY,
    hash_password VARCHAR(255)
);

CREATE TABLE orders (
    order_id VARCHAR(255) PRIMARY KEY,
    order_date DATE,
    payment VARCHAR(255),
    cart_id VARCHAR(255)
);

CREATE TABLE admin_view_order (
    admin_id VARCHAR(255),
    order_id VARCHAR(255),
    PRIMARY KEY (admin_id, order_id)
);

CREATE TABLE info (
    buyer_id VARCHAR(255) PRIMARY KEY,
    post VARCHAR(255),
    street VARCHAR(255),
    city VARCHAR(255),
    country VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(255)
);

CREATE TABLE goods (
    goods_id VARCHAR(255) PRIMARY KEY,
    goods_name VARCHAR(255),
    goods_description VARCHAR(255), 
    goods_pic VARCHAR(255),
    goods_information_pic VARCHAR(255)
);

CREATE TABLE goods_type (
    goods_type_id VARCHAR(255) PRIMARY KEY,
    goods_id VARCHAR(255),
    goods_type_name VARCHAR(255),
    price DECIMAL(10, 2)
);

CREATE TABLE cart_contain_goods_type (
    cart_id VARCHAR(255),
    goods_type_id VARCHAR(255),
    PRIMARY KEY (cart_id, goods_type_id)
);

CREATE TABLE cart (
    cart_id VARCHAR(255) PRIMARY KEY,
    total_price DECIMAL(10, 2)
);
";

$addForeignKeyQuery = "
ALTER TABLE buyer
ADD FOREIGN KEY (cart_id) REFERENCES cart(cart_id);

ALTER TABLE security_with_admin
ADD FOREIGN KEY (admin_id) REFERENCES admin(admin_id);

ALTER TABLE security_with_buyer
ADD FOREIGN KEY (buyer_id) REFERENCES buyer(buyer_id);

ALTER TABLE orders
ADD FOREIGN KEY (cart_id) REFERENCES cart(cart_id);

ALTER TABLE admin_view_order
ADD FOREIGN KEY (admin_id) REFERENCES admin(admin_id),
ADD FOREIGN KEY (order_id) REFERENCES orders(order_id);

ALTER TABLE info
ADD FOREIGN KEY (buyer_id) REFERENCES buyer(buyer_id);

ALTER TABLE goods_type
ADD FOREIGN KEY (goods_id) REFERENCES goods(goods_id);

ALTER TABLE cart_contain_goods_type
ADD FOREIGN KEY (cart_id) REFERENCES cart(cart_id),
ADD FOREIGN KEY (goods_type_id) REFERENCES goods_type(goods_type_id);
";


$insertDataQuery = "

INSERT INTO buyer (buyer_id, buyer_name, buyer_salt, cart_id)
VALUES (1, 'John', 'somesalt', 1);


INSERT INTO admin (admin_id, admin_name, admin_salt)
VALUES (1, 'Admin', 'somesalt');


INSERT INTO security_with_admin (admin_id, hash_password)
VALUES (1, 'hashedpassword');


INSERT INTO security_with_buyer (buyer_id, hash_password)
VALUES (1, 'hashedpassword');


INSERT INTO orders (order_id, order_date, payment, cart_id)
VALUES (1, '2023-12-24', 'Credit Card', 1);


INSERT INTO admin_view_order (admin_id, order_id)
VALUES (1, 1);


INSERT INTO info (buyer_id, post, street, city, country, email, phone)
VALUES (1, '12345', 'Main Street', 'City', 'Country', 'johndoe@example.com', '1234567890');


INSERT INTO goods (goods_id, goods_name, goods_description, goods_pic, goods_information_pic)
VALUES (1, 'Product A', 'Description of Product A', 'iphone.png', 'iphone_info.jpg');


INSERT INTO goods_type (goods_type_id, goods_id, goods_type_name, price)
VALUES (1, 1, 'Type A', 10.99);


INSERT INTO cart_contain_goods_type (cart_id, goods_type_id)
VALUES (1, 1);


INSERT INTO cart (cart_id, total_price)
VALUES (1, 10.99);
";


// 执行创建表格的SQL语句
if ($conn->multi_query($createTableQuery) === TRUE) {
    // 处理每个查询的结果集
    do {
        // 获取当前查询的结果集
        if ($result = $conn->store_result()) {
            // 释放结果集
            $result->free();
        }
        // 移到下一个结果集
    } while ($conn->next_result());
    echo "表格创建成功<br>";
} else {
    echo "表格创建失败: " . $conn->error . "<br>";
}

// 执行添加外键约束的SQL语句
if ($conn->multi_query($addForeignKeyQuery) === TRUE) {
    // 处理每个查询的结果集
    do {
        // 获取当前查询的结果集
        if ($result = $conn->store_result()) {
            // 释放结果集
            $result->free();
        }
        // 移到下一个结果集
    } while ($conn->next_result());
    echo "外键约束添加成功<br>";
} else {
    echo "外键约束添加失败: " . $conn->error;
}

// 关闭外键约束检查
$conn->query("SET FOREIGN_KEY_CHECKS=0");


if ($conn->multi_query($insertDataQuery) === TRUE) {
    // 处理每个查询的结果集
    do {
        // 获取当前查询的结果集
        if ($result = $conn->store_result()) {
            // 释放结果集
            $result->free();
        }
        // 移到下一个结果集
    } while ($conn->next_result());
    echo "基本数据添加成功<br>";
} else {
    echo "基本数据添加失败: " . $conn->error;
}



// 打开外键约束检查
$conn->query("SET FOREIGN_KEY_CHECKS=1");

$imageUrls = [
    'huawei_info.jpg',
    'iphone.png',
];
$imageInfoUrls=[
    'huawei_info.jpg',
    'iphone_info.jpg',
];

// 循环插入数据到 goods 表
for ($i = 2; $i <= 10; $i++) {
    // 生成随机类别索引
    $randomIndex=rand(0,1);
    $randomText = generateRandomText();
    // 构造插入语句并执行
    $sql = "INSERT INTO goods (goods_id, goods_name, goods_description, goods_pic, goods_information_pic)
            VALUES ('$i', 'Product$i', '$randomText', '$imageUrls[$randomIndex]', '$imageInfoUrls[$randomIndex]')";
    $conn->query($sql);
    // 循环生成数据并插入到表中
    for ($j = 1; $j <= 10; $j++) {
        $typeName = 'Type ' . ($j + 1);
        $price = rand(100, 999) . '.' . rand(0, 99);
        $timestamp = time();  // 获取当前的时间戳
        $uuid = uniqid();  // 生成UUID
        $id = $timestamp. "" .$uuid;
        // echo($id . '<br>');
        // 构造插入语句
        $sql = "INSERT INTO goods_type (goods_type_id, goods_id, goods_type_name, price)
                VALUES ('$id', '$i', '$typeName', $price)";
        // 执行插入操作
        $conn->query($sql);
    }
}

function generateRandomText() {
    $words = ['Lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipiscing', 'elit',
    'sed', 'do', 'eiusmod', 'tempor', 'incididunt', 'ut', 'labore', 'et', 'dolore','huawei',
    'magna', 'aliqua', 'Ut', 'enim', 'ad', 'minim', 'veniam', 'quis', 'nostrud','phone', 'pad', 'like', 'robot', 'amet', 'consectetur', 'adipiscing', 'elit'];
    $randomText = '';

    $numWords = rand(2, 5); // 随机生成文字的数量

    for ($i = 0; $i < $numWords; $i++) {
        $randomIndex = array_rand($words);
        $randomText .= $words[$randomIndex] . ' ';
    }

    return trim($randomText);
}




// 关闭数据库连接
$conn->close();
?>