<?php
include __DIR__.'/init.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if (!empty($sid)) {
    $sql = "DELETE FROM `products_food` WHERE sid = $sid";
    $stmt = $pdo->query($sql);
}



if (isset($_SERVER['HTTP_REFERER'])) {
    //如果有的話直接跳轉到當初的頁面, 沒有的話回到第一頁
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    header('Location:product_list.php');
}
