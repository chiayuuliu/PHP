<?php
include __DIR__.'/init.php';
include __DIR__.'./partials/nav_bar.php';


$cate = isset($_GET['cate']) ? intval($_GET['cate']) : 1;

print_r($_GET); exit;


$sql = "SELECT * FROM `products_food` WHERE  `cate_sid`=1";

$row = $pdo->query($sql)->fetchALL();

echo json_encode($row,JSON_UNESCAPED_UNICODE);


?>