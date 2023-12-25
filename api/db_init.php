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

$triggerQuery = "
CREATE TRIGGER clear_cart_and_goods
AFTER INSERT ON orders
FOR EACH ROW
BEGIN
    DELETE FROM cart_contain_goods_type
    WHERE cart_id = NEW.cart_id;
    
    UPDATE cart
    SET total_price = 0
    WHERE cart_id = NEW.cart_id;
END ;

CREATE TRIGGER update_cart_total_price
AFTER INSERT ON cart_contain_goods_type
FOR EACH ROW
BEGIN
    DECLARE goods_price DECIMAL(10, 2);
    SELECT price INTO goods_price
    FROM goods_type
    WHERE goods_type_id = NEW.goods_type_id;
    
    UPDATE cart
    SET total_price = total_price + goods_price
    WHERE cart_id = NEW.cart_id;
END ;

CREATE TRIGGER delete_cart_total_price
AFTER DELETE ON cart_contain_goods_type
FOR EACH ROW
BEGIN
    DECLARE goods_price DECIMAL(10, 2);
    SELECT price INTO goods_price
    FROM goods_type
    WHERE goods_type_id = OLD.goods_type_id;
    
    UPDATE cart
    SET total_price = total_price - goods_price
    WHERE cart_id = OLD.cart_id;
END ;
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


// if ($conn->multi_query($insertDataQuery) === TRUE) {
//     // 处理每个查询的结果集
//     do {
//         // 获取当前查询的结果集
//         if ($result = $conn->store_result()) {
//             // 释放结果集
//             $result->free();
//         }
//         // 移到下一个结果集
//     } while ($conn->next_result());
//     echo "基本数据添加成功<br>";
// } else {
//     echo "基本数据添加失败: " . $conn->error;
// }

if ($conn->multi_query($triggerQuery) === TRUE) {
    // 处理每个查询的结果集
    do {
        // 获取当前查询的结果集
        if ($result = $conn->store_result()) {
            // 释放结果集
            $result->free();
        }
        // 移到下一个结果集
    } while ($conn->next_result());
    echo "trigger添加成功<br>";
} else {
    echo "trigger添加失败: " . $conn->error;
}




// 打开外键约束检查
$conn->query("SET FOREIGN_KEY_CHECKS=1");



// 关闭数据库连接
$conn->close();
?>