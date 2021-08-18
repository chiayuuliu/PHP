<?php
include __DIR__.'/init.php';

$title = '修改資料';


$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM `products_food` WHERE sid =$sid";

$r = $pdo->query($sql)->fetch();

// print_r($_POST); exit;


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
    #preview{
        display: none;
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
                        </div>

                        <div class="form-group">
                            <label for="brand">品牌</label>
                            <input type="text" class="form-control" id="brand" name="brand" value="<?= htmlentities($r['brand']) ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="cate">商品類別</label>
                            <select class="form-control" id="cate" name="cate">
                                <option value="1"<?= $r['cate_sid']==1 ? 'selected':'' ?>>快速上桌</option>
                                <option value="2"<?= $r['cate_sid']==2 ? 'selected':'' ?>>健身專區</option>
                                <option value="3"<?= $r['cate_sid']==3 ? 'selected':'' ?>>嚴選食材</option>
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
                            <input type="file" class="form-control" id="upload" name="product_img">
                            <br>
                            <!-- 設定圖片預覽 -->
                            <img id="preview" src="" alt="">
                            <img id="old" src="./img/<?= htmlentities($r['img']) ?>" alt="">
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
    var upload = document.getElementById('upload')
    var old = document.getElementById('old')
    var preview = document.getElementById('preview')

    // 設定upload 有改變的話觸發handleFiles function
    upload.addEventListener("change",handleFiles,false)

    function handleFiles(){
        readURL(this)
        // 設定顯示新圖檔
        preview.style.display="block"
    }
    function readURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader()
            // 設定舊圖檔消失
            old.style.display="none";

            reader.onload = function(e){
                document.getElementById("preview").src = e.target.result;
            }
            reader.readAsDataURL(input.files[0])
        }
    }



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
                        location.href = 'product_list.php';

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