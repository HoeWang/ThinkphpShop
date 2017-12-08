<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	
	<head>
	
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

<title>付款成功页面</title>
<link rel="stylesheet"  type="text/css" href="/Test/Public/css/amazeui.css"/>
<link href="/Test/Public/css/admin.css" rel="stylesheet" type="text/css">
<link href="/Test/Public/css/demo.css" rel="stylesheet" type="text/css" />

<link href="/Test/Public/css/sustyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Test/Public/js/jquery-1.7.min.js"></script>

		
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
					



<div class="take-delivery">
 <div class="status">
   <h2>您已成功付款</h2>
   <h3>订单号:<?php echo ($list["oid"]); ?></h3>
   <div class="successInfo">
     <ul>
       <li>付款金额<em>¥<?php echo ($list["total"]); ?></em></li>
       <div class="user-info">
         <p>收货人：<?php echo ($list["receiver"]); ?></p>
         <p>联系电话：<?php echo ($list["phone"]); ?></p>
         <p>收货地址：<?php echo ($list["address"]); ?></p>
       </div>
             请认真核对您的收货信息，如有错误请联系客服
                               
     </ul>
     <div class="option">
       <span class="info">您可以</span>
        <a href="<?php echo U('Order/index');?>" class="J_MakePoint">查看<span>已买到的宝贝</span></a>
        <a href="<?php echo U('Order/orderInfo',['id'=>$list['id']]);?>" class="J_MakePoint">查看<span>交易详情</span></a>
     </div>
    </div>
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
			
		</div>

	</body>

</html>