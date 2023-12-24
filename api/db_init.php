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
CREATE TABLE IF NOT EXISTS goods (
    goods_id INT PRIMARY KEY,
    inventory INT,
    description TEXT,
    image LONGBLOB,
    name VARCHAR(255),
    category VARCHAR(255),
    information LONGBLOB,
    seller_id INT
);

CREATE TABLE IF NOT EXISTS type (
    goods_id INT,
    type_id INT,
    seller_id INT,
    type_name VARCHAR(255),
    price DECIMAL(10, 2),
    PRIMARY KEY (goods_id, type_id)
);

CREATE TABLE IF NOT EXISTS comment (
    comment_id INT PRIMARY KEY,
    content TEXT,
    pictures BLOB,
    rating INT,
    buyer_id INT,
    goods_id INT
);

CREATE TABLE IF NOT EXISTS buyer (
    buyer_id INT PRIMARY KEY,
    name VARCHAR(255),
    phone VARCHAR(20),
    salt VARCHAR(255),
    email VARCHAR(255),
    cart_id INT
);

CREATE TABLE IF NOT EXISTS seller (
    seller_id INT PRIMARY KEY,
    name VARCHAR(255),
    phone VARCHAR(20),
    salt VARCHAR(255),
    email VARCHAR(255),
    income DECIMAL(10, 2)
);

