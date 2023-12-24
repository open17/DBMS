<?php

$keyword = $_GET['keyword'];
$category = $_GET['category'];

$data = [
    [
        'title' => 'iPhone',
        'badge' => 'New',
        'description' => 'This is the description for Product 1.',
        'tags' => ['Tag 1', 'Tag 2', 'Tag 3'],
        'img' => 'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032218979.png',
        'price' => '$1000',
        'rating' => 4,
        'category' => 'Phone',
        'gid' => '1'
    ],
    [
        'title' => 'HUAWEI',
        'description' => 'This is the description for Product 2.',
        'tags' => ['Tag 4'],
        'img' => 'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032224142.jpeg',
        'price' => '$1000',
        'rating' => 4,
        'category' => 'Phone',
        'gid' => '2'
    ],
    [
        'title' => 'XiaoMi',
        'badge' => 'Sale',
        'description' => 'This is the description for Product 2.',
        'tags' => [],
        'img' => 'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032220554.png',
        'price' => '$1000',
        'rating' => 4,
        'category' => 'Phone'
    ],
    [
        'title' => 'Product 1',
        'description' => 'This is the description for Product 2.',
        'tags' => ['Tag 5'],
        'img' => 'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032225840.jpeg',
        'price' => '$1000',
        'rating' => 4,
        'category' => 'Computer'
    ],
    [
        'title' => 'Product 2',
        'badge' => 'Sale',
        'description' => 'This is the description for Product 2.',
        'tags' => ['Tag 4', 'Tag 5'],
        'img' => 'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032226141.jpeg',
        'price' => '$1000',
        'rating' => 4,
        'category' => 'Audiovisual'
    ],
    [
        'title' => 'Product 2',
        'badge' => 'Sale',
        'description' => 'This is the description for Product 2.',
        'tags' => ['Tag 4', 'Tag 5'],
        'img' => 'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032230374.jpeg',
        'price' => '$1000',
        'rating' => 4,
        'category' => 'Others'
    ],
    [
        'title' => 'Product 2',
        'badge' => 'Sale',
        'description' => 'This is the description for Product 2.',
        'tags' => ['Tag 4', 'Tag 5'],
        'img' => 'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032232491.jpeg',
        'price' => '$1000',
        'rating' => 4,
        'category' => 'Others'
    ],
    [
        'title' => 'Product 2',
        'badge' => 'Sale',
        'description' => 'This is the description for Product 2.',
        'tags' => ['Tag 4', 'Tag 5'],
        'img' => 'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032233320.png',
        'price' => '$1000',
        'rating' => 4,
        'category' => 'Others'
    ],
    [
        'title' => 'Product 2',
        'badge' => 'Sale',
        'description' => 'This is the description for Product 2.',
        'tags' => ['Tag 4', 'Tag 5'],
        'img' => 'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032233856.jpeg',
        'price' => '$1000',
        'rating' => 4,
        'category' => 'Others'
    ]
];
if ($category!="All") {
    $data = array_filter($data, function($item) use ($category) {
    return isset($item['category']) && $item['category'] == $category;});
}
$json = json_encode($data);
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

echo $json;
?>
