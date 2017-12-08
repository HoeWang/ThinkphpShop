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
<title>管理角色</title>
</head>

<body>
 <div class="margin clearfix">
   <div class="border clearfix">
       <span class="l_f">
        <a href="<?php echo U('Admin/competence');?>" id="Competence_add" class="btn btn-warning" title="添加角色"><i class="fa fa-plus"></i> 添加角色</a>
        <!-- <a href="javascript:ovid()" class="btn btn-danger"><i class="fa fa-trash"></i> 批量删除</a> -->
       </span>
       <!-- <span class="r_f">共：<b>5</b>类</span> -->
     </div>
     <div class="compete_list">
       <table id="sample-table-1" class="table table-striped table-bordered table-hover">
		 <thead>
			<tr>
			  <!-- <th class="center"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th> -->
			  <th>权限名称</th>
			  <!-- <th>人数</th> -->
              <th>用户名称</th>
			  <th class="hidden-480">描述</th>             
			  <th class="hidden-480">操作</th>
             </tr>
		    </thead>
             <tbody>
             <?php if(empty($list)): ?><tr><td colspan="5"><h3>暂无数据~~~</h3></td></tr>
             <?php else: ?>
             <?php if(is_array($list)): foreach($list as $k=>$v): ?><tr>
				<!-- <td class="center"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td> -->
				<td><?php echo ($v['name']); ?></td>
				<!-- <td><?php echo ($count[$k-1]['role_id']); echo ($k == $count[$k-1]['role_id']?$count[$k-1]['count']:'0'); ?></td> -->
				<td class="hidden-480"><?php echo ($peo[$k]); ?></td>
				<td><?php echo ($v['description']); ?></td>
				<td>
                 <a title="编辑"  href="<?php echo U('competence', ['id'=>$v['id'], 'name'=>$v['name']]);?>"  class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>        
                 <a title="删除" href="javascript:;"  onclick="Competence_del(this, <?php echo ($v['id']); ?>)" class="btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
				</td>
			   </tr><?php endforeach; endif; endif; ?>										
		      </tbody>
	        </table>
     </div>
 </div>
 <!--添加权限样式-->
 <!-- <div id="Competence_add_style" style="display:none">
   <div class="Competence_add_style">
     <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 权限名称 </label>
       <div class="col-sm-9"><input type="text" id="form-field-1" placeholder=""  name="权限名称" class="col-xs-10 col-sm-5"></div>
	</div>
     <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 权限说明 </label>
       <div class="col-sm-9"><textarea name="权限说明" class="form-control" id="form_textarea" placeholder="" onkeyup="checkLength(this);"></textarea><span class="wordage">剩余字数：<span id="sy" style="color:Red;">200</span>字</span></div>
	</div>
   </div> 
  </div>-->
</body>
</html>
<script type="text/javascript">
/*添加权限*/
 $('#Competence_add').on('click', function(){	 
	 layer.open({
        type: 1,
        title: '添加权限',
		maxmin: true, 
		shadeClose: false,
        area : ['800px' , ''],
        content:$('#Competence_add_style'),
		btn:['提交','取消'],
		yes:function(index,layero){	
		 var num=0;
		 var str="";
     $(".col-sm-9 input[type$='text'],#form_textarea").each(function(n){
          if($(this).val()=="")
          {
               
			   layer.alert(str+=""+$(this).attr("name")+"不能为空！\r\n",{
                title: '提示框',				
				icon:0,								
          }); 
		    num++;
            return false;            
          } 
		 });
		  if(num>0){  return false;}	 	
          else{
			  layer.alert('添加成功！',{
               title: '提示框',				
			icon:1,		
			  });
			   layer.close(index);	
		  }		  		     				
		}
    });			 
 });
 /*权限-删除*/
function Competence_del(obj,id){
	$.ajax({
	    url:'<?php echo U("lastDel");?>',
	    data:"id="+id,
	    success:function(res){
	    	if (res == 1) {
	      		$(obj).parent().parent().remove();
	    	}
	    },
	    error:function(e){
	      
	    },
	  })
}
/*修改权限*/
// function Competence_modify(id){
// 		window.location.href ="Competence.html?="+id;
// };	
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
//面包屑返回值
var index = parent.layer.getFrameIndex(window.name);
parent.layer.iframeAuto(index);
$('.Order_form ,#Competence_add').on('click', function(){
	var cname = $(this).attr("title");
	var cnames = parent.$('.Current_page').html();
	var herf = parent.$("#iframe").attr("src");
    parent.$('#parentIframe span').html(cname);
	parent.$('#parentIframe').css("display","inline-block");
    parent.$('.Current_page').attr("name",herf).css({"color":"#4c8fbd","cursor":"pointer"});
	//parent.$('.Current_page').html("<a href='javascript:void(0)' name="+herf+">" + cnames + "</a>");
    parent.layer.close(index);
	
});
</script>