<?php

$gid = $_GET['gid'];

$data1 = array(
    "name" => "XiaoMi 14",
    "price" => '$1000',
    "category" => "mobile",
    "img" => 'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032311211.jpeg',
    "type" => array("Pro+128BG", "Pro+64GB", "SE+256GB", "SE+128GE", "SE+64GB", "128GB"),
    "forbid" => array("Pro+256BG", "256GB")
);

$data2 = array(
    "name" => "HUAWEI 10",
    "price" => '$1000',
    "category" => "mobile",
    "img" => 'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032311211.jpeg',
    "type" => array("Pro+128BG", "Pro+64GB", "SE+256GB", "SE+128GE", "SE+64GB", "128GB","Pro+256BG", "256GB"),
);

$json1 = json_encode($data1);
$json2 = json_encode($data2);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if($gid == 1)echo $json1;
else echo $json2;
?>
