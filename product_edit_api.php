<?php
include __DIR__.'/init.php';

header('Content-Type: application/json');
$folder = __DIR__. './img/';

$sid = ($_POST['sid']); 
$sql = "SELECT * FROM `products_food` WHERE `sid` = $sid;";

$row = $pdo->query($sql)->fetch();

$output = [
    'success' => false,
    'error' => '請檢查欄位',
    'rowCount' => 0,
    'postData' => $_POST,
];


if (
    empty($_POST['sid']) or
    empty($_POST['name']) or
    empty($_POST['brand']) or
    empty($_POST['cate']) or
    empty($_POST['price']) or
    empty($_POST['flavor']) or
    empty($_POST['content']) or
    empty($_POST['introduction']) 
) {
    echo json_encode($output,JSON_UNESCAPED_UNICODE);
    exit;
}

$isSaved = false;

if(! empty($_FILES)){

    if(move_uploaded_file(
      $_FILES['product_img']['tmp_name'], 
      $folder.$_FILES['product_img']['name']
    )){
        $sql = "UPDATE `products_food` SET 
        `name`=?,
        `price`=?,
        `brand`=?,
        `introduction`=?,
        `flavor`=?,
        `cate_sid`=?,
        `img`=?,
        `content`=? 
        WHERE `sid`=?";

        $stmt = $pdo->prepare($sql);

        //POST 傳來的資訊放入stmt, 需對照上面的順序
        $stmt->execute([
            $_POST['name'],
            $_POST['price'],
            $_POST['brand'],
            $_POST['introduction'],
            $_POST['flavor'],
            $_POST['cate'],
            $_FILES['product_img']['name'],
            $_POST['content'],
            $_POST['sid'],
        ]);
        if($stmt->rowCount()){
            $isSaved = true; 
            $output['error'] = 'no error';
            $output['success'] = true;
    
            echo json_encode($output);
            exit;
        }
    }
}
if(! $isSaved){
    $sql = "UPDATE `products_food` SET 
        `name`=?,
        `price`=?,
        `brand`=?,
        `introduction`=?,
        `flavor`=?,
        `cate_sid`=?,
        `content`=? 
        WHERE `sid`=?";

        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            $_POST['name'],
            $_POST['price'],
            $_POST['brand'],
            $_POST['introduction'],
            $_POST['flavor'],
            $_POST['cate'],
            $_POST['content'],
            $_POST['sid'],        
        ]);
        if($stmt->rowCount()){
            $output['error'] = '沒有更新圖片';
            $output['success'] = true;
        }
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
