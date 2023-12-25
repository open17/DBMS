<?php
// 允许来自任何域的跨域请求
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// 检查请求方法
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // 对于预检请求，直接返回成功响应
  var_dump($_POST);
  exit();
}
?>