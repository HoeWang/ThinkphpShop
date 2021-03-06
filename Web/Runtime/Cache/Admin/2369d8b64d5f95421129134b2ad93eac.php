<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
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
        <script type="text/javascript" src="/Test/Public/Admin/Widget/Validform/5.3.2/Validform.min.js"></script>
		<script src="/Test/Public/Admin/assets/js/typeahead-bs2.min.js"></script>           	
		<script src="/Test/Public/Admin/assets/js/jquery.dataTables.min.js"></script>
		<script src="/Test/Public/Admin/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/Test/Public/Admin/assets/layer/layer.js" type="text/javascript" ></script>          
		<script src="/Test/Public/Admin/js/lrtk.js" type="text/javascript" ></script>
         <script src="/Test/Public/Admin/assets/layer/layer.js" type="text/javascript"></script>	
        <script src="/Test/Public/Admin/assets/laydate/laydate.js" type="text/javascript"></script>
        <style>
			#tesIframe{
				style : width: 1703px; 
			}
        </style>
<title>管理员</title>
</head>

<body>
<div class="page-content clearfix">
  <div class="administrator">
       <div class="d_Confirm_Order_style">
   <!--  <div class="search_style">
     
      <ul class="search_content clearfix">
       <li><label class="l_f">管理员名称</label><input name="" type="text"  class="text_add" placeholder=""  style=" width:400px"/></li>
       <li><label class="l_f">添加时间</label><input class="inline laydate-icon" id="start" style=" margin-left:10px;"></li>
       <li style="width:90px;"><button type="button" class="btn_search"><i class="fa fa-search"></i>查询</button></li>
      </ul>
    </div> -->
    <!--操作-->
     <div class="border clearfix">
       <span class="l_f">
        <a href="javascript:ovid()" id="" class="administrator_add btn btn-warning"><i class="fa fa-plus"></i> 添加管理员</a>
        <!-- <a href="javascript:ovid()" class="btn btn-danger"><i class="fa fa-trash"></i> 批量删除</a> -->
       </span>
       <span class="r_f">共：<b>5</b>人</span>
     </div>
     <!--管理员列表-->

      <div>
        <table class="table table-striped table-bordered table-hover" id="sample_table">
		<thead>
			<tr>
				<!-- <th width="25px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th> -->
				<th width="250px">用户名</th>
        		<th width="100px">角色</th>				
				<th width="180px">加入时间</th>
				<th width="70px">状态</th>                
				<th width="200px">操作</th>
			</tr>
		</thead>
	<tbody>
	<?php if(is_array($list)): foreach($list as $k=>$v): ?><tr uid="<?php echo ($k); ?>">
      <!-- <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td> -->
      <td><?php echo ($v['username']); ?></td>
      <td><?php echo ($newlist[$mid[$k]]); ?></td>
      <td><?php echo ($v['addtime']); ?></td>
      <td class="td-status"><span class="btn btn-xs <?php echo ($v['status']=='已启用'?'btn-success':''); ?> radius"><?php echo ($v['status']); ?></span></td>
      <td class="td-manage">
        <a title="编辑" href="<?php echo U('Admin/doList', ['id'=>$k]);?>" id=""  class=" btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>       
        <a title="删除" href="javascript:;" onclick="del(this,<?php echo ($k); ?>)" class="del btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
       </td>
     </tr><?php endforeach; endif; ?>
    </tbody>
    </table>
      </div>
  </div>
