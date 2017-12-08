<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	
	<head>
	
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>个人资料</title>

		<link href="/Test/Public/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/Test/Public/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/Test/Public/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/Test/Public/css/infstyle.css" rel="stylesheet" type="text/css">
		<script src="/Test/Public/js/jquery.min.js" type="text/javascript"></script>
		<script src="/Test/Public/js/amazeui.js" type="text/javascript"></script>
			
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
					

					<div class="user-info">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
						</div>
						<hr/>

						<!--头像 -->
						<div class="user-infoPic">
						<form class="am-form am-form-horizontal" action="<?php echo U('User/doPerson');?>" method="post" id="change" enctype="multipart/form-data">
							<div class="filePic">
								<input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp"  name="pic" />
								<img class="am-circle am-img-thumbnail" src="<?php echo ($info["head"]); ?>" alt="" style="width:100px;height:100px"/>
							</div>

							<p class="am-form-help">头像</p>

							<div class="info-m">
								<div><b>用户名：<i><?php echo ($info["username"]); ?></i></b></div>
								<div class="u-level">
									<span class="rank r2">
							             <s class="vip1"></s>签到次数:<?php echo ($info["signnum"]); ?>次
						            </span>
								</div>
								<div class="u-safety">
									
									 用户积分
									<span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0"><?php echo ($info["sign"]); ?></i></span>
									
								</div>
								<div class="u-safety">

									
									 用户等级:
									<?php if($info["sign"] > 100): ?><span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0">VIP</i></span>
									<?php else: ?>
									<span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0">普通用户</i></span><?php endif; ?>
									
								</div>
							</div>
						</div>

						<!--个人信息 -->
						<div class="info-main">
							

								<div class="am-form-group">
									<label for="user-name2" class="am-form-label">账号</label>
									<div class="am-form-content">
										<?php echo ($info["username"]); ?>

									</div>
								</div>

								<div class="am-form-group">
									<label for="user-name" class="am-form-label">姓名</label>
									<div class="am-form-content">
										<input type="text" id="user-name2" value="<?php echo ($info["name"]); ?>" name="name">

									</div>
								</div>

								<div class="am-form-group">
									<label class="am-form-label">性别</label>
									<div class="am-form-content sex">
										<label class="am-radio-inline">
										<?php if($info["sex"] == '男'): ?><input type="radio" checked name="sex" value="1" > 男
										<?php else: ?>
											<input type="radio"  name="sex" value="1"> 男<?php endif; ?>
										</label>
										<label class="am-radio-inline">
										<?php if($info["sex"] == '女'): ?><input type="radio" checked name="sex" value="2" > 女
										<?php else: ?>
											<input type="radio" name="sex" value="2" > 女<?php endif; ?>
										</label>
										<label class="am-radio-inline">
										<?php if($info["sex"] == '保密'): ?><input type="radio"  checked name="sex" value="3" > 保密
										<?php else: ?>
											<input type="radio" name="sex" value="3" > 保密<?php endif; ?>
										</label>
									</div>
								</div>

								
								<div class="am-form-group">
									<label for="user-phone" class="am-form-label">电话</label>
									<div class="am-form-content">
										<input id="user-phone" value="<?php echo ($info["phone"]); ?>" type="tel" name="phone">
										
									</div>
								</div>
								<div class="am-form-group">
									<label for="user-email" class="am-form-label">电子邮件</label>
									<div class="am-form-content">
										<input id="user-email" value="<?php echo ($info["email"]); ?>" type="email" name="email">

									</div>
								</div>
								
								
								<div class="info-btn">
									<a href="javascript:document.getElementById('change').submit();"><div class="am-btn am-btn-danger">保存修改</div></a>
								</div>

							</form>
						</div>
					<script type="text/javascript">
					$('#user-phone').change(function(){
						console.log(1);
						var phone = $(this).val();
						$.ajax({
							url:"<?php echo U('User/personage');?>",
							data:"phone="+phone,
							type:"post",
							success:function(res){
								if(res.status == 1){
									var span = $('<span  style="color:green;">'+ res.msg +'</span>');
								}else{
									var span = $('<span  style="color:red;">'+ res.msg +'</span>');
								}
								$('#user-phone + span').remove();
								$('#user-phone').after(span);
							},
							error:function(){
								console.log('miss');
							}

						});

					});


					$('#user-email').change(function(){
						console.log(1);
						var email = $(this).val();
						$.ajax({
							url:"<?php echo U('User/personage');?>",
							data:"email="+email,
							type:"post",
							success:function(res){
								if(res.status == 1){
									var span = $('<span  style="color:green;">'+ res.msg +'</span>');
								}else{
									var span = $('<span  style="color:red;">'+ res.msg +'</span>');
								}
								$('#user-email + span').remove();
								$('#user-email').after(span);
							},
							error:function(){
								console.log('miss');
							}

						});

					});
					</script>
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