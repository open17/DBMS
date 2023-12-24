<?php

// 数据库连接信息
$host = "localhost";
$username = "root";
$password = "";
$database = "shop";

// 创建数据库连接
$conn = new mysqli($host, $username, $password);

// 检查数据库连接是否成功
if ($conn->connect_error) {
    die("数据库连接失败: " . $conn->connect_error);
}

// 检查数据库是否存在
$createDatabase = false;
$query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$database'";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    // 数据库不存在，设置标志以创建数据库
    $createDatabase = true;
}

// 创建数据库
if ($createDatabase) {
    $createDbQuery = "CREATE DATABASE $database";
    if ($conn->query($createDbQuery) === TRUE) {
        echo "数据库创建成功<br>";
    } else {
        echo "数据库创建失败: " . $conn->error . "<br>";
    }
}

// 选择数据库
$conn->select_db($database);
?>