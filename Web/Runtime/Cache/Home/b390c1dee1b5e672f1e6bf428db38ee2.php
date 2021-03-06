<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	
	<head>
	
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<link href="/Test/Public/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/Test/Public/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/Test/Public/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/Test/Public/css/orstyle.css" rel="stylesheet" type="text/css">

		<script src="/Test/Public/js/jquery.min.js"></script>
		<script src="/Test/Public/js/amazeui.js"></script>
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
					
					<div class="user-order">

						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">订单管理</strong> / <small>Order</small></div>
						</div>
						<hr/>

						<div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>

							<ul class="am-avg-sm-5 am-tabs-nav am-nav am-nav-tabs" id="change">
								<li class="am-active"><a href="#tab1">所有订单</a></li>
								<li><a tid="2" href="#tab2" id="ace">待付款</a></li>
								<li><a tid="3" href="#tab3" id="ace">待发货</a></li>
								<li><a tid="4" href="#tab4" id="ace">待收货</a></li>
								<li><a tid="5" href="#tab5" id="ace">待评价</a></li>
							</ul>

							<div class="am-tabs-bd">
								<div class="am-tab-panel am-fade am-in am-active" id="tab1" >
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
									<div class="order-list">
											
											<!--交易成功-->
											<!--不同状态订单-->
											<?php if(is_array($list)): foreach($list as $key=>$v): ?><div class="order-status3">
												<div class="order-title">
													<div class="dd-num">订单编号：<a href="javascript:;"><?php echo ($v["oid"]); ?></a></div>
													<span>成交时间：<?php echo ($v["addtime"]); ?></span>
													<!--    <em>店铺：小桔灯</em>-->
												</div>
												<div class="order-content">
													<div class="order-left">


												<?php if(is_array($list2)): foreach($list2 as $key=>$v2): if($v2['orderid'] == $v['id']): ?><ul class="item-list">
															<li class="td td-item">
																<div class="item-pic">
																	<a href="<?php echo U('Goods/detail',['id'=>$v2['goodsid']]);?>" class="J_MakePoint">
																		<img src="/Test/<?php echo ($v2["picname"]); ?>" class="itempic J_ItemImg">
																	</a>
																</div>
																<div class="item-info">
																	<div class="item-basic-info">
																		<a href="<?php echo U('Goods/detail',['id'=>$v2['goodsid']]);?>">
																			<p><?php echo ($v2["name"]); ?></p>
																			<p class="info-little">分类：<?php echo ($v2["taste"]); ?>
																				
																		</a>
																	</div>
																</div>
															</li>
															<li class="td td-price">
																<div class="item-price">
																	<?php echo ($v2["price"]); ?>
																</div>
															</li>
															<li class="td td-number">
																<div class="item-number">
																	<span>×</span><?php echo ($v2["num"]); ?>
																</div>
															</li>
															<li class="td td-operation">
																<div class="item-operation">
																	<a href="<?php echo U('Goods/detail',['id'=>$v2['goodsid']]);?>">查看</a>
																</div>
															</li>
														</ul><?php endif; endforeach; endif; ?>



													</div>
													<div class="order-right">
														<li class="td td-amount">
															<div class="item-amount">
																合计：<?php echo ($v["total"]); ?>元
																<p>(包邮)</p>
															</div>
														</li>
														<div class="move-right">
															<li class="td td-status">
																<div class="item-status">
																	<p class="Mystatus"><?php echo ($v["status"]); ?></p>
																	<p class="order-info"><a href="<?php echo U('Order/orderInfo',['id'=> $v['id'] ]);?>">订单详情</a></p>
																	<?php if($v["status"] == '待收货'): ?><p class="order-info"><a href="">查看物流</a></p>
																	
																		<p class="order-info"><a href="#">延长收货</a></p><?php endif; ?>
																</div>
															</li>
															<li class="td td-change">
															<?php switch($v["status"]): case "待付款": ?><a href="<?php echo U('Order/pay',['id'=>$v['id']]);?>"><div class="am-btn am-btn-danger anniu">
																	立即付款</div></a><?php break;?>

																<?php case "待发货": ?><div class="am-btn am-btn-danger anniu">
																	提醒发货</div><?php break;?>

																<?php case "待收货": ?><a href="<?php echo U('Order/doGet',['id'=>$v['id']]);?>"><div class="am-btn am-btn-danger anniu">
																	确认收货</div></a><?php break;?>

																<?php case "已完成": ?><a href="<?php echo U('Order/commentList',['id'=>$v['id']]);?>"><div class="am-btn am-btn-danger anniu">立刻评价</div></a><?php break;?>
																
																<?php case "已评价": ?>已评价<?php break;?>
																<?php case "已失效": ?>已失效<?php break; endswitch;?>
															</li>
														</div>
													</div>
												</div>

											</div><?php endforeach; endif; ?>
		
									
											<div class="order-status1">
											<div class="order-title">
												<div class="pagination" style="position:absolute;left:500px;z-line:10">
										        	<ul>
										          		<?php echo ($btn); ?>
										       		</ul>
												</div>
											</div>
											</div>





									</div>

									</div>
									

								</div>

								<div class="am-tab-panel am-fade" id="tab2" oid="1">

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

									<div class="order-main"></div>
								</div>

								<div class="am-tab-panel am-fade" id="tab3" oid="2">
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

									<div class="order-main"></div>
								</div>

								<div class="am-tab-panel am-fade" id="tab4" oid="3">
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

									<div class="order-main"></div>
								</div>

								<div class="am-tab-panel am-fade" id="tab5" oid="4">
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

									<div class="order-main"></div>

								</div>
							</div>

						</div>
					</div>
					<script type="text/javascript">

						$('.pagination a,.pagination span').unwrap('<div></div>').wrap('<li></li>');


						$('#tab1').delegate('.pagination a','click',function(){
							var pageObj = this;
							var url = pageObj.href;
							$.ajax({
								url:url,
								type:'get',
								success:function(res){
									$('#tab1 .order-main ').html(res);
									
									 $('.pagination a,.pagination span').unwrap('<div></div>').wrap('<li></li>');
								}
							});
							return false;
						});



					$('body').delegate('#change #ace','click',function(){
						var num = $(this).attr('tid');
						// console.log(num,$('#tab'+ num + " .order-main").html());
						if($('#tab'+ num + " .order-main").html() == ''){
							// console.log('ajax');
							var num1 = num - 1;
							
							$.ajax({
								
								url:"<?php echo U('Order/index');?>",
								type:'get',
								data:"status=" + num1,
								success:function(res){
									$('#tab'+ num + " .order-main").html(res);
									$('#tab'+ num + " .order-main .pagination a,.pagination span").unwrap('<div></div>').wrap('<li></li>');
								}
							});

						}
					});

					$('.am-tabs-bd').children().eq(0).siblings().delegate('.pagination a','click',function(){
							console.log(22);
							var pageObj = this;
							var url = pageObj.href;
							var num = $(this).closest('.am-tab-panel');
							$.ajax({
								url:url,
								data:"status=" + num.attr('oid'),
								type:'get',
								success:function(res){
									console.log(num);
									num.find('.order-main').html(res);
									// console.log(res);
									 num.find('.pagination a,.pagination span').unwrap('<div></div>').wrap('<li></li>');
								}
							});
							return false;
						});

					</script>
		
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