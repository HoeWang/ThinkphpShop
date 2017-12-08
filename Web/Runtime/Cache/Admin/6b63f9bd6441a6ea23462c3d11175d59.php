<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Test/Public/Admin/js/html5.js"></script>
<script type="text/javascript" src="/Test/Public/Admin/js/respond.min.js"></script>
<script type="text/javascript" src="/Test/Public/Admin/js/PIE_IE678.js"></script>
<![endif]-->
<link href="/Test/Public/Admin/assets/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="/Test/Public/Admin/css/style.css"/>       
<link href="/Test/Public/Admin/assets/css/codemirror.css" rel="stylesheet">
<link rel="stylesheet" href="/Test/Public/Admin/assets/css/ace.min.css" />
      <link rel="stylesheet" href="/Test/Public/Admin/Widget/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
<link rel="stylesheet" href="/Test/Public/Admin/assets/css/font-awesome.min.css" />
<!--[if IE 7]>
		  <link rel="stylesheet" href="/Test/Public/Admin/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
<link href="/Test/Public/Admin/Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
<link href="/Test/Public/Admin/Widget/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/Test/Public/Admin/assets/css/font-awesome.min.css">
<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">


<title>商品添加</title>
<style>
    .form-control{
        width:250px;
    }
</style>

</head>
<body>
    <div class="clearfix" id="add_picture">
        <div id="scrollsidebar" class="left_Treeview">
            <div class="show_btn" id="rightArrow"><span></span></div>
        </div>  
    </div>
    <div class="page_right_style">
    <div class="type_title" style="height: 40px; width: 1172px;">添加商品</div>
    	<form action="<?php echo U('Goods/insert');?>" method="post" class="form form-horizontal" id="form-article-add" enctype="multipart/form-data">
            <div class="clearfix cl">
                <label class="form-label col-2"><span class="c-red">*</span>商品分类：</label>
                <div class="formControls col-10" id="grandpa">
                    <select class="form-control" name="sire">
                        <option>--请选择--</option>
                        <?php if(is_array($arr)): foreach($arr as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v['name']); ?></option><?php endforeach; endif; ?>
                    </select>
                    <select class="form-control" name="son">
                      <option>--请选择--</option>
                    </select>
                </div>
            </div>
            <div class="clearfix cl">
                <label class="form-label col-2"><span class="c-red">*</span>商品名称：</label>
                <div class="formControls col-10"><input type="text" style="height: 30px; width:500px;"class="input-text" value="" placeholder="" id="" name="name"></div>
            </div>
    		<div class=" clearfix cl">
                <label class="form-label col-2">简略标题：</label>
    	        <div class="formControls col-10"><input type="text" class="input-text" value="" placeholder="" id="" name="subtitle" style="height: 30px; width:500px;"></div>
    		</div>
            <div class=" clearfix cl">
                <label class="form-label col-2">原价格：</label>
                <div class="formControls col-10"><input type="number" class="input-text" value="" placeholder="" id="" name="price" style="height: 30px; width:500px;"></div>
            </div>
            <div class=" clearfix cl">
                <label class="form-label col-2">促销价格：</label>
                <div class="formControls col-10"><input type="number" class="input-text" value="" placeholder="" id="" name="promotion_price" style="height: 30px; width:500px;"></div>
            </div>
    
            <div class=" clearfix cl">
                <label class="form-label col-2">关键字：</label>
                <div class="formControls col-10"><input type="text" class="input-text" value="" placeholder="请输入关键字，用逗号隔开" id="" name="desc" style="height: 30px; width:500px;"></div>
            </div>
            <div class=" clearfix cl">
                <label class="form-label col-2">品牌：</label>
                <div class="formControls col-10">
                    <select name="bid">
                        <option>--请选择--</option>
                        <?php if(is_array($brand)): foreach($brand as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v['name']); ?></option><?php endforeach; endif; ?>
                    </select>
                </div>
            </div>
    		<div class=" clearfix cl">    			
    			<div class="Add_p_s">
                    <label class="form-label col-2">产品参数：
        			<div class="formControls col-2">
                        </label>
                        <select class="form-control" name="renew">
                            <option>--请选择--</option>
                            <?php if(is_array($option)): foreach($option as $key=>$v): ?><option <?php echo ($v['dis']); ?> value="<?php echo ($v['id']); ?>"><?php echo ($v['name']); ?></option><?php endforeach; endif; ?>
                        </select>
                    </div>
    		    </div>
    		</div>
            <!-- 产品参数区 -->
            <div class="clearfix cl" id="parameter">
                
            </div>
            <!-- 隐藏域传产品参数参数 -->
            <input type="hidden" value="" id="data" name="param_data"/>
            <div class="">
                <a href="#">　　<span class="glyphicon glyphicon-plus-sign" id="add-property">添加属性</span></a>
            </div>
    		<div class="clearfix cl" id="property">
                <div class="Add_p_s">
                    <label class="form-label col-2">口味：</label>
                    <div class="formControls col-2">
                        <input name="taste[]"/>
                    </div>
                </div>
                <div class="Add_p_s">
                    <label class="form-label col-2">价格：</label>
                    <div class="formControls col-2">
                        <input type="number" name="now_price[]"/>
                    </div>
                </div>
                <div class="Add_p_s">
                    <label class="form-label col-2">库存：</label>
                    <div class="formControls col-2">
                        <input type="number" name="repertory[]"/>
                    </div>
                </div>
            </div>
    		<div class="clearfix cl">
    			<label class="form-label col-2">商品图片上传：</label>
    			<div class="formControls col-10">
    		          <input type="file" name="photo[]" multiple/>
    			</div>
    		</div>
            <div class="clearfix cl">
                <label class="form-label col-2">详细内容：</label>
    			<div class="formControls col-10">
    				<textarea  type="text"  name="content" id="myUedior" placeholder="请输入内容"></textarea> 
                </div>
            </div>
    		<div class="clearfix cl">
    			<div class="Button_operation">
    				<button id="refer" onClick="article_save_submit();" class="btn btn-primary radius"  type="submit"><i class="icon-save "></i>保存</button>
    				<a  class="btn btn-default radius" href="<?php echo U('Goods/productsList');?>">&nbsp;&nbsp;取消&nbsp;&nbsp;</a>
    			</div>
    		</div>
    	</form>
    </div>
