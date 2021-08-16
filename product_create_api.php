<?php
include __DIR__.'/init.php';

header('Content-Type: application/json');
$folder = __DIR__. './img/';

$output = [
    'success' => false,
    'error' => '',
    'rowCount' => 0,
    'postData' => $_POST,
];

// 如果有收到檔案資訊------------

if(! empty($_FILES)){

  if(move_uploaded_file(
    $_FILES['product_img']['tmp_name'], 
    $folder.$_FILES['product_img']['name']
  )){
    $sql ="INSERT INTO `products_food`(`sid`, `name`, `product_id`, `price`, `brand`, `introduction`, `flavor`, `cate_sid`, `img`, `content`) 
    VALUES ('NULL',?,'[PW-]',?,?,?,?,?,?,?)";

    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        $_POST['name'],
        $_POST['price'],
        $_POST['brand'],
        $_POST['introduction'],
        $_POST['flavor'],
        $_POST['cate'],
        $_FILES['product_img']['name'],
        $_POST['content'],   
    ]);
    $output['rowCount'] = $stmt->rowCount(); 

    if ($stmt->rowCount() == 1) {
        $output['success'] = true;
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    
    }else{
        $output['error'] = '圖片未上傳';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }
}
}   
    



