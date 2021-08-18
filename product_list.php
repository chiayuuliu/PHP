<?php
include __DIR__ . '/init.php';

// ------------------------頁數設定-----------------------

$perPage = 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$cate = isset($_GET['cate']) ? intval($_GET['cate']) : 0;
$qs = [];

$where = 'WHERE 1 ';

// 如果沒有類別,sql就設定全部,如果有sql就設定照類別分
if (!$cate) {
    $sql = sprintf("SELECT * FROM `products_food` ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();
} else {
    $where .= "AND cate_sid = $cate";
    $qs['cate'] = $cate;
    $sql = "SELECT * FROM `products_food` WHERE `cate_sid`=$cate ORDER BY `sid` DESC;";
    $rows = $pdo->query($sql)->fetchALL();
}


// 所有資料
$totalSql = "SELECT count(1) FROM `products_food` $where;";
// 總筆數
$totalRows = $pdo->query("SELECT count(1) FROM `products_food` $where;")
    ->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage);


?>

<?php include __DIR__ . './partials/html-head.php' ?>
<?php include __DIR__ . './partials/nav_bar.php' ?>

<style>
    .list {
        margin-top: 0px;
    }

    .intr {
        width: 350px;
    }

    .content {
        width: 150px;
    }

    .name {
        width: 150px;
    }

    .brand {
        width: 90px;
    }

    .page-btn {
        margin-top: 10px;
    }

    img {
        width: 80px;
    }

    i {
        font-size: 20px;
    }

    .icon {
        text-align: center;
    }

    .fa-edit {
        color: darkblue;
    }

    .fa-trash-alt {
        color: darkred;
    }


    .btn-row {
        justify-content: space-between;
        display: flex;
        align-items: center;
    }

    .btnwrap {
        display: flex;
        flex-direction: row;
        /* justify-content: ; */
        width: 40%;
    }

    .btnwrap div {
        width: 100px;
        color: lightblue;
    }
    .btnwrap div a{
        text-decoration: none;
        color: darkblue;
        opacity: 0.8;
    }
    .page {
        width: 30%;
        display: flex;
        flex-direction: row-reverse;
    }

    .create a {
        /* text-decoration: none; */
        color: darkslateblue;
        font-weight: bold;
    }
    .btnwrap div a:hover{
        opacity: 1;
    }
</style>


<div class="container" d-flex>
    <div class="btn-row">
        <!-- 分類按鈕 -->
        <div class="btnwrap ">
            <div class="create">
                <a href="product_create.php">新增商品</a>
            </div>
            <div class="">
                <a href="?">所有商品</a>
            </div>
            <div class="">
                <a href="?cate=1">快速上桌</a>
            </div>
            <div class="">
                <a href="?cate=2">健身專區</a>
            </div>
            <div class="">
                <a href="?cate=3">嚴選食材</a>
            </div>
        </div>
        <!-- 頁碼 -->
        <div class="page">
            <ul class="pagination page-btn">
                <!-- 前一頁icon -->
                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?<?php $qs['page'] = $page - 1;
                                                echo http_build_query($qs); ?>">
                        <i class="fas fa-angle-left"></i>
                    </a>
                </li>
                <!-- --------頁數-------- -->
                <?php for ($i = 1; $i <= $totalPages; $i++) :
                    $qs['page'] = $i;
                ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?<?= http_build_query($qs) ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                    <a class="page-link" href="?<?php $qs['page'] = $page + 1;
                                                echo http_build_query($qs); ?>">
                        <i class="fas fa-angle-right"></i>
                    </a>
                </li>
            </ul>
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
                        <!-- <th class="sid" scope="col">sid</th> -->
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
                    <?php foreach ($rows as $r) : ?>
                        <tr data-sid="<?= $r['sid'] ?>">
                            <td class="icon">
                                <a href="product_delete.php?sid=<?= $r['sid'] ?>" onclick="return confirm('確定要刪除<?= $r['name'] ?>的商品資料嗎')">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                            <!-- <td><?= $r['sid'] ?></td> -->
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['introduction'] ?></td>
                            <td><?= $r['brand'] ?></td>
                            <td><?= $r['price'] ?></td>
                            <td><?= $r['content'] ?></td>
                            <td><img src="./img/<?= $r['img'] ?>" alt=""></td>
                            <td class="icon">
                                <a href="product_edit.php?sid=<?= $r['sid'] ?>">
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
<?php include __DIR__ . './partials/scripts.php' ?>
<?php include __DIR__ . './partials/html-foot.php' ?>