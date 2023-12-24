<?php
$gid = $_GET['gid'];
// 构造数据
$n = 50; // 要生成的组数
$data = [];

for ($i = 0; $i < $n; $i++) {
    $randomText = generateRandomText(); // 生成随机的文字内容

    $item = [
        'cardTitle' => 'Say',
        'cardText' => $randomText,
        'avatarSrc' => 'https://cdn.jsdelivr.net/gh/open17/Pic/img/202311230409324.svg',
        'authorName' => 'Admin',
        'date' => '2022/1/1',
        'rating' => 3
    ];

    $data[] = $item;
}

// 转换为 JSON
$json = json_encode($data);


// 生成随机的文字内容
function generateRandomText() {
    $words = ['Lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipiscing', 'elit'];
    $randomText = '';

    $numWords = rand(8, 200); // 随机生成文字的数量

    for ($i = 0; $i < $numWords; $i++) {
        $randomIndex = array_rand($words);
        $randomText .= $words[$randomIndex] . ' ';
    }

    return trim($randomText);
}
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if($gid == 1)echo $json;
else echo $json;
?>