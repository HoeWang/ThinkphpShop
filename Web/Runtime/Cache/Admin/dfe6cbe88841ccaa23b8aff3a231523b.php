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
        <script type="text/javascript" src="/Test/Public/Admin/js/H-ui.js"></script>     
		<script src="/Test/Public/Admin/assets/js/typeahead-bs2.min.js"></script>           	
		
        <script src="/Test/Public/Admin/assets/layer/layer.js" type="text/javascript" ></script>          
        <script src="/Test/Public/Admin/assets/laydate/laydate.js" type="text/javascript"></script>
        <script src="/Test/Public/Admin/assets/js/jquery.easy-pie-chart.min.js"></script>
        <script src="/Test/Public/Admin/js/lrtk.js" type="text/javascript" ></script>
<title>订单管理</title>
	
	<style>
  .pagination ul {
    display: inline-block;
    margin-bottom: 0;
    margin-left: 0;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    -moz-box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
}
.pagination ul li {
  display: inline;
}

.pagination ul li.rows {
    line-height: 30px;
    padding-left: 5px;
}
.pagination ul li.rows b{color: #f00}

.pagination ul li a, .pagination ul li span {
    float: left;
    padding: 4px 12px;
    line-height: 20px;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #d3dbde;
    /*border-left-width: 0;*/
    margin-left: 2px;
    color: #08c;
}
.pagination ul li a:hover{
    color: red;
    background: #0088cc;
}
.pagination ul li.first-child a, .pagination ul li.first-child span {
    border-left-width: 1px;
    -webkit-border-bottom-left-radius: 3px;
    border-bottom-left-radius: 3px;
    -webkit-border-top-left-radius: 3px;
    border-top-left-radius: 3px;
    -moz-border-radius-bottomleft: 3px;
    -moz-border-radius-topleft: 3px;
}
.pagination ul .disabled span, .pagination ul .disabled a, .pagination ul .disabled a:hover {
color: #999;
cursor: default;
background-color: transparent;
}
.pagination ul .active a, .pagination ul .active span {
color: #999;
cursor: default;
}
.pagination ul li a:hover, .pagination ul .active a, .pagination ul .active span {
background-color: #f0c040;
}
.pagination ul li.last-child a, .pagination ul li.last-child span {
    -webkit-border-top-right-radius: 3px;
    border-top-right-radius: 3px;
    -webkit-border-bottom-right-radius: 3px;
    border-bottom-right-radius: 3px;
    -moz-border-radius-topright: 3px;
    -moz-border-radius-bottomright: 3px;
}

.pagination ul li.current a{color: #f00 ;font-weight: bold; background: #ddd}
</style>
</head>



<body>
	<div class="search_style">
     	<form class="form-search fr">
	        用户名:<input type="text" name="username" value="<?php echo I('username');?>" class="input-medium" placeholder="用户名">
	        
	        状态:
	        <select name="status">
	        <option value="">--请选择--</option>
	        <option <?php echo I('get.status')==1?'selected':'';?> value="1">待付款</option>
	        <option <?php echo I('get.status')==2?'selected':'';?> value="2">待发货</option>
	        <option <?php echo I('get.status')==3?'selected':'';?> value="3">待收货</option>
	        <option <?php echo I('get.status')==4?'selected':'';?> value="4">已完成</option>
	        <option <?php echo I('get.status')==5?'selected':'';?> value="5">无效订单</option>

	        </select>
	        <button type="submit" class="btn">搜索</button>
        </form>
      
    </div>
    <div style="width:100%;height:100px;">
      <!--订单列表展示-->
       <table class="table table-striped table-bordered table-hover" id="sample-table">
		<thead>
		 <tr>
				
				<th width="120px">订单编号</th>
				<th width="250px">产品名称</th>
				<th width="100px">总价</th>
                <th width="100px">订单时间</th>				
                <th width="80px">收件人</th>
				<th width="70px">状态</th>                
				<th width="200px">操作</th>
			</tr>
		</thead>
	<tbody>
  <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr tid="<?php echo ($v["id"]); ?>">
     
     <td><?php echo ($v["oid"]); ?></td>
     <td class="order_product_name">
	<?php if(is_array($list2)): foreach($list2 as $key=>$v2): if($v2[orderid] == $v['id']): ?><i>·</i>
      	<img src="/Test/<?php echo ($v2['picname']); ?>"  title="产品名称" style="width:50px;height:50px"/>
      	<i>·</i><?php endif; endforeach; endif; ?>   
     </td>
     <td><?php echo ($v["total"]); ?></td>
     <td><?php echo ($v["addtime"]); ?></td>
     <td><?php echo ($v["receiver"]); ?></td>
      <td class="td-status"><span class="label label-success radius"><?php echo ($v["status"]); ?></span></td>
     <td>
     <?php if($v["status"] == '待发货'): ?><a  href="javascript:void(0);" title="发货"  id="flow" class="btn btn-xs btn-success"><i class="fa fa-cubes bigger-120"></i></a><?php endif; ?>
     <a title="订单详细"  href="<?php echo U('Order/detail',['id'=>$v['id']]);?>"  class="btn btn-xs btn-info order_detailed" ><i class="fa fa-list bigger-120"></i></a> 
        
     </td>
     </tr><?php endforeach; endif; ?> 

     
     </tbody>
     </table>
    </div>


    <div class="shows" style="width:100%;height:800px;background:black;border:1px solid lightblue;position:relative;top:-100px;z-line:1;display:none;opacity:0.5;">
    </div>
		<div class="pagination" style="position:relative;left:500px;top:280px">
        <ul>
          <?php echo ($btn); ?>
        </ul>
      </div>

   <div class="changes" style="display:none;width:33%;height:293px;border:1px solid lightblue;position:absolute;top:126px;left:700px;background:white">
        <div stylt"margin:0 auto">
        
        <form>

        <input type="hidden" name="id" value="" class="idds"/>
            <div class="content_style"><br><br><br>
  <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1">快递公司 </label>
       	<div class="col-sm-9">
	       	<select class="form-control" id="form-field-select-1" name="sends">
				<option value="">--选择快递--</option>
				<option value="1">天天快递</option>
				<option value="2">圆通快递</option>
				<option value="3">中通快递</option>
				<option value="4">顺丰快递</option>
				<option value="5">申通快递</option>
				<option value="6">邮政EMS</option>
				<option value="7">邮政小包</option>
				<option value="8">韵达快递</option>
			</select>
		</div>
	</div>
   <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 快递号 </label>
    <div class="col-sm-9"><input type="text" id="form-field-1" placeholder="快递号" class="col-xs-10 col-sm-5" style="margin-left:0px;"></div>
	</div>
    <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1">在线支付 </label>
     <div class="col-sm-9"><label><input name="checkbox" type="checkbox" class="ace" id="checkbox"><span class="lbl"></span></label></div>
	</div>
	　　　<div　style="margin:0 auto"><button type="button" id="submitss" class="btn btn-default">提交</button></div>
 </div>
                  
                  
                </form> <a class="closes" href="javascript:void(0);" style="width:30px;height:30px;position:relative;left:400px">X</a>
        </div>

      </div>
 <!--发货-->
 
</body>
</html>
<script>
 $('.pagination a,.pagination span').unwrap('<div></div>').wrap('<li></li>');
//无刷新点击分页实现
$('body').delegate('.pagination a','click',function(){
	var pageObj = this;
	var url = pageObj.href;
	$.ajax({
		url:url,
		type:'get',
		success:function(res){
			$('tbody').html(res.html);
			$('.pagination ul').html(res.btn);
			 $('.pagination a,.pagination span').unwrap('<div></div>').wrap('<li></li>');
		}
	});
	return false;
});





$('#submitss').click(function(){
	console.log($('.idds').val());

	var info1 = $('#form-field-select-1').val();
	var info2 = $('#form-field-1').val();
	var info3 = $('.ace').prop('checked');
	var arr = {};
	if(info1 == '' || info2 == '' || info3 == false){
		alert("请完善发货信息");
	}else{
		arr.id = $('.idds').val();
		arr.sendnum = info2;
		arr.sendtype = info1;
		arr.status = 3;
		$.ajax({
			url:"<?php echo U('Order/sends');?>",
			type:'get',
			data:arr,
			success:function(res){
				if(res.status == 1){
					$("tr[tid="+res.id+"]").children().eq(5).children().eq(0).html('待收货');
					$("tr[tid="+res.id+"]").children().eq(6).children().eq(0).remove();
					$('.shows').css('display','none');
					$('.changes').css('display','none');

				}
			},
			error:function(){
				console.log('miss');
			}
		});
		
	}
	console.log($('#form-field-select-1').val());
	console.log($('#form-field-1').val());
	console.log($('.ace').prop('checked'));

	
});

$(document).delegate('#flow','click',function(){
	$('.shows').css('display','block');
	$('.changes').css('display','block');
	var ids = $(this).parent().parent().attr('tid');
	$('.idds').val(ids);
	console.log($('.idds').val());

});

$('.closes').click(function(){
	console.log(1);
	$('.shows').css('display','none');
	$('.changes').css('display','none');
});



 
</script>
<script>
//订单列表

</script>