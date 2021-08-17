<?php
include __DIR__.'/init.php';

header('Content-Type: application/json');
$folder = __DIR__. './img/';

// print_r($_POST);
// print_r($_FILES); exit;
/*
Array
(
    [sid] => 8
    [name] => 柴魚健身飯
    [brand] => Fitme
    [cate] => 1
    [price] => 50
    [flavor] => 醬油柴魚
    [content] => 熱量 382.0 Kcal
蛋白質 11.2 g
碳水化合物 80.0 g
脂肪1.8 g
    [introduction] =>  鷹嘴豆是素食著相當優質的蛋白質、碳水化合物來源。鷹嘴豆是富含有蛋白質、不飽和脂肪酸、纖維素、鈣、鋅、鉀、維他命B 群等有益人體營養素的健康豆類食物。其中人體必需的八種胺基酸全部具備，而且含量比燕麥還要高出兩倍以上;魚片配上醬油更是連貓都愛的貓飯(但是貓不能吃) ，這款不但美味更是低GI!
)
Array
(
    [product_img] => Array
        (
            [name] => S__71499837.jpg
            [type] => image/jpeg
            [tmp_name] => C:\xampp\tmp\php8FFA.tmp
            [error] => 0
            [size] => 19116
        )

)
*/

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
    empty($_POST['introduction']) or
    empty($_FILES['product_img']) 
) {
    echo json_encode($output,JSON_UNESCAPED_UNICODE);
    exit;
}


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

        //資料沒有動到的話rowCount會是0
        $output['rowCount'] = $stmt->rowCount(); // 修改的筆數

        if ($stmt->rowCount() == 1) {
            $output['success'] = true;
            $output['error'] = '';
        } else {
            $output['error'] = '資料沒有修改';
        }

        echo json_encode($output, JSON_UNESCAPED_UNICODE);

    }
}
