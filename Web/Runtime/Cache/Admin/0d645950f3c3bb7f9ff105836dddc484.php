<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>添加商品参数模板</title>
    <link href="/Test/Public/Admin/assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- <link href="/Test/Public/Admin/assets/css/bootstrap.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="/Test/Public/Admin/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
    .form-control{
        width:250px;
    }
</style>
</head>
<body>
    <form class="form-horizontal" id="param-add" action="<?php echo U('Brand/Add');?>" method="post" enctype="multipart/form-data">
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">

            </div>
        </div>
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">

            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">品牌名称：</label>
            <div class="col-sm-10">
            <input type="text" name="name" />
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">品牌LOGO图：</label>
            <div class="col-sm-10">
                <input type="file" name="picture">
            </div>
        </div>
        <input type="reset" name="res" style="display:none;" />
    </form>
    <div class="form-group" id="grandpa">
        <label for="inputEmail3" class="col-sm-2 control-label"></label>
        <div class="col-sm-10" >
            <button type="button" onclick="$('#param-add').submit()" class="btn btn-success" aria-label="Left Align">
                <p class="glyphicon glyphicon-ok-circle" aria-hidden="true">保存</p>
            </button>
            <a   href="<?php echo U('Brand/brandList');?>" class="btn btn-danger" aria-label="Left Align">
                <p class="glyphicon glyphicon-off" aria-hidden="true">关闭</p>
            </a>
        </div>
    </div>
</body>
<script src="/Test/Public/Admin/js/jquery-1.9.1.min.js"></script>   
<script src="/Test/Public/Admin/assets/js/bootstrap.min.js"></script>
<script>


</script>
</html>