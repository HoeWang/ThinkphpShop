<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	
	<head>
	
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">


		<title>订单详情</title>

		<link href="/Test/Public/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/Test/Public/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/Test/Public/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/Test/Public/css/orstyle.css" rel="stylesheet" type="text/css">

		<script src="/Test/Public/js/jquery.min.js"></script>
		<script src="/Test/Public/js/amazeui.js"></script>
			
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
					
	
					<div class="user-orderinfo">

						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">订单详情</strong> / <small>Order&nbsp;details</small></div>
						</div>
						<hr/>
						<!--进度条-->
						<div class="m-progress">
							<div class="m-progress-list">
								<span class="step-1 step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                   <p class="stage-name">拍下商品</p>
                                </span>
								
								<?php if($list2["statusNum"] > 2): ?><span class="step-2 step">
								<?php else: ?>
								<span class="step-3 step"><?php endif; ?>
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                   <p class="stage-name">卖家发货</p>
                                </span>


                                <?php if($list2["statusNum"] > 3): ?><span class="step-2 step">
								<?php else: ?>
								<span class="step-3 step"><?php endif; ?>
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">3<em class="bg"></em></i>
                                   <p class="stage-name">确认收货</p>
                                </span>



								<?php if($list2["statusNum"] == 4): ?><span class="step-2 step">
								<?php else: ?>
								<span class="step-3 step"><?php endif; ?>
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">4<em class="bg"></em></i>
                                   <p class="stage-name">交易完成</p>
                                </span>
								<span class="u-progress-placeholder"></span>
							</div>
							<div class="u-progress-bar total-steps-2">
								<div class="u-progress-bar-inner"></div>
							</div>
						</div>
						
						<div class="order-infomain">

							<div class="order-top">
								<div class="th th-item">
									<td class="td-inner">商品</td>
								</div>
								<div class="th th-price">
									<td class="td-inner">单价</td>
								</div>
								<div class="th th-number">
									<td class="td-inner">数量</td>
								</div>
								<div class="th th-operation">
									<td class="td-inner">商品操作</td>
								</div>
								<div class="th th-amount">
									<td class="td-inner">合计</td>
								</div>
								<div class="th th-status">
									<td class="td-inner">交易状态</td>
								</div>
								<div class="th th-change">
									<td class="td-inner">交易操作</td>
								</div>
							</div>

							<div class="order-main">

								<div class="order-status3">
									<div class="order-title">
										<div class="dd-num">订单编号：<a href="javascript:;"><?php echo ($list2["oid"]); ?></a></div>
										<span>成交时间：<?php echo ($list2["addtime"]); ?></span>
										<!--    <em>店铺：小桔灯</em>-->
									</div>
									<div class="order-content">
										<div class="order-left">

										<?php if(is_array($list)): foreach($list as $key=>$v): ?><ul class="item-list">
												<li class="td td-item">
													<div class="item-pic">
														<a href="#" class="J_MakePoint">
															<img src="/Test/<?php echo ($v["picname"]); ?>" class="itempic J_ItemImg">
														</a>
													</div>
													<div class="item-info">
														<div class="item-basic-info">
															<a href="#">
																<p><?php echo ($v["name"]); ?></p>
																<p class="info-little">
																	类型:<?php echo ($v["taste"]); ?>
																</p>
															</a>
														</div>
													</div>
												</li>
												<li class="td td-price">
													<div class="item-price">
														<?php echo ($v["price"]); ?>
													</div>
												</li>
												<li class="td td-number">
													<div class="item-number">
														<span>×</span><?php echo ($v["num"]); ?>
													</div>
												</li>
												<li class="td td-operation">
													<div class="item-operation">
														退款/退货
													</div>
												</li>
											</ul><?php endforeach; endif; ?>	

										</div>
										<div class="order-right">
											<li class="td td-amount">
												<div class="item-amount">
													合计：<?php echo ($list2["total"]); ?>元
													<p>(包邮)</p>
												</div>
											</li>
											<div class="move-right">
												<li class="td td-status">
													<div class="item-status">
														<p class="Mystatus">卖家已发货</p>
														<p class="order-info"><a href="logistics.html">查看物流</a></p>
														
													</div>
												</li>
												<li class="td td-change">
													<?php switch($list2["status"]): case "待付款": ?><a href="<?php echo U('Order/pay',['id'=>$list2['id']]);?>"><div class="am-btn am-btn-danger anniu">
																	立即付款</div></a><?php break;?>

																<?php case "待发货": ?><div class="am-btn am-btn-danger anniu">
																	提醒发货</div><?php break;?>

																<?php case "待收货": ?><a href="<?php echo U('Order/doGet',['id'=>$list2['id']]);?>"><div class="am-btn am-btn-danger anniu">确认收货</div></a><?php break;?>

																<?php case "已完成": ?><a href="<?php echo U('Order/commentList',['id'=>$list2['id']]);?>"><div class="am-btn am-btn-danger anniu">立刻评价</div></a><?php break; endswitch;?>
												</li>
											</div>
										</div>
									</div>

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