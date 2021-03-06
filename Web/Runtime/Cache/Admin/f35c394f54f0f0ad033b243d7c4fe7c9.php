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
    <form class="form-horizontal" id="param-add" action="<?php echo U('Goods/paramSave');?>" method="post">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">商品类别：</label>
            <div class="col-sm-10">
                <select class="form-control" name="renew">
                    <option>--请选择--</option>
                <?php if(is_array($option)): foreach($option as $key=>$v): ?><option <?php echo ($v['dis']); ?> value="<?php echo ($v['id']); ?>"><?php echo ($v['name']); ?></option><?php endforeach; endif; ?>
                </select>
            </div>
        </div>
        <div class="form-group" id="grandpa">
            <label for="inputEmail3" class="col-sm-2 control-label">规格参数：</label>
            <div class="col-sm-10" >
                <a class="btn btn-default" id="father" href="#" role="button">添加属性</a>
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
            <a   href="<?php echo U('Goods/productsList');?>" class="btn btn-danger" aria-label="Left Align">
                <p class="glyphicon glyphicon-off" aria-hidden="true">关闭</p>
            </a>
        </div>
    </div>
</body>
<script src="/Test/Public/Admin/js/jquery-1.9.1.min.js"></script>   
<script src="/Test/Public/Admin/assets/js/bootstrap.min.js"></script>
<script>

    
    //点击创建分组
    var num =0;
    var i = 100;
    $('#father').click(function() {
        num++;
        var $html = "<input name='group"+num+"' type='text'/>";
        $('#param-add').append($html);
        $('input[name="group'+num+'"]').wrap('<div class="form-group" ></div>').wrap('<div class="col-sm-10" id="grandpa'+num+'"></div>').parent().before('<label for="inputEmail3" class="col-sm-2 control-label"></label>');
        //创建添加参数 +小图标
        $('input[name="group'+num+'"]').after('<span class="glyphicon glyphicon-remove-sign" id="adda'+num+'"></span>');

        //点击删除
        $('#adda'+num+'').on('click',function(){
            $(this).parent().parent().remove();
        })

        // //点击+创建规格参数模板字段 二级模板（销售手机，电器之类的时候可以用到）
        // $('#param-add #adda'+num+'').click(function() {
        //     i++;
        // var $html = "<input name='group"+i+"' type='text'/>";
        // $(this).parent().parent().after($html);
        // $('input[name="group'+i+'"]').wrap('<div class="form-group" ></div>').wrap('<div class="col-sm-10" id="grandpa'+i+'"></div>').parent().before('<label for="inputEmail3" class="col-sm-2 control-label"></label>');
        // $('input[name="group'+i+'"]').after('<span class="glyphicon glyphicon-remove-circle" id="adda'+i+'"></span>').next().on('click',function() {
        //     $(this).parent().parent().remove();
        // });
        // });
    });

    //更换类别重置表单
    var testForm =document.getElementById('param-add');
    testForm.renew.onchange = function(){
         $('span').parent().parent().remove();
    } 
    

</script>
</html>