CREATE TABLE IF NOT EXISTS address (
    address_id INT PRIMARY KEY,
    post VARCHAR(20),
    detail_address VARCHAR(255),
    city VARCHAR(255),
    country VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS security (
    security_id INT PRIMARY KEY,
    password VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS cart (
    cart_id INT PRIMARY KEY,
    goods_id INT,
    quantity INT
);

CREATE TABLE IF NOT EXISTS type_contain_in_cart (
    cart_id INT,
    type_id INT,
    num INT,
    PRIMARY KEY (cart_id, type_id)
);

CREATE TABLE IF NOT EXISTS purchase (
    purchase_id INT PRIMARY KEY,
    cart_id INT,
    buyer_id INT,
    price DECIMAL(10, 2),
    time DATETIME
);

CREATE TABLE IF NOT EXISTS buyer_security (
    security_id INT,
    buyer_id INT,
    PRIMARY KEY (security_id, buyer_id)
);

CREATE TABLE IF NOT EXISTS seller_security (
    security_id INT,
    seller_id INT,
    PRIMARY KEY (security_id, seller_id)
);

CREATE TABLE IF NOT EXISTS sell (
    sell_id INT PRIMARY KEY,
    purchase_id INT,
    num INT,
    profit DECIMAL(10, 2)
);
";

$addForeignKeyQuery = "
ALTER TABLE goods
ADD FOREIGN KEY (seller_id) REFERENCES seller(seller_id);

ALTER TABLE type
ADD FOREIGN KEY (goods_id) REFERENCES goods(goods_id),
ADD FOREIGN KEY (seller_id) REFERENCES seller(seller_id);

ALTER TABLE comment
ADD FOREIGN KEY (buyer_id) REFERENCES buyer(buyer_id),
ADD FOREIGN KEY (goods_id) REFERENCES goods(goods_id);

ALTER TABLE buyer
ADD FOREIGN KEY (cart_id) REFERENCES cart(cart_id);

ALTER TABLE purchase
ADD FOREIGN KEY (cart_id) REFERENCES cart(cart_id),
ADD FOREIGN KEY (buyer_id) REFERENCES buyer(buyer_id);

ALTER TABLE buyer_security
ADD FOREIGN KEY (security_id) REFERENCES security(security_id),
ADD FOREIGN KEY (buyer_id) REFERENCES buyer(buyer_id);

ALTER TABLE seller_security
ADD FOREIGN KEY (security_id) REFERENCES security(security_id),
ADD FOREIGN KEY (seller_id) REFERENCES seller(seller_id);

ALTER TABLE sell
ADD FOREIGN KEY (purchase_id) REFERENCES purchase(purchase_id);
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
    echo "外键约束添加成功";
} else {
    echo "外键约束添加失败: " . $conn->error;
}

// 关闭外键约束检查
$conn->query("SET FOREIGN_KEY_CHECKS=0");

// 插入数据到 seller 表
$sql = "INSERT INTO seller (seller_id, name, phone, salt, email, income)
        VALUES ('1', '卖家1', '123456789', 'salt1', 'seller1@example.com', '1000')";

$conn->query($sql);

// 插入数据到 goods 表
$sql = "INSERT INTO goods (goods_id, inventory, description, image, name, category, information, seller_id)
        VALUES ('1', '0', '描述1', 'image1.jpg', '商品1', 'Others', '信息1', '1')";

$conn->query($sql);

// 插入数据到 type 表
$sql = "INSERT INTO type (goods_id, type_id, seller_id, type_name, price)
        VALUES ('1', '1', '1', '类型1', '10.99')";

$conn->query($sql);

// 插入数据到 comment 表
$sql = "INSERT INTO comment (comment_id, content, pictures, rating, buyer_id, goods_id)
        VALUES ('1', '好商品！', 'image1.jpg', '5', '1', '1')";

$conn->query($sql);

// 插入数据到 buyer 表
$sql = "INSERT INTO buyer (buyer_id, name, phone, salt, email, cart_id)
        VALUES ('1', '买家1', '987654321', 'salt2', 'buyer1@example.com', '1')";

$conn->query($sql);

// 插入数据到 address 表
$sql = "INSERT INTO address (address_id, post, detail_address, city, country)
        VALUES ('1', '123456', '地址1', '城市1', '国家1')";

$conn->query($sql);

// 插入数据到 security 表
$sql = "INSERT INTO security (security_id, password)
        VALUES ('1', 'password1')";

$conn->query($sql);

// 插入数据到 cart 表
$sql = "INSERT INTO cart (cart_id, goods_id, quantity)
        VALUES ('1', '1', '2')";

$conn->query($sql);

// 插入数据到 goods_contain_in_cart 表
$sql = "INSERT INTO type_contain_in_cart (cart_id, type_id, num)
        VALUES ('1', '1', '2')";

$conn->query($sql);

// 插入数据到 purchase 表
$sql = "INSERT INTO purchase (purchase_id, cart_id, buyer_id, price, time)
        VALUES ('1', '1', '1', '21.98', '2023-12-17 10:00:00')";

$conn->query($sql);

// 插入数据到 buyer_security 表
$sql = "INSERT INTO buyer_security (security_id, buyer_id)
        VALUES ('1', '1')";

$conn->query($sql);

// 插入数据到 seller_security 表
$sql = "INSERT INTO seller_security (security_id, seller_id)
        VALUES ('1', '1')";

$conn->query($sql);

// 插入数据到 sell 表
$sql = "INSERT INTO sell (sell_id, purchase_id, num, profit)
        VALUES ('1', '1', '2', '21.98')";

$conn->query($sql);

// 打开外键约束检查
$conn->query("SET FOREIGN_KEY_CHECKS=1");

// 定义类别数组
$categories = ['Phone', 'Computer', 'Others', 'Audiovisual'];
$imageUrls = [
    './img/202312032218979.png',
    './img/202312032224142.jpeg',
];

$blobDataArray = [];

foreach ($imageUrls as $imageUrl) {
    // 读取图片文件的二进制数据
    $imageData = file_get_contents($imageUrl);
    // 将图片数据进行 Base64 编码
    $base64Data = base64_encode($imageData);
    // 将编码后的图片数据存储到数组中
    $blobDataArray[] = $base64Data;
}
$info=base64_encode(file_get_contents('./img/info.jpeg'));
// 循环插入数据到 goods 表
for ($i = 2; $i <= 500; $i++) {
    // 生成随机类别索引
    $categoryIndex = array_rand($categories);
    $category = $categories[$categoryIndex];
    $imageBlob = $blobDataArray[array_rand($blobDataArray)];
    // 生成随机库存量和价格
    $inventory = rand(1, 100);
    $price = rand(100, 999) . '.' . rand(0, 99);
    $randomText = generateRandomText();
    // 构造插入语句并执行
    $sql = "INSERT INTO goods (goods_id, inventory, description, image, name, category, information, seller_id)
            VALUES ('$i', '$inventory', '$randomText', '$imageBlob', 'A$i', '$category', '$info' , '1')";
    
    $conn->query($sql);
}

function generateRandomText() {
    $words = ['phone', 'pad', 'like', 'robot', 'amet', 'consectetur', 'adipiscing', 'elit'];
    $randomText = '';

    $numWords = rand(5, 16); // 随机生成文字的数量

    for ($i = 0; $i < $numWords; $i++) {
        $randomIndex = array_rand($words);
        $randomText .= $words[$randomIndex] . ' ';
    }

    return trim($randomText);
}

// 循环生成数据并插入到表中
for ($i = 1; $i <= 1000; $i++) {
    // 生成随机数据
    $goodsId = mt_rand(1, 80);
    $typeId = mt_rand(1, 10);
    $sellerId = 1;
    $typeName = 'Type ' . ($i + 1);
    $price = rand(100, 999) . '.' . rand(0, 99);
    // 构造插入语句
    $sql = "INSERT INTO type (goods_id, type_id, seller_id, type_name, price)
            VALUES ($goodsId, $i, $sellerId, '$typeName', $price)";
    // 执行插入操作
    $conn->query($sql);
}


// 关闭数据库连接
$conn->close();
?>