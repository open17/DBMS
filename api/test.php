<?php
$imageUrls = [
    'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032218979.png',
    'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032224142.jpeg',
    'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032220554.png',
    'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032225840.jpeg',
    'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032226141.jpeg'
];

$blobDataArray = [];

foreach ($imageUrls as $imageUrl) {
    // 读取图片文件的二进制数据
    $imageData = file_get_contents($imageUrl);
    
    // 将图片数据转换为 Base64 编码
    $base64Data = base64_encode($imageData);
    
    // 将 Base64 编码的数据存储到数组中
    $blobDataArray[] = $base64Data;
}

// 输出生成的 Blob 数据数组
print_r($blobDataArray);
?>