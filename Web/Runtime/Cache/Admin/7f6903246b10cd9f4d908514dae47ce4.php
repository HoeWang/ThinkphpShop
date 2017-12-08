<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
 <link href="/Test/Public/Admin/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/Test/Public/Admin/css/style.css"/>       
        <link rel="stylesheet" href="/Test/Public/Admin/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/Test/Public/Admin/assets/css/font-awesome.min.css" />
        <link href="/Test/Public/Admin/Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="/Test/Public/Admin/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="/Test/Public/Admin/assets/css/ace-ie.min.css" />
		<![endif]-->
	    <script src="/Test/Public/Admin/js/jquery-1.9.1.min.js"></script>
        <script src="/Test/Public/Admin/assets/js/bootstrap.min.js"></script>
<title>添加产品分类</title>
</head>
<body>
<div class="type_style">
 <div class="type_title">产品类型信息</div>
  <div class="type_content">
  <div class="Operate_btn">
  <p  class="btn  btn-warning"><i class="icon-edit align-top bigger-125"></i>新增商品类型</p>
  <!-- <a href="/Test/Public/Admin/javascript:ovid()" class="btn  btn-success"><i class="icon-ok align-top bigger-125"></i>禁用该类型</a> -->
  
  </div>
  <form action="<?php echo U('doAdd');?>" method="post" class="form form-horizontal" id="form-user-add"> 
    <input type="hidden" name="pid" value="<?php echo empty($info)?0:$info['id'];?> " />
    <input type="hidden" name="path" value="<?php echo empty($info)?'0,':$info['path'].$info['id'].',';?>" />
    <div class="Operate_cont clearfix">
    <label class="form-label">添加到：</label>
    <div class="formControls">
        <h3>　<?php echo empty($info)?顶级分类:$info['name'];?></h>
    </div>
    </div>
    <div class="Operate_cont clearfix">
      <label class="form-label"><span class="c-red">*</span>分类名称：</label>
      <div class="formControls ">
        <input type="text" class="input-text" required value="" placeholder="" id="user-name" name="name">
      </div>
    </div>
    <div class="">
     <div class="" style=" text-align:center">
      <input class="btn btn-primary radius" type="submit" value="提交">
      <span class="modular fr"><a href="<?php echo U(index);?>" class="btn btn-primary radius">返回</a></span>
      </div>
    </div>

  </form>
  </div>
</div> 
</div>
<script type="text/javascript" src="/Test/Public/Admin/Widget/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/Test/Public/Admin/Widget/Validform/5.3.2/Validform.min.js"></script>
<script type="text/javascript" src="/Test/Public/Admin/assets/layer/layer.js"></script>
<script type="text/javascript" src="/Test/Public/Admin/js/H-ui.js"></script> 
<script type="text/javascript" src="/Test/Public/Admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-user-add").Validform({
		tiptype:2,
		callback:function(form){
			form[0].submit();
			var index = parent.layer.getFrameIndex(window.name);
			parent.$('.btn-refresh').click();
			parent.layer.close(index);
		}
	});
});


</script>
</body>
</html>