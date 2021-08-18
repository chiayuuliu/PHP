<?php
include __DIR__.'/init.php';
$title = '新增商品資料';


?>
<?php include __DIR__.'./partials/html-head.php' ?>
<?php include __DIR__.'./partials/nav_bar.php' ?>

<style>
    form .form-group small {
        color: red;
    }

    .card{
        margin-top: 20px;
    }
    #preview{
        width: 180px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增商品資料</h5>

                    <form name="form1" onsubmit="checkForm(); return false;">
                        <div class="form-group">
                            <label for="name">商品名稱</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>

                        <div class="form-group">
                            <label for="brand">品牌</label>
                            <input type="text" class="form-control" id="brand" name="brand">
                        </div>

                        <div class="form-group">
                            <label for="cate">商品類別</label>
                            <select class="form-control" id="cate" name="cate" >
                                <option value="1">快速上桌</option>
                                <option value="2">健身專區</option>
                                <option value="3">嚴選食材</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price">價錢</label>
                            <input type="number" class="form-control" id="price" name="price">
                            <small class="form-text "></small>
                        </div>

                        <div class="form-group">
                            <label for="flavor">口味</label>
                            <input type="text" class="form-control" id="flavor" name="flavor">
                            <small class="form-text "></small>
                        </div>

                        <div class="form-group">
                            <label for="content">營養成分</label>
                            <textarea class="form-control" id="content" rows="2" name="content" ></textarea>
                        </div>

                        <div class="form-group">
                            <label for="introduction">商品介紹</label>
                            <textarea class="form-control" id="introduction" rows="3" name="introduction" ></textarea>
                        </div>
                        <!-- 商品圖 -->
                        <div class="form-group">
                            <label for="product_img">商品圖</label>
                            <input type="file" class="form-control" id="upload" name="product_img"><br>
                            <img id="preview" src="" alt="">
                        </div>

                        <br>
                        <button type="submit" class="btn btn-primary">新增</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__.'./partials/scripts.php' ?>
<script>
    
    var upload = document.getElementById('upload')
    upload.addEventListener("change",handleFiles,false)

    function handleFiles(){
        console.log(this)
        readURL(this)
    }
    function readURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader()
            reader.onload = function(e){
                document.getElementById("preview").src = e.target.result
            }
            reader.readAsDataURL(input.files[0])
        }
    }






    function checkForm(){

        let isPass = true;
        if (isPass) {
            const fd = new FormData(document.form1);
            fetch('product_create_api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
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
