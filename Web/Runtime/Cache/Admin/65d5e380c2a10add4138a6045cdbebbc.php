<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="/Test/Public/Admin/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/Test/Public/Admin/css/style.css"/>       
        <link href="/Test/Public/Admin/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/Test/Public/Admin/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/Test/Public/Admin/assets/css/font-awesome.min.css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="/Test/Public/Admin/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="/Test/Public/Admin/assets/css/ace-ie.min.css" />
		<![endif]-->
			<script src="/Test/Public/Admin/assets/js/jquery.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="/Test/Public/Admin/http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="/Test/Public/Admin/assets/js/bootstrap.min.js"></script>
		<script src="/Test/Public/Admin/assets/js/typeahead-bs2.min.js"></script>
		<!-- page specific plugin scripts -->
		<script src="/Test/Public/Admin/assets/js/jquery.dataTables.min.js"></script>
		<script src="/Test/Public/Admin/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="/Test/Public/Admin/js/H-ui.js"></script> 
        <script type="text/javascript" src="/Test/Public/Admin/js/H-ui.admin.js"></script> 
        <script src="/Test/Public/Admin/assets/layer/layer.js" type="text/javascript" ></script>
        <script src="/Test/Public/Admin/assets/laydate/laydate.js" type="text/javascript"></script>
<title>用户列表</title>
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
<div class="page-content clearfix">
    <div id="Member_Ratings">
      <div class="d_Confirm_Order_style">
    <div class="search_style">
     
      
    </div>
     <!---->
     <div class="border clearfix">
       <form class="form-search fr">
          <input type="text" name="username" value="<?php echo I('username');?>" class="input-medium" placeholder="用户名">
          性别:
          <select name="sex">
          <option value="">--请选择--</option>
          <option <?php echo I('get.sex')==2?'selected':'';?> value="2">女</option>
          <option <?php echo I('get.sex')==1?'selected':'';?> value="1">男</option>
          <option <?php echo I('get.sex')==3?'selected':'';?> value="3">未知</option>
          </select>
          状态:
          <select name="status">
          <option value="">--请选择--</option>
          <option <?php echo I('get.status')==1?'selected':'';?> value="1">正常</option>
          <option <?php echo I('get.status')==2?'selected':'';?> value="2">禁止</option>
          <option <?php echo I('get.status')==3?'selected':'';?> value="3">未知</option>
          </select>
          <button type="submit" class="btn">搜索</button>
        </form>
       <span class="r_f">共：<b><?php echo ($count); ?>条</span>
     </div>
     <!---->
     <div class="row-fluid" id="main">
    <div class="span8 offset2">   
        

      <table class="table table-striped" style="width:100%;text-align:center">
        <thead style="text-align:center">
        <tr >
          <th style="width:5%;text-align:center">ID</th>
          <th style="width:10%;text-align:center">用户名</th>
          <th style="width:10%;text-align:center">性别</th>
          <th style="width:15%;text-align:center">邮箱</th>
          <th style="width:15%;text-align:center">手机</th>

          <th style="width:20%;text-align:center">状态</th>

          <th style="width:25%;text-align:center">添加时间</th>
          
        </tr>
        </thead>
        <tbody>
        
        <?php if(empty($list)): ?><tr><td colspan="5"><h3>暂无数据~~~</h3></td></tr>
        <?php else: ?>
        <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr uid="<?php echo ($v['id']); ?>">
            <td><?php echo ($v['id']); ?></td>
            <td><?php echo ($v["username"]); ?></td>
            <td><?php echo ($v['sex']); ?></td>
            <td><?php echo ($v['email']); ?></td>
            <td><?php echo ($v['phone']); ?></td>
            <td><button id="change"><font color="<?php echo ($v['status'] =='正常'?'green':'red'); ?>"><?php echo ($v['status']); ?></font></button></td>
            <td><?php echo ($v['addtime']); ?></td>
            
          </tr><?php endforeach; endif; endif; ?>
          
        </tbody>
      </table>
      <div class="pagination" style="position:relative;left:500px">
        <ul>
          <?php echo ($btn); ?>
        </ul>
      </div>
      <div style="display:none;width:26%;height:293px;border:1px solid lightblue;position:absolute;top:126px;left:370px;background:white">
        <div stylt"margin:0 auto">
        
                <form>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" style="width:200px" name="username">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" style="width:200px" name="pwd">
                  </div>
                  性　别: <select name="sex">
                            <option value="1">男</option>
                            <option value="2">女</option>
                            <option value="3">未知</option>
                          </select><br><br>
                  
                  
                  <button type="submit" class="btn btn-default">Submit</button>
                </form>
        </div>
      </div>
      <script>
        // 假装搞了个样式
        $('.pagination a,.pagination span').unwrap('<div></div>').wrap('<li></li>');

        function del(obj, id)
        {
          var re = confirm('确定删除吗?');
          if(re){
          $.post('<?php echo U("ajaxDel");?>', 'id='+id, function(res){
            if (res.status == 1) {
              $(obj).parent().parent().remove();
            } else {
              alert('删除失败');
            }
          });
        }
        }

        //无刷新分页
    $('body').delegate('.pagination a','click',function(){
      // console.log(1);
        var url = $(this).attr('href');

        $.ajax({
            type:'get',
            url:url,
            success:function(res){
              // console.log(res);
              btn = res.page;
              delete res.page;
              // console.log(btn);
              $('.pagination ul').html(btn);
              $('.pagination a,.pagination span').unwrap('<div></div>').wrap('<li></li>');
              div="<?php if(empty($list)): ?><tr><td colspan='5'><h3>暂无数据~~~</h3></td></tr><?php else: ?>";

              for(var k in res){
                if(res[k].email == null){
                  res[k].email = '';
                }
                if(res[k].phone == null){
                  res[k].phone = '';
                }
                if(res[k].status == "正常"){
                  j = '<td><button id="change"><font color="green">';
                }else{
                  j = '<td><button id="change"><font color="red">';
                }
                div+= "<tr uid='" + res[k].id +"'><td>"+ res[k].id +"</td><td>"+ res[k].username +"</td><td>"+ res[k].sex +"</td><td>"+ res[k].email +"</td><td>"+ res[k].phone +"</td>"+ j + res[k].status +"</font></button></td><td>"+ res[k].addtime +"</td></tr>";
      }
        div = div + "<?php endif; ?>";
              
              $('tbody').html(div);
  //           
            }
        });
        return false;
    });

    //改变状态的请求
    // $('#change').click(function(){
    //   console.log(1);
    // });
    $('body').delegate('#change font','click',function(){
      // console.log($(this).html(),$(this).parent().parent().parent().attr('uid'));
      var val   = $(this).html();
      var val1  = $(this);
      var uid   = $(this).parent().parent().parent().attr('uid');
      $.ajax({
        url:"<?php echo U('changeUser');?>",
        data:{status:val,id:uid},
        async:true,
        type:'get',
        success:function(res){
          if(res == 1){
            val1.html('禁止');
            val1.attr('color','red');
          }else{
            val1.html('正常');
            val1.attr('color','green');
          }
          // console.log(res);
         
        },
        error:function(){
          console.log('miss');
        }

      });
    });

      </script>
    </div>
  </div>
  </div>
 </div>
</div>
<!--添加用户图层-->

</body>
</html>
<script>


</script>