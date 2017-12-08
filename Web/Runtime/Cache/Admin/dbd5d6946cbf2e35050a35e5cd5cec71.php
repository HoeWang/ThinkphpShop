<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Cache-Control" content="no-siteapp" />
        <link href="/Test/Public/Admin/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/Test/Public/Admin/css/style.css"/>       
        <link href="/Test/Public/Admin/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/Test/Public/Admin/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/Test/Public/Admin/font/css/font-awesome.min.css" />
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="/Test/Public/Admin/assets/css/ace-ie.min.css" />
		<![endif]-->
		<script src="/Test/Public/Admin/js/jquery-1.9.1.min.js"></script>
        <script src="/Test/Public/Admin/assets/js/bootstrap.min.js"></script>
		<script src="/Test/Public/Admin/assets/js/typeahead-bs2.min.js"></script>           	
		<script src="/Test/Public/Admin/assets/js/jquery.dataTables.min.js"></script>
		<script src="/Test/Public/Admin/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/Test/Public/Admin/assets/layer/layer.js" type="text/javascript" ></script>          
        <script src="/Test/Public/Admin/assets/laydate/laydate.js" type="text/javascript"></script>
        <script src="js/dragDivResize.js" type="/Test/Public/Admin/text/javascript"></script>
<title>添加角色</title>
</head>

<body>
<div class="Competence_add_style clearfix">
	<div class="left_Competence_add">
<form action="" method="post">
		<div class="title_name">添加角色</div>
		<div class="Competence_add">
		<input type="hidden" name="id" value="<?php echo ($_GET['id']); ?>" />
			<div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 角色名称 </label>
				<div class="col-sm-9"><input type="text" id="form-field-1" placeholder=""  name="name" value="<?php echo ($_GET['name']); ?>" class="col-xs-10 col-sm-5"></div>
			</div>
			<div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 角色描述 </label>
				<div class="col-sm-9"><textarea name="description" class="form-control" id="form_textarea" placeholder="" onkeyup="checkLength(this);"></textarea><span class="wordage">剩余字数：<span id="sy" style="color:Red;">200</span>字</span></div>
			</div>
			<!--按钮操作-->
				<div class="Button_operation">
					<button type="submit" style="background-color:#428bca;border-color:#428bca;padding:3px 10px;color:#FFF;width:105px;height:36px">保存并提交</button>
					<button style="background-color:#ffb752;border-color:#ffb752;padding:3px 10px;color:#FFF;width:105px;height:36px"><a href="javascript:history.back();" style="color:#FFF;text-decoration:none;">返回上一步</a></button>    
				</div>
		</div>
	</div>
	<!--权限分配-->
	<div class="Assign_style">
		<div class="title_name">权限分配</div>
		<div class="Select_Competence">
			<dl class="permission-list">
				<dt>
					<label class="middle"><input name="user-Character-0" class="ace" type="checkbox" id="id-disable-check"><span class="lbl">all</span></label>
				</dt>
				<dd>
					<dl class="cl permission-list2">
						<dd>
							<?php if(is_array($arr)): foreach($arr as $k=>$v): ?><label class="middle"><input type="checkbox" value="<?php echo ($v['id']); ?>" <?php echo in_array($v['id'], $list)?checked:'';;?> class="ace" name="node[]" id="user-Character-0-0-0"><span class="lbl"><?php echo ($v['title']); echo ($v['urls']); ?></span></label><?php endforeach; endif; ?>
						</dd>
					</dl>
				</dd>
			</dl> 
		</div> 

	</div>

	</form>
</div>
</body>
</html>
<script type="text/javascript">
/*按钮选择*/
$(function(){
	$(".permission-list dt input:checkbox").click(function(){
		$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
	});
	// $(".permission-list2 dt input:checkbox").click(function(){
	// 	var l =$(this).parent().parent().find("input:checked").length;
	// 	var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
	// 	if($(this).prop("checked")){
	// 		$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
	// 		$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
	// 	}
	// 	else{
	// 		if(l==0){
	// 			$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
	// 		}
	// 		if(l2==0){
	// 			$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
	// 		}
	// 	}
		
	// });
});

//初始化宽度、高度  
 $(".left_Competence_add,.Competence_add_style").height($(window).height()).val();; 
 $(".Assign_style").width($(window).width()-500).height($(window).height()).val();
 $(".Select_Competence").width($(window).width()-500).height($(window).height()-40).val();
  //当文档窗口发生改变时 触发  
    $(window).resize(function(){
	
	$(".Assign_style").width($(window).width()-500).height($(window).height()).val();
	$(".Select_Competence").width($(window).width()-500).height($(window).height()-40).val();
	$(".left_Competence_add,.Competence_add_style").height($(window).height()).val();;
	});
/*字数限制*/
function checkLength(which) {
	var maxChars = 200; //
	if(which.value.length > maxChars){
	   layer.open({
	   icon:2,
	   title:'提示框',
	   content:'您出入的字数超多限制!',	
    });
		// 超过限制的字数了就将 文本框中的内容按规定的字数 截取
		which.value = which.value.substring(0,maxChars);
		return false;
	}else{
		var curr = maxChars - which.value.length; //250 减去 当前输入的
		document.getElementById("sy").innerHTML = curr.toString();
		return true;
	}
};

</script>