</div>
 <!--添加管理员-->
 <div id="add_administrator_style" class="add_menber" style="display:none">
    <form action="" method="post" id="form-admin-add">
		<div class="form-group">
			<label class="form-label"><span class="c-red">*</span>管理员：</label>
			<div class="formControls">
				<input type="text" class="input-text" value="" placeholder="" id="user-name" name="username" datatype="*2-16" nullmsg="用户名不能为空">
			</div>
			<div class="col-4"> <span class="Validform_checktip"></span></div>
		</div>
		<div class="form-group">
			<label class="form-label"><span class="c-red">*</span>初始密码：</label>
			<div class="formControls">
			<input type="password" placeholder="密码" name="password" autocomplete="off" class="input-text" >
			</div>
			<div class="col-4"> <span class="Validform_checktip"></span></div>
		</div>
		<div class="form-group">
			<label class="form-label "><span class="c-red">*</span>确认密码：</label>
			<div class="formControls ">
		<input type="password" placeholder="确认新密码" autocomplete="off" class="input-text Validform_error"  recheck="password" id="newpassword2" name="password2">
			</div>
			<div class="col-4"> <span class="Validform_checktip"></span></div>
		</div>
		<div class="form-group">
			<label class="form-label">角色：</label>
			<div class="formControls "> <span class="select-box" style="width:150px;">
				<select class="select" name="roleId" size="1">
					<option value="">--请选择--</option>
				<?php if(is_array($acc)): foreach($acc as $k=>$val): ?><option value="<?php echo ($k); ?>"><?php echo ($val); ?></option><?php endforeach; endif; ?>
				</select>
				</span> </div>
		</div>
		<div class="form-group">
			<label class="form-label">备注：</label>
			<div class="formControls">
				<textarea name="content" cols="" rows="" class="textarea" placeholder="说点什么...100个字符以内" dragonfly="true" onkeyup="checkLength(this);"></textarea>
				<span class="wordage">剩余字数：<span id="sy" style="color:Red;">100</span>字</span>
			</div>
			<div class="col-4"> </div>
		</div>
		<div> 
        <input class="btn btn-primary radius" type="submit" id="Add_Administrator" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
	</form>
   </div>
 </div>
</body>
</html>
<script>
	$("#sample_table thead tr th input:checkbox").click(function(){
		$(this).closest("table").find("tbody tr td input:checkbox").prop("checked", $(this).prop("checked"));
	});

	//ajax无刷新删除
	function del(obj, id) {

	  $.ajax({
	    url:'<?php echo U("ajaxDel");?>',
	    data:"id="+id,
	    success:function(res){
	      $(obj).parent().parent().remove();
	    },
	    error:function(e){
	      
	    },
	  })
	}
</script>
<script type="text/javascript">
jQuery(function($) {
		var oTable1 = $('#sample_table').dataTable( {
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,2,3,4,5,7,8,]}// 制定列不参与排序
		] } );
				
				
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
			
			
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			});

