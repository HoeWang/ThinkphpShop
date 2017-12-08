<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	
	<head>
	
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">


		<title>结算页面</title>

		<link href="/Test/Public/css/amazeui.css" rel="stylesheet" type="text/css" />

		<link href="/Test/Public/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="/Test/Public/css/cartstyle.css" rel="stylesheet" type="text/css" />

		<link href="/Test/Public/css/jsstyle.css" rel="stylesheet" type="text/css" />
		<script src="/Test/Public/js/jquery.min.js"></script>
		<script type="text/javascript" src="/Test/Public/js/address.js"></script>

			
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
					
		<form id="dopay" method="post" action="<?php echo U('Order/doPay');?>">
			<div class="concent">
				<!--地址 -->
				<div class="paycont">
					<div class="address">
						<h3>确认收货地址 </h3>
						<div class="control">
							<a href="<?php echo U('User/goodsAddress');?>"><div class="tc-btn createAddr theme-login am-btn am-btn-danger">使用新地址</div></a>
						</div>
						<div class="clear"></div>
						<ul>
						<?php if(is_array($address)): foreach($address as $key=>$t): ?><div class="per-border"></div>
							<?php if($t["default"] == 2): ?><li class="user-addresslist defaultAddr">
							<?php else: ?>
							<li class="user-addresslist "><?php endif; ?>
								<div class="address-left">
									<div class="user DefaultAddr">

										<span class="buy-address-detail">   
                   						<span class="buy-user"><?php echo ($t["consignee"]); ?></span>
										<span class="buy-phone"><?php echo ($t["mobile"]); ?></span>
										</span>
									</div>
									<div class="default-address DefaultAddr">
										<span class="buy-line-title buy-line-title-type">收货地址：</span>
										<span class="buy--address-detail">
								   <span class="province"><?php echo ($t["province"]); ?></span>省
										<span class="city"><?php echo ($t["city"]); ?></span>市
										<span class="dist"><?php echo ($t["district"]); ?></span>区
										<span class="street"><?php echo ($t["address"]); ?></span>
										</span>

										</span>
									</div>
									<?php if($t["default"] == 2): ?><ins class="deftip">默认地址</ins><?php endif; ?>
								</div>
								<div class="address-right">
									<a href="/Test/Public/person/address.html">
										<span class="am-icon-angle-right am-icon-lg"></span></a>
								</div>
								<div class="clear"></div>

								

							</li><?php endforeach; endif; ?>
							

						</ul>
						<input type="hidden" name="receiver" value="">
						<input type="hidden" name="phone" value="">
						<input type="hidden" name="address" value="">
						
						<div class="clear"></div>
					</div>
					<!--物流 -->
					
					

					<!--支付方式-->
					<div class="logistics">
						<h3>选择支付方式</h3>
						<ul class="pay-list">
							<li class="pay card"><img src="/Test/Public/images/wangyin.jpg" />银联<span></span></li>
							<li class="pay qq"><img src="/Test/Public/images/weizhifu.jpg" />微信<span></span></li>
							<li class="pay taobao"><img src="/Test/Public/images/zhifubao.jpg" />支付宝<span></span></li>
						</ul>
					</div>
					<div class="clear"></div>

					<!--订单 -->
					<div class="concent">
						<div id="payTable">
							<h3>确认订单信息</h3>
							<div class="cart-table-th">
								<div class="wp">

									<div class="th th-item">
										<div class="td-inner">商品信息</div>
									</div>
									<div class="th th-price">
										<div class="td-inner">单价</div>
									</div>
									<div class="th th-amount">
										<div class="td-inner">数量</div>
									</div>
									<div class="th th-sum">
										<div class="td-inner">金额</div>
									</div>
									<div class="th th-oplist">
										<div class="td-inner">配送方式</div>
									</div>

								</div>
							</div>
							<div class="clear"></div>
						<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr class="item-list">
								<div class="bundle  bundle-last">

									<div class="bundle-main">
										<ul class="item-content clearfix">
											<div class="pay-phone">
												<li class="td td-item">
													<div class="item-pic">
														<a href="#" class="J_MakePoint">
															<img src="/Test/<?php echo ($v["picname"]); ?>" class="itempic J_ItemImg" class="itempic J_ItemImg"></a>
													</div>

													<div class="item-info">
														<div class="item-basic-info">
															<a href="#" class="item-title J_MakePoint" data-point="tbcart.8.11"><?php echo ($v["name"]); ?></a>
														</div>
													</div>
												</li>
												<li class="td td-info">
													<div class="item-props">
														
														<span class="sku-line">类型：<?php echo ($v["taste"]); ?></span>
													</div>
												</li>
												<li class="td td-price">
													<div class="item-price price-promo-promo">
														<div class="price-content">
															<em class="J_Price price-now"><?php echo ($v["price"]); ?></em>
														</div>
													</div>
												</li>
											</div>
											<li class="td td-amount">
												<div class="amount-wrapper ">
													<div class="item-amount ">
														<span class="phone-title">购买数量</span>
														<div class="sl">
															
															<?php echo ($v["num"]); ?>
															
														</div>
													</div>
												</div>
											</li>
											<?php $xiaoji = $v['num'] * $v['price']; ?>
											<li class="td td-sum">
												<div class="td-inner">
													<em tabindex="0" class="J_ItemSum number"><?php echo ($xiaoji); ?>.00</em>
												</div>
											</li>
											<li class="td td-oplist">
												<div class="td-inner">
													<span class="phone-title">配送方式</span>
													<div class="pay-logis">
														快递<b class="sys_item_freprice">(包邮)</b>
													</div>
												</div>
											</li>

										</ul>
										<div class="clear"></div>

									</div>
							</tr>
							<div class="clear"></div>
							</div><?php endforeach; endif; ?>	
							<div class="pay-total">
						<!--留言-->
							<div class="order-extra">
								<div class="order-user-info">
									<div id="holyshit257" class="memo">
										<label>买家留言：</label>
										<input type="text" title="选填,对本次交易的说明（建议填写已经和卖家达成一致的说明）" placeholder="选填,建议填写和卖家达成一致的说明" class="memo-input J_MakePoint c2c-text-default memo-close" name="message">
										<div class="msg hidden J-msg">
											<p class="error">最多输入500个字符</p>
										</div>
									</div>
								</div>

							</div>
							<!--优惠券 -->
							
							<div class="clear"></div>
							</div>
							<!--含运费小计 -->
							<div class="buy-point-discharge ">
								<p class="price g_price ">
									合计（含运费） <span>¥</span><em class="pay-sum"><?php echo ($list2["total"]); ?>元</em>
								</p>
							</div>

							<!--信息 -->
							<div class="order-go clearfix">
								<div class="pay-confirm clearfix">
									<div class="box">
										<div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
											<span class="price g_price ">
                                    <span>¥</span> <em class="style-large-bold-red " id="J_ActualFee"><?php echo ($list2["total"]); ?></em>
											</span>
										</div>

										<div id="holyshit268" class="pay-address">

											
										</div>
									</div>

									<div id="holyshit269" class="submitOrder">
										<div class="go-btn-wrap">
											<a id="J_Go" class="btn-go" tabindex="0" title="点击此按钮，提交订单" href="javascript:document.getElementById('dopay').submit();">确认支付</a>
										</div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>

						<div class="clear"></div>
					</div>
				</div>
				
			</div>
			<input type="hidden" name="id" value="<?php echo ($list2["id"]); ?>">
		</form>
		<script type="text/javascript">
		//初始化form内的隐藏域为默认收货信息
		$("input[name='receiver']").val($('.defaultAddr .buy-user').html());
		$("input[name='phone']").val($('.defaultAddr .buy-phone').html());
		$("input[name='address']").val($('.defaultAddr .province').html() + " " + $('.defaultAddr .city').html() + " " +  $('.defaultAddr .dist').html() + " " +  $('.defaultAddr .street').html());

			
			$('.address').delegate('ul li','click',function(){
				var receiver = $(this).find('.buy-user').html();
				var phone = $(this).find('.buy-phone').html();
				var address = $(this).find('.province').html() + " " + $(this).find('.city').html() + " " + $(this).find('.dist').html() + " " + $(this).find('.street').html();
				
				$("input[name='receiver']").val(receiver);
				$("input[name='phone']").val(phone);
				$("input[name='address']").val(address);
				// console.log(receiver,phone,address);
				console.log($("input[name='address']").val(),$("input[name='phone']").val(),$("input[name='receiver']").val());
				
			});
		</script>
			<div class="clear"></div>
		
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