<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	
	<head>
	
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">


		<title>发表评论</title>

		<link href="/Test/Public/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/Test/Public/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/Test/Public/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/Test/Public/css/appstyle.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="/Test/Public/js/jquery-1.7.2.min.js"></script>
			
	</head>
	
	<body>
		<!--头 -->
		<header>
			<article>
				<div class="mt-logo">
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
						<div class="menu-hd"><a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
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
									<input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
									<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
								</form>
							</div>
						</div>

						<div class="clear"></div>
					</div>
				</div>
			</article>
		</header>
            <div class="nav-table">
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="#">首页</a></li>
                                <li class="qc"><a href="#">闪购</a></li>
                                <li class="qc"><a href="#">限时抢</a></li>
                                <li class="qc"><a href="#">团购</a></li>
                                <li class="qc last"><a href="#">大包装</a></li>
							</ul>
						    <div class="nav-extra">
						    	<i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
						    	<i class="am-icon-angle-right" style="padding-left: 10px;"></i>
						    </div>
						</div>
			</div>
			<b class="line"></b>
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">
					

					<div class="user-comment">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">发表评论</strong> / <small>Make&nbsp;Comments</small></div>
						</div>
						<hr/>

						<div class="comment-main">
						<?php if(is_array($list)): foreach($list as $key=>$v): if($v["ping"] == 1): ?><div class="comment-list" gid="<?php echo ($v["goodsid"]); ?>" deid="<?php echo ($v["id"]); ?>">
								<div class="item-pic">
									
										<img src="/Test/<?php echo ($v["picname"]); ?>" class="itempic">
									
								</div>

								<div class="item-title">

									<div class="item-name">
										<a href="#">
											<p class="item-basic-info"><?php echo ($v["name"]); ?></p>
										</a>
									</div>
									<div class="item-info">
										<div class="info-little">
											规格:<span><?php echo ($v["taste"]); ?></span>
											
										</div>
										<div class="item-price">
											价格：<strong><?php echo ($v["price"]); ?>元</strong>
										</div>										
									</div>
								</div>
								<div class="clear"></div>
								<div class="item-comment">
									<textarea placeholder="请写下对宝贝的感受吧，对他人帮助很大哦！"></textarea>
								</div>
								<div class="info-btn">
									<a href="javascript:void(0)" id="subb"><div class="am-btn am-btn-danger">发表评论</div></a>
								</div>	
								<div class="item-opinion">
									<li><i class="op1 active"></i>好评</li>
									<li><i class="op2"></i>中评</li>
									<li><i class="op3"></i>差评</li>
								</div>
							</div><?php endif; endforeach; endif; ?>
							
							


															
					<script type="text/javascript">
						$(document).ready(function() {
							$(".comment-list .item-opinion li").click(function() {	
								$(this).prevAll().children('i').removeClass("active");
								$(this).nextAll().children('i').removeClass("active");
								$(this).children('i').addClass("active");
								
							});
				     })
						//评论
						$('.comment-main').delegate('#subb','click',function(){
							//获取好评以及差评
							
							var level = $(this).parent().next().find('.active').parent().text();
							
							if(level == "好评"){
								level = 1;
							}else if(level == "中评"){
								level = 2;
							}else{
								level = 2;
							}
							// console.log($(this).parent().prev().children().eq(0).val());
							var content = $(this).parent().prev().children().eq(0).val();
							var gid = $(this).closest('.comment-list').attr('gid');
							var id = $(this).closest('.comment-list').attr('deid');
							var val = {};
							val.content = content;
							val.gid = gid;
							val.id = id;
							$.ajax({
								url:"<?php echo U('Order/doComment');?>",
								data:val,
								type:'get',
								success:function(res){
									// console.log(res);
									if(res.status == 1){
										$('div[deid="'+ res.deid +'"]').remove();
										alert('评论成功');
									}else{
										alert('评论失败');
									}
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
				<!--底部-->
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
			</div>
			</div>
			
			<aside class="menu">
				<ul>
					<li class="person">
						<a href="index.html">个人中心</a>
					</li>
					<li class="person">
						<a href="#">个人资料</a>
						<ul>
							<li> <a href="<?php echo U('User/personage');?>">个人信息</a></li>

							<li> <a href="<?php echo U('User/changePass');?>">密码修改</a></li>
							<li> <a href="safety.html">安全设置</a></li>
							<li> <a href="<?php echo U('User/goodsAddress');?>">收货地址</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="#">我的交易</a>
						<ul>
							<li ><a href="<?php echo U('Order/index');?>">订单管理</a></li>
							<li> <a href="#">退款售后</a></li>
							<li class="active"><a href="<?php echo U('Order/index');?>">订单管理</a></li>
<!-- 							<li> <a href="change.html">退款售后</a></li> -->
						</ul>
					</li>

					<li class="person">
						<a href="#">我的小窝</a>
						<ul>
							<li> <a href="<?php echo U('User/collect');?>">收藏</a></li>
<!-- 							<li> <a href="foot.html">足迹</a></li> -->
							<li> <a href="comment.html">评价</a></li>
						</ul>
					</li>

				</ul>

			</aside>
			
		</div>

	</body>

</html>