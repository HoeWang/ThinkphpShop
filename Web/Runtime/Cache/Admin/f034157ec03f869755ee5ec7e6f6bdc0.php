<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
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
		<script src="/Test/Public/Admin/assets/js/typeahead-bs2.min.js"></script>   
        <script src="/Test/Public/Admin/js/lrtk.js" type="text/javascript" ></script>		
		<script src="/Test/Public/Admin/assets/js/jquery.dataTables.min.js"></script>
		<script src="/Test/Public/Admin/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="/Test/Public/Admin/assets/layer/layer.js" type="text/javascript" ></script>                 
<title>SEO管理</title>
</head>

<body>
<div class="page-content clearfix">
 <div class="sort_style">   
  <div class="sort_list">
    <table class="table table-striped table-bordered table-hover" id="sample-table">
		<thead>
			<tr>	
				<th width="100px">分类</th>
				<th width="350px">内容</th>           
				<th width="250px">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($seo)): foreach($seo as $key=>$v): ?><tr>
				    <td><?php echo ($v["name"]); ?></td>
				    <td><input id="<?php echo ($v["id"]); ?>" style="width:350px" value="<?php echo ($v["description"]); ?>"></td>
				    <td class="td-manage"> 
				        <a title="修改" onclick="member_edit('<?php echo ($v["id"]); ?>')" href="javascript:;"  class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>
				    </td>
			    </tr><?php endforeach; endif; ?>
	    </tbody>
    </table>
  </div>
 </div>
</div>
</body>
<script>
function member_edit(id){
	layer.confirm('确认要修改吗？',{icon:0,},function(index){
		val = $('#'+id).val();
		$.post("<?php echo U('Advertising/seo');?>",{id:id,val:val},function(data){
			layer.msg('修改成功!',{icon: 1,time:1000});
		});		
	});
}
</script>
</html>