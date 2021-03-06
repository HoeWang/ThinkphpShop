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
        <link rel="stylesheet" href="/Test/Public/Admin/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/Test/Public/Admin/assets/css/font-awesome.min.css" />
        <link type="text/css" href="/Test/Public/css/paging.css" rel="stylesheet" />
        <link rel="stylesheet" href="/Test/Public/Admin/Widget/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
        <link href="/Test/Public/Admin/Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />   
    <!--[if IE 7]>
      <link rel="stylesheet" href="/Test/Public/Admin/assets/css/font-awesome-ie7.min.css" />
    <![endif]-->
        <!--[if lte IE 8]>
      <link rel="stylesheet" href="/Test/Public/Admin/assets/css/ace-ie.min.css" />
    <![endif]-->
      <script src="/Test/Public/Admin/js/jquery-1.9.1.min.js"></script>   
        <script src="/Test/Public/Admin/assets/js/bootstrap.min.js"></script>
        <script src="/Test/Public/Admin/assets/js/typeahead-bs2.min.js"></script>
    <!-- page specific plugin scripts -->
    <script src="/Test/Public/Admin/assets/js/jquery.dataTables.min.js"></script>
    <script src="/Test/Public/Admin/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="/Test/Public/Admin/js/H-ui.js"></script> 
        <script type="text/javascript" src="/Test/Public/Admin/js/H-ui.admin.js"></script> 
        <script src="/Test/Public/Admin/assets/layer/layer.js" type="text/javascript" ></script>
        <script src="/Test/Public/Admin/assets/laydate/laydate.js" type="text/javascript"></script>
        <script type="text/javascript" src="/Test/Public/Admin/Widget/zTree/js/jquery.ztree.all-3.5.min.js"></script> 
        <script src="/Test/Public/Admin/js/lrtk.js" type="text/javascript" ></script>
<title>产品列表</title>
</head>
<body>
<div class=" page-content clearfix">
    <div id="products_style">
        <div class="search_style"> 
            <ul class="search_content clearfix">
            </ul>
    </div>
        <div class="border clearfix">
            <span class="l_f">
                <a href="<?php echo U('Brand/addBrand');?>" title="添加商品" class="btn btn-warning Order_form"><i class="icon-plus"></i>添加品牌</a>
            </span>

            </div>
            <!--产品列表展示-->
            <div class="h_products_list clearfix" id="products_list">
            <div id="scrollsidebar" class="left_Treeview"></div>  
            </div>
        <div class="table_menu_list" id="testIframe">
            <table class="table table-striped table-bordered table-hover" id="sample-table">
            <thead>
                <tr>
                  <th width="25px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
                  <th width="50px">品牌ID</th>
                  <th width="100px">品牌图片</th>     
                  <th width="250px">产品名称</th>
                  <th width="180px">加入时间</th>                
                  <th width="200px">操作</th>
                  </tr>
            </thead>
              <tbody>
                    <?php if(is_array($brand)): foreach($brand as $k=>$v): ?><tr>
                            <td width="25px">
                                <label><input type="checkbox" class="ace" ><span class="lbl"></span></label>
                            </td>
                            <td width="80px"><?php echo ($v['id']); ?></td>               
                            <td width="100px"><img src="<?php echo ($v['picture']); ?>" style="width:150px;height:150px"></td>        
                            <td width="250px"><u style="cursor:pointer" class="text-primary" onclick=""><?php echo ($v['name']); ?></u></td>
                            <td width="180px"><?php echo date('Y-m-d H:i',$v['addtime']);?></td>
                            <td class="td-manage">
                                <a title="添加分类" onclick="" href="<?php echo U('Brand/addType',['id'=>$v['id']]);?>"  class="btn btn-xs btn-info" >添加分类</a> 
                                <a title="编辑" onclick="" href="<?php echo U('Brand/editBrand',['id'=>$v['id']]);?>"  class="btn btn-xs btn-info" >编辑</a> 
                                <a title="删除" href="#" onclick="del(this,<?php echo ($v['id']); ?>)" class="btn btn-xs btn-warning" ><i class="icon-trash  bigger-120"></i></a>
                            </td>
                      </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
            <!-- 输出分页类 -->
            <div class="pagination">
                <ul> 
                    <?php echo ($page); ?>
                </ul>
            </div>
        </div>     
    </div>
</div>
</body>
</html>
<script>
     //为分页添加分类
    $('.pagination a,.pagination span').unwrap('<div></div>').wrap('<li></li>');
   //ajax删除品牌
    function del(obj, id) {
        $.ajax({
            url:"<?php echo U('Brand/delBrand');?>",
            data:'id='+ id,
            type:'post',
            success:function(res) {
                if(res == 1) {
                    $(obj).parent().parent().remove();
                }
            }
        });
    }
</script>