</script>
<script>
/*用户-停用*/
// var a = $('.label').html();
// console.log(a);
$('body').delegate('.td-status span', 'click', function(){
	var id = $(this).parent().parent().attr('uid');
	var val = $(this).html();
	var val1 = $(this);
	console.log(val, val1, id);
	$.ajax({
		url:"<?php echo U('Admin/status');?>",
		data:{status:val, id:id},
		type:'get',
		success:function(res){
			if (res['zt'] == 1) {
				val1.html('已禁用');
				val1.attr('class', 'btn btn-xs radius');
			} else {
				val1.html('已启用');
				val1.attr('class', 'btn btn-xs btn-success radius');
			}
		},
		error: function() {
			alert('cuole');
		}
	});
});
// function member(a, id) {
	// console.log(stu);
	// $(obj).removeAttr("class");
	// $(obj).attr('class', 'btn btn-xs ');
	// $(obj).html('<i class="fa fa-close bigger-120"></i>');
	// $(obj).parent().prev().attr('class', 'label label-defaunt radius');
	// $(obj).parent().prev().html('<span class="label label-defaunt radius">已停用</span>');
	// $('a').attr('class', 'fa fa-close');
	// $(obj).attr('class', 'fa fa-check');

	// console.log($(obj).parent().prepend());
	// $.ajax({
	// 	url:"<?php echo U('Admin/status');?>",
	// 	data:{status:a, id:id},
	// 	type:'get',
	// 	success:function(res){
	// 			// console.log(res);

	// 		if (res['zt'] == 1) {
	// 			// $(obj).attr('class', 'btn btn-xs ');
	// 			$(this).parent().prepend('<a onClick="member('+res["status"]+','+res["id"]+')"  href="javascript:;" class="btn btn-xs"><i class="fa fa-close bigger-120"></i></a>');
	// 			// $(obj).parent().prev().attr('class', 'label label-defaunt radius');
	// 			$(this).parent().prev().html('<span class="label label-defaunt radius">已停用</span>');
	// 			$(this).remove();
	// 			// $(obj).attr('class', 'btn btn-xs ');
	// 			// $(obj).html('<i class="fa fa-close bigger-120"></i>');
	// 			// $(obj).parents("tr").find(".td-manage").prepend("<a onClick="member(this, '<?php echo ($v['status']); ?>',<?php echo ($k); ?>)"  href="javascript:;" class="btn btn-xs"><i class="fa fa-close bigger-120"></i></a>");
	// 			// $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
	// 			// $(obj).remove();
	// 			alert('修改成功1');
	// 		} else {
	// 			// $(obj).attr('class', 'btn btn-xs btn-success');
	// 			$(this).parent().prepend('<a onClick="member('+res["status"]+' ,'+res["id"]+')"  href="javascript:;" class="btn btn-xs btn-success"><i class="fa fa-check  bigger-120"></i></a>');
	// 			// $(obj).parent().prev().attr('class', 'label label-defaunt radius');
	// 			$(this).parent().prev().html('<span class="label label-success radius">已启用</span>');
	// 			$(this).remove();
	// 			// $(obj).attr('class', 'btn btn-xs btn-success');
	// 			// $(obj).html('<i class="fa fa-check bigger-120"></i>');
	// 			// $(obj).parents("tr").find(".td-manage").prepend('<a onClick="member(this, <?php echo ($v['status']); ?>,<?php echo ($k); ?>)"  href="javascript:;" class="btn btn-xs btn-success"><i class="fa fa-check  bigger-120"></i></a>');
	// 			// $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
	// 			// $(obj).remove();
	// 			alert('修改成功2');
	// 		}
	// 	},
	// 	error: function() {
	// 		alert('cuole');
	// 	}
	// });
// }
</script>
<script type="text/javascript">
$(function() { 
	$("#administrator").fix({
		float : 'left',
		//minStatue : true,
		skin : 'green',	
		durationTime :false,
		spacingw:50,//设置隐藏时的距离
	    spacingh:270,//设置显示时间距
	});
});
//字数限制
function checkLength(which) {
	var maxChars = 100; //
	if(which.value.length > maxChars){
	   layer.open({
	   icon:2,
	   title:'提示框',
	   content:'您输入的字数超过限制!',	
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
//初始化宽度、高度  
 $(".widget-box").height($(window).height()-215); 
$(".table_menu_list").width($(window).width()-260);
 $(".table_menu_list").height($(window).height()-215);
  //当文档窗口发生改变时 触发  
    $(window).resize(function(){
	$(".widget-box").height($(window).height()-215);
	 $(".table_menu_list").width($(window).width()-260);
	  $(".table_menu_list").height($(window).height()-215);
	})
 laydate({
    elem: '#start',
    event: 'focus' 
});



/*产品-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}

/*产品-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$(obj).parents("tr").remove();
		layer.msg('已删除!',{icon:1,time:1000});
	});
}
/*添加管理员*/
$('.administrator_add').on('click', function(){
	layer.open({
    type: 1,
	title:'添加管理员',
	area: ['700px',''],
	shadeClose: false,
	content: $('#add_administrator_style'),
	
	});
})
	//表单验证提交
$("#form-admin-add").Validform({
		
		 tiptype:2,
	
		callback:function(data){
		//form[0].submit();
		if(data.status==1){ 
                layer.msg(data.info, {icon: data.status,time: 1000}, function(){ 
                    location.reload();//刷新页面 
                    });   
            } 
            else{ 
                layer.msg(data.info, {icon: data.status,time: 3000}); 
            } 		  
			var index =parent.$("#iframe").attr("src");
			parent.layer.close(index);
			//
		}
		
		
	});	
</script>