</div>
</div>
<script src="/Test/Public/Admin/js/jquery-1.9.1.min.js"></script>   
<script src="/Test/Public/Admin/assets/js/bootstrap.min.js"></script>
<script src="/Test/Public/Admin/assets/js/typeahead-bs2.min.js"></script>
<script src="/Test/Public/Admin/assets/layer/layer.js" type="text/javascript" ></script>
<script src="/Test/Public/Admin/assets/laydate/laydate.js" type="text/javascript"></script>
<script type="text/javascript" src="/Test/Public/Admin/Widget/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/Test/Public/Admin/Widget/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/Test/Public/Admin/Widget/zTree/js/jquery.ztree.all-3.5.min.js"></script> 
<script type="text/javascript" src="/Test/Public/Admin/Widget/Validform/5.3.2/Validform.min.js"></script> 
<script type="text/javascript" src="/Test/Public/Admin/Widget/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="/Test/Public/Admin/Widget/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/Test/Public/Admin/Widget/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/Test/Public/Admin/Widget/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script> 
<script src="/Test/Public/Admin/js/lrtk.js" type="text/javascript" ></script>
<script type="text/javascript" src="/Test/Public/Admin/js/H-ui.js"></script> 
<script type="text/javascript" src="/Test/Public/Admin/js/H-ui.admin.js"></script> 
<script>

    //AJAX获取子类商品
    //找到表单
    var testForm = document.getElementById('form-article-add');
    //绑定事件
    testForm.sire.onchange = function() {
        
        //清空下级的选项
        testForm.son.length = 1;
        $('#minson').remove();
        //AJAX拿到商品一级子类
        $.ajax({
            url:"<?php echo U('Goods/checkSon');?>",
            data:'id='+this.value,
            success:function(res) {
                    //循环遍历创建元素
                    for (var i = 0;i < res.length; i++){
                        delete res.status;
                        //创建标签
                        var option = document.createElement('option');
                        //设置值
                        option.value = res[i].id;
                        //设置子类名
                        option.innerHTML = res[i].name;

                        //添加到节点树上
                        //找到son下拉框
                        testForm.son.appendChild(option);
                    }
            },
            error:function(res) {
                console.log(12);
            },
        });
    }

    var asd = document.getElementById('grandpa');
    //绑定事件
    testForm.son.onchange =function(){
        $('#minson').remove();
        //AJAX判断是否存在子类
        $.ajax({
            url:"<?php echo U('Goods/checkSon');?>",
            data:'id='+this.value,
            success:function(obj) {

                    //创建下拉框
                    if(obj !== 1){
                    var select = document.createElement('select');
                    //设置id值
                    select.setAttribute("name","minson");
                    select.setAttribute("class","form-control");
                    //添加到节点树
                    asd.appendChild(select);
                    var option = document.createElement('option');
                    option.innerHTML = '--请选择--';
                    //添加到节点树
                    testForm.minson.appendChild(option);
                }

                    //循环创建元素
                    for(var i = 0; i < obj.length; i++) {
                        var option = document.createElement('option');
                        //设置值
                        option.value = obj[i].id;
                        //设置子类名
                        option.innerHTML = obj[i].name;

                        //添加到节点树
                        testForm.minson.appendChild(option);
                    }
                
            },
            error:function(a) {
                console.log('asd')
            },
        });
    }

    //AJXA拿取模板字符串
    $('select[name="renew"]').change(function(){
        $('#parameter').children().remove();
        var val = $(this).val();
        $.ajax({
            url:"<?php echo U('Goods/getParam');?>",
            data: 'id='+val,
            success:function(res) {
                res = JSON.parse(res);
                //循环创建产品参数
                var num = 0;
                for(var i in res) {
                    num++;
                    var $param = '<input name="parameter'+num+'"/>';
                    $('#parameter').append($param);
                    $('input[name="parameter'+num+'"]').wrap('<div class="formControls col-2"></div>').wrap('<div class="Add_p_s"></div>').parent().before('<label class="form-label col-2">'+res[i]+'</label>');
                }
            }
        });
    });

    //点击提交时候拿到参数模板数据
    var arr=new Object();
    $('#refer').click(function() {
        
        $.each($('#parameter').children(),function(k,v) {
            var a = $(v).find('input').parent().prev().text();
            console.log(a);
            var b = $(v).find('input').val();
            arr[a] = b ;
            
        });
        
        $('#data').val(JSON.stringify(arr));
        
    });

    //点击创建商品属性
    $('#add-property').click(function() {
        var $property = '<div class="clearfix cl" id="property"></div>';
        $('#property').after($property).next().append($('#property').html());
        
    });




</script>
</html>