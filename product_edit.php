<?php
include __DIR__.'/init.php';

$title = '修改資料';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM `products_food` WHERE sid =$sid";

$r = $pdo->query($sql)->fetch();

// print_r($r['cate_sid']); exit;
// if($r[cate_sid])

if (empty($r)) {
    header('Location: product_list.php');
    exit;
}

?>


<?php include __DIR__.'./partials/html-head.php' ?>
<?php include __DIR__.'./partials/nav_bar.php' ?>

<style>
    
    img{
        width: 180px;
    }
    .card{
        margin-top: 20px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">修改資料</h5>

                    <form name="form1" onsubmit="checkForm(); return false;">
                        <input type="hidden" name="sid" value="<?= $r['sid'] ?>">

                        <div class="form-group">
                            <label for="name">商品名稱</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($r['name']) ?>">
                            <small class="form-text "></small>
                        </div>

                        <div class="form-group">
                            <label for="brand">品牌</label>
                            <select class="form-control" id="brand" name="brand" value="<?= htmlentities($r['brand']) ?>">
                                <option value="Fitme">Fitme</option>
                                <option value="食安先生">食安先生</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="cate">商品類別</label>
                            <select class="form-control" id="cate" name="cate"
                            value="<?= htmlentities($r['cate']) ?>">
                                <option value="1">快速上桌</option>
                                <option value="2">健身專區</option>
                                <option value="3">嚴選食材</option>
                            </select>
                        </div>

                        <div class="form-group">
                        <label for="price">價錢</label>
                            <input type="number" class="form-control" id="price" name="price"
                            value="<?= htmlentities($r['price']) ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="flavor">口味</label>
                            <input type="text" class="form-control" id="flavor" name="flavor" 
                            value="<?= htmlentities($r['flavor']) ?>">
                        </div>

                        <div class="form-group">
                            <label for="content">營養成分</label>
                            <textarea class="form-control" id="content" rows="2" name="content" ><?= htmlentities($r['content']) ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="introduction">商品介紹</label>
                            <textarea class="form-control" id="introduction" rows="3" name="introduction"><?= htmlentities($r['introduction']) ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="product_img">商品圖</label>
                            <input type="file" class="form-control" id="product_img" name="product_img">
                            <img src="./img/<?= htmlentities($r['img']) ?>" alt="">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">修改</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__.'./partials/scripts.php' ?>
<script>
    
    function checkForm() {

        let isPass = true;

        if (isPass) {
            const fd = new FormData(document.form1);
            fetch('product_edit_api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        alert('修改成功')
                    } else {
                        alert(obj.error);
                    }
                })
                .catch(error => {
                    console.log('error:', error);
                });
        }
    }
</script>
<?php include __DIR__.'./partials/html-foot.php' ?>