<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>购物车页面</title>

		<link href="/Test/Public/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/Test/Public/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="/Test/Public/css/cartstyle.css" rel="stylesheet" type="text/css" />
		<link href="/Test/Public/css/optstyle.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="/Test/Public/js/jquery.js"></script>

	</head>

	<body>
		<div id="top_ad">
			<div></div>
			<a></a>
		</div>
		<div class="hmtop">
			<!--顶部导航条 -->
		
			<div class="am-container header">
				<ul class="message-l">
					<div class="topMessage">
						<div class="menu-hd">
						<?php if(empty($_SESSION['homeInfo'])): ?><a href="<?php echo U('Login/index');?>" target="_top" class="h">亲，请登录</a>
							<a href="<?php echo U('Login/register');?>" target="_top">免费注册</a>
						<?php else: ?>
						您好!　<?php echo ($_SESSION['homeInfo']['username']); ?>,　欢迎来到本站！　　
							<a href="<?php echo U('Login/logout');?>" target="_top" class="h">退出</a><?php endif; ?>
						</div>
					</div>
				</ul>
				<ul class="message-r">
					<div class="topMessage home">
						<div class="menu-hd"><a href="<?php echo U('Index/index');?>" target="_top" class="h">商城首页</a></div>
					</div>
					<?php if(empty($_SESSION['homeInfo'])): else: ?>
						<div class="topMessage my-shangcheng">
						<div class="menu-hd MyShangcheng"><a href="<?php echo U('User/index');?>" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
						</div><?php endif; ?>
					<div class="topMessage mini-cart">
						<div class="menu-hd"><a id="mc-menu-hd" href="<?php echo U('ShopCar/index');?>" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h"><?php echo ($buyNum); ?></strong></a></div>
					</div>
					<div class="topMessage favorite">
						<div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
				</ul>
			</div>
		

				<!--悬浮搜索框-->
		
				<div class="nav white">
					
					<div class="logoBig">
						<li><img src="/Test/Public/images/logobig.png" /></li>
					</div>

					
					<div class="search-bar pr">
						<a name="index_none_header_sysc" href="#"></a>
						<form>
							<input id="searchInput" name="q" type="text" placeholder="<?php echo ($q?$q:'搜索'); ?>" autocomplete="off">
							<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit" onclick="return false">
						</form>
						<div id="my" style="border:1px solid red;position: absolute;z-index: 100;background-color: white;width:525px;display: none"></div>
					<div id="hot" style="position: relative;top: 5px">
						热门搜索:
						<!-- <?php if(is_array($hot)): foreach($hot as $k=>$v): ?>&nbsp&nbsp&nbsp&nbsp
							<a href="<?php echo U('XunSearch/search','q='.$k);?>"><?php echo ($k); ?></a><?php endforeach; endif; ?> -->
					</div>
					<!-- 搜索框JS -->
					<script>

						$('#ai-topsearch').click(function(){search();});

						function search(){
							
							var val = $("#searchInput").val();
							$.ajax({  
						               url:"<?php echo U('XunSearch/judge');?>",            
						               data:{q:val},  
						               // dataType:'string',  
						               type:'post',  
						               async : false, //默认为true 异步  
						               success:function(data){  
						                   //self.data=data;  
						                   //self.doData();  
						                   // console.log(data);  
						                   if (data === false) {
						                   	console.log("1失败");  
						                   	return false;
						                   }
						                   // console.log("1发送成功");  
						                   surl = "<?php echo U('XunSearch/search','q=data');?>"
						                   sur = surl.replace('data',data);
						                   window.location.href = sur;  
						               },
						               error:function(){  
						                   console.log("获取错误");  
						                   return "error";  
						               }  
							});  
						};
					</script>
					<script>
						$(function(){
							// 获取热搜词
							$.ajax({  
						               url:"<?php echo U('XunSearch/hot');?>",            
						               // data:{q:'a'},  
						               // dataType:'string',  
						               type:'post',  
						               async : false, //默认为true 异步  
						               success:function(data){  
						                   //self.data=data;  
						                   //self.doData();  
						                   
						                   if (data.length === 0) {
						                   	// console.log("2失败"); 
						                   	return false;
						                   }
						                   // console.log("2发送成功");  
						                   // console.log(data);
						                   $.each(data, function(i,val){
						                   	console.log(i,val);
						                   	url = "<a href='<?php echo U('XunSearch/search','q=i');?>'>"+i+"</a>";
						                   	str = url.replace('i',i);
						                   	console.log(str);
						                   	$('#hot').append('&nbsp&nbsp&nbsp&nbsp'+str);
						                   });
						               },
						               error:function(){  
						                   console.log("获取错误");  
						                   return "error";  
						               }  
							}); 
						});


						$('#searchInput').keyup(function(){
							
							var a = $("#searchInput").val();
							$.ajax({  
						               url:"<?php echo U('XunSearch/suggest');?>",            
						               data:{q:a},  
						               // dataType:'string',  
						               type:'post',  
						               async : false, //默认为true 异步  
						               success:function(data){  
						                   //self.data=data;  
						                   //self.doData();  
						                   
						                   if (data.length === 0) {
						                   	console.log("失败"); 
						                   	$('#my').hide();

						                   	return false;
						                   }
						                   // console.log("发送成功");  
						                   // console.log(data);
						                   $('#my').show();
						                   
						                   $('#my').empty();

						                   $.each(data, function(i,val){
						                   	$('#my').append("<option>"+val+"</option>");
						                   });

						                   $('#my option').mouseover(function(){
												// console.log(this);
												$(this).css("background-color","yellow");
											});

						                   $('#my option').mouseout(function(){
												// console.log(this);
												$(this).css("background-color","");
											});
						                   
						                   $('#my option').click(function(){
												console.log($(this).html());
												$('#searchInput').val($(this).html());
												$('#my').hide();
											});
						                   
						                   $('#searchInput').focusout(function(){
						                   		$('#my').hide();
						                   });
						               },
						               error:function(){  
						                   console.log("获取错误");  
						                   return "error";  
						               }  
							}); 
							
						});
					</script>
					</div>
					
				</div>

				<div class="clear"></div>
		</div>

	<div style="width:1200px;height:600px;margin:0 auto;">
		<div class="success-top" style="margin-top:50px;">
				<h3 style="font-size:18px;line-height:25px;font-weight:400;color:#5eb95e">商品已成功加入购物车！</h3>
		</div>
		<div style="margin-right:0px;margin-top:50px;float: right;">
			<a class="btn-tobback" href="#" onclick="window.history.back();return false;" style="display: inline-block;height: 34px;line-height: 36px;font-size: 16px;vertical-align: middle;padding: 0 20px;margin-right: 10px;background: #fff;color: #e4393c;border: 1px solid #fff;border:1px solid red;">查看商品详情</a>
			<a class="btn-addtocart" href="<?php echo U('index');?>" id="GotoShoppingCart" style="position: relative;width: 136px;background: #e4393c;border: 1px solid #e4393c;color: #fff;display: inline-block;height: 34px;line-height: 36px;font-size: 16px;vertical-align: middle;text-align: center">去购物车结算&gt</a>
		</div>
	</div>
			
   

		
			<div class="footer ">
				<div class="footer-hd ">
					<p>
						<a href="# ">tan90°</a>
						<b>|</b>
						<a href="<?php echo U('Index/index');?>">商城首页</a>
						<b>|</b>
						<a href="# ">支付宝</a>
						<b>|</b>
						<a href="# ">物流</a>
					</p>
				</div>
				<div class="footer-bd ">
					<p>
						<a href="# ">关于tan90°</a>
						<a href="# ">合作伙伴</a>
						<a href="# ">联系我们</a>
						<a href="# ">网站地图</a>
						<em>© 2015-2025 Hoewang.com 版权所有.<a href="#" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="#" title="网页模板" target="_blank">网页模板</a></em>
					</p>
				</div>
				<div class="foot-bottom">
			       <!--  <div class="supfoot">
			            <p> Copyright 2007 - 2016 vancl.com All Rights Reserved 京ICP证100557号 京公网安备11011502002400号 出版物经营许可证新出发京批字第直110138号</p>
			            <p> 凡客诚品（北京）科技有限公司</p>
			        </div> -->
			        <div class="subfoot">
			        	<?php if(is_array($you)): foreach($you as $key=>$v): ?><a href="<?php echo ($v["ad_link"]); ?>" class="list"><img src="/Test/Public/Uploads/<?php echo ($v["ad_code"]); ?>"></a><?php endforeach; endif; ?>
			            
			        </div>
			    </div>
			</div>
		
				
		<!--引导 -->
		
		<div class="navCir">
			<li class="active"><a href="<?php echo U('Index/index');?>"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="/Test/Public/person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>
		

		<!--菜单 -->
		
	

		<script>
			window.jQuery || document.write('<script src="basic/js/jquery.min.js "><\/script>');
		</script>
		<!--<script type="text/javascript " src="/Test/Public/basic/js/quick_links.js "></script>-->
	</body>

</html>