<?php
include __DIR__.'/init.php';

// ------------------------頁數設定-----------------------
$perPage = 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$totalRows = $pdo->query("SELECT count(1) FROM `products_food`")
    ->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows/$perPage);

$sql = sprintf("SELECT * FROM `products_food` ORDER BY sid LIMIT %s, %s", ($page-1)*$perPage, $perPage);


// ------------------------分類資料呈現--------------------
$cate = isset($_GET['cate']) ? intval($_GET['cate']) : 0;

if(!$cate){
    $sql = "SELECT * FROM `products_food` WHERE 1";
}else{
    $sql = "SELECT `sid`, `name`, `product_id`, `price`, `brand`, `introduction`, `flavor`, `cate_sid`, `img`, `content` FROM `products_food` WHERE `cate_sid`=$cate";
}

$row = $pdo->query($sql)->fetchALL();

?>

<?php include __DIR__.'./partials/html-head.php' ?>
<?php include __DIR__.'./partials/nav_bar.php' ?>

<style>
    .list{
        margin-top: 0px;
    }

    .intr{
        width: 350px;
    }
    .content{
        width: 150px;
    }
    .name{
        width: 150px;
    }
    .sid{
        width: 50px;
    }
    .brand{
        width: 90px;
    }

    .page-btn{
        margin-top: 10px;

    }
    
</style>

<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination page-btn">
                    
                    <!-- 前一頁icon -->
                    <!-- 如果GET拿到的page值<1, 直接disable 讓他沒有功能(但還是可以按) -->
                    <li class="page-item <?= $page<=1 ? 'disable':'' ?>">
                        <a class="page-link"
                        href="?<?php $qs['page']=$page-1; echo http_build_query($qs); ?>">
                            <i class="fas fa-angle-left"></i>
                        </a>
                    </li>
                    <!-- --------頁數-------- -->
                    <?php for($i=$page-5; $i<=$page+5; $i++):
                            if($i>=1 and $i<=$totalPages):
                                $qs['page'] = $i;
                        ?>
                    <!-- 如果頁碼跟GET拿到的頁碼一樣,設定active 讓按鈕有反灰效果表示按到, -->
                    <li class="page-item <?= $i==$page ? 'active' : '' ?>">
                        <a class="page-link" href="?<?= http_build_query($qs)?>">
                            <?= $i ?>
                        </a>
                    </li>
                    <?php endif;
                        endfor; ?>
    
                    <!-- 下一頁icon, 如果頁數>=總頁數,icon無效用 -->
                    <li class="page-item <?= $page>=$totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?php $qs['page']=$page+1; echo http_build_query($qs);?>">
                            <i class="fas fa-angle-right"></i>
                        </a>
                    </li>
                    <!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- 表單資訊 -->
<div class="container list">
    <div class="row">
    <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">刪除</th>
                        <th class="sid" scope="col">sid</th>
                        <th class="name" scope="col">商品名稱</th>
                        <th class="intr" scope="col">商品介紹</th>
                        <th class="brand" scope="col">品牌</th>
                        <th scope="col">價格</th>
                        <th class="content" scope="col">營養成分</th>
                        <th scope="col">商品圖</th>
                        <th scope="col">編輯</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach($row as $r): ?>
                        <tr data-sid="<?= $r['sid'] ?>" >
                            <td>
                                <a href="data-delete.php?sid=<?= $r['sid'] ?>"
                                onclick="return confirm('確定要刪除編號<?= $r['sid'] ?>的資料嗎')">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['introduction'] ?></td>
                            <td><?= $r['brand'] ?></td>
                            <td><?= $r['price'] ?></td>
                            <td><?= $r['content'] ?></td>
                            <td><?= $r['img'] ?></td>

                            <td>
                                <a href="data-edit.php?sid=<?= $r['sid'] ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__.'./partials/scripts.php' ?>
<?php include __DIR__.'./partials/html-foot.php' ?>








