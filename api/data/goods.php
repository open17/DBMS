<?php

require_once '../db_connect.php';

$imageUrls = [
    'huawei.jpg',
    'iphone.png',
];
$imageInfoUrls=[
    'huawei_info.jpg',
    'iphone_info.jpg',
];

// 循环插入数据到 goods 表
for ($i = 2; $i <= 20004; $i++) {
    // 生成随机类别索引
    $randomIndex=rand(0,1);
    $randomText = generateRandomText();
    $gid=time().uniqid();
    // 构造插入语句并执行
    $sql = "INSERT INTO goods (goods_id, goods_name, goods_description, goods_pic, goods_information_pic)
            VALUES ('$gid', 'Product$i', '$randomText', '$imageUrls[$randomIndex]', '$imageInfoUrls[$randomIndex]')";
    $conn->query($sql);
    $m=rand(4,9);
    // 循环生成数据并插入到表中
    for ($j = 1; $j <= $m; $j++) {
        $typeName = 'Type ' . ($j + 1);
        $price = rand(100, 999) . '.' . rand(0, 99);
        $timestamp = time();  // 获取当前的时间戳
        $uuid = uniqid();  // 生成UUID
        $id = $timestamp. "" .$uuid;
        // echo($id . '<br>');
        // 构造插入语句
        $sql = "INSERT INTO goods_type (goods_type_id, goods_id, goods_type_name, price)
                VALUES ('$id', '$gid', '$typeName', $price)";
        // 执行插入操作
        $conn->query($sql);
    }
}

function generateRandomText() {
    $words = ['Lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipiscing', 'elit',
    'sed', 'do', 'eiusmod', 'tempor', 'incididunt', 'ut', 'labore', 'et', 'dolore','huawei',
    'magna', 'aliqua', 'Ut', 'enim', 'ad', 'minim', 'veniam', 'quis', 'nostrud','phone', 'pad', 'like', 'robot', 'amet', 'consectetur', 'adipiscing', 'elit'];
    $randomText = '';

    $numWords = rand(2, 10); // 随机生成文字的数量

    for ($i = 0; $i < $numWords; $i++) {
        $randomIndex = array_rand($words);
        $randomText .= $words[$randomIndex] . ' ';
    }

    return trim($randomText);
}