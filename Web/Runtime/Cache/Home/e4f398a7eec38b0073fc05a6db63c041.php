<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>搜索页面</title>

		<link href="/Test/Public/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/Test/Public/css/admin.css" rel="stylesheet" type="text/css" />

		<link href="/Test/Public/css/demo.css" rel="stylesheet" type="text/css" />

		<link href="/Test/Public/css/seastyle.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="/Test/Public/js/jquery-1.7.min.js"></script>
		<script type="text/javascript" src="/Test/Public/js/script.js"></script>
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

	<b class="line"></b>
           <div class="search">
			<div class="search-list">
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
			
					<div class="am-g am-g-fixed">
						<div class="am-u-sm-12 am-u-md-12">
	                  	<div class="theme-popover">										<?php if(empty($corrected) != true): ?><div class="searchAbout">
									<span class="font-pale" style="font-size: 30px">您是不是要找：</span>
									<?php if(is_array($corrected)): foreach($corrected as $key=>$v): ?><a style="font-size: 30px;color: red" title="" href="<?php echo U('XunSearch/search','q='.$v);?>"><?php echo ($v); ?></a>
										&nbsp&nbsp&nbsp&nbsp<?php endforeach; endif; ?>
								</div>
								<?php elseif((empty($corrected) == true) AND (empty($list) == true)): ?>
								<span class="font-pale" style="font-size: 30px">暂无商品~</span><?php endif; ?>
							<?php if(empty($list) != 'true'): ?><ul class="select">
								<p class="title font-normal">
									<span class="fl"><?php echo ($q); ?></span>
									<span class="total fl">搜索到<strong class="num"><?php echo ($count); ?></strong>件相关商品</span>
								</p>
								<div class="clear"></div>
					        
							</ul><?php endif; ?>
							<div class="clear"></div>
                        </div>
							<div class="search-content">
								<div class="sort">
								<?php if(empty($list) != 'true'): ?><li class="<?php echo empty($sort)?'first':'';?>"><a href="<?php echo U('XunSearch/search','q='.$q);?>" title="综合">综合排序</a></li>
									<li id="sold" class="<?php echo stripos($sort,'sold')!==false?'first':'';?>">
										<a href="javascript:void(0);" title="销量">销量排序</a>
										<input type="hidden" name="<?php echo ($sort); ?>"/>
									</li>
									<li id="price" class="<?php echo stripos($sort,'price')!==false?'first':'';?>">
										<a href="javascript:void(0);" title="价格">价格优先</a>
										<input type="hidden" name="<?php echo ($sort); ?>"/>
									</li>
									<li class="big"><a title="评价" href="javascript:void(0);">评价为主</a></li><?php endif; ?>
								</div>
								<div class="clear"></div>
								
								<!-- 排序 -->
								<script>
									
									// 处理 url 需要的参数
									function dstr() {
										var arr = [];
										

										// 判断搜索语句
										if ($('#searchInput').attr('placeholder')) {
											var q = $('#searchInput').attr('placeholder');
										} else {
											var q = '';
										}
										arr['q'] = q;

										return arr;
									}

									// 按价格排序
									$('#price').click(function(){

										// 判断排序条件
										if ($('#price input').attr('name') === 'price_ASC') {
											var s = 'price_DESC';
										} else {
											var s = 'price_ASC';
										}

										arr = dstr();

										// 处理 url
										url = "<?php echo U('XunSearch/search','q=query&s=sort');?>";
	                   					url = url.replace('query',arr['q']);
	                   					url = url.replace('sort',s);
	                   					
	                   					// 跳转
										window.location.href = url;  
										
									});

									// 按销量排序
									$('#sold').click(function(){

										// 判断排序条件
										if ($('#sold input').attr('name') === 'sold_DESC') {
											var s = 'sold_ASC';
										} else {
											var s = 'sold_DESC';
										}

										arr = dstr();

										// 处理 url
										url = "<?php echo U('XunSearch/search','q=query&s=sort');?>";
	                   					url = url.replace('query',arr['q']);
	                   					url = url.replace('sort',s);
	                   					
	                   					// 跳转
										window.location.href = url;  
										
									});

								</script>
								</if>
								<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">

									<?php if(is_array($list)): foreach($list as $key=>$val): ?><li>
											<div class="i-pic limit">
											<a href="<?php echo U('Goods/detail','id='.$val->id);?>">
												<img src="/Test/Public/Admin/Uploads/<?php echo substr($val->cover,-17);?>" />											
												<p class="title fl"><?php echo ($val->name); ?></p>
												<p class="price fl">
													<b>¥</b>
													<strong><?php echo ($val->price); ?></strong>
												</p>
												<p class="number fl">
													销量<span><?php echo ($val->sold); ?></span>
												</p>
											</a>
											</div>
										</li><?php endforeach; endif; ?>
									
								</ul>
							</div>
							<div class="search-side">

								<div class="side-title">
									经典搭配
								</div>

								<li>
									<div class="i-pic check">
										<img src="/Test/Public/images/cp.jpg" />
										<p class="check-title">萨拉米 1+1小鸡腿</p>
										<p class="price fl">
											<b>¥</b>
											<strong>29.90</strong>
										</p>
										<p class="number fl">
											销量<span>1110</span>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic check">
										<img src="/Test/Public/images/cp2.jpg" />
										<p class="check-title">ZEK 原味海苔</p>
										<p class="price fl">
											<b>¥</b>
											<strong>8.90</strong>
										</p>
										<p class="number fl">
											销量<span>1110</span>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic check">
										<img src="/Test/Public/images/cp.jpg" />
										<p class="check-title">萨拉米 1+1小鸡腿</p>
										<p class="price fl">
											<b>¥</b>
											<strong>29.90</strong>
										</p>
										<p class="number fl">
											销量<span>1110</span>
										</p>
									</div>
								</li>

							</div>
							<div class="clear"></div>

							<div id="ger">
								<?php echo ($pager); ?>
							</div>


							<!-- 分页类样式修改2 -->
							<script>
								var pp = $('<ul class="am-pagination am-pagination-right">').html($('#ger').html());
								pp.replaceAll($('#ger'));
							</script>


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
	</div>

				
		<!--引导 -->
		
		<div class="navCir">
			<li class="active"><a href="<?php echo U('Index/index');?>"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="/Test/Public/person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>
		

		<!--菜单 -->
		
		<div class="tip toolbar-wrap J-wrap">
			<div id="sidebar">
				<div id="wrap">
					<div id="prof" class="item ">
						<a href="# ">
							<span class="setting "></span>
						</a>
						<div class="ibar_login_box status_login ">
							<div class="avatar_box ">
								<p class="avatar_imgbox "><img src="/Test/Public/images/no-img_mid_.jpg " /></p>
								<ul class="user_info ">
									<li>用户名sl1903</li>
									<li>级&nbsp;别普通会员</li>
								</ul>
							</div>
							<div class="login_btnbox ">
								<a href="# " class="login_order ">我的订单</a>
								<a href="# " class="login_favorite ">我的收藏</a>
							</div>
							<i class="icon_arrow_white "></i>
						</div>

					</div>

					<!-- jQuery购物车 -->
					<link rel="stylesheet" href="/Test/Public/shopcar/css/nav.css" type="text/css">
					<!-- <script type="text/javascript" src="/Test/Public/shopcar/js/jquery-1.6.2.min.js"></script> -->
					<script type="text/javascript" src = '/Test/Public/shopcar/js/nav.js'></script>
					<div class="toolbar-panels J-panel">
						<div style="visibility: hidden;" class="J-content toolbar-panel tbar-panel-cart toolbar-animate-out">
							<h3 class="tbar-panel-header J-panel-header">
								<a href="" class="title"><i></i><em class="title">购物车</em></a>
								<span class="close-panel J-close"></span>
							</h3>
							<div class="tbar-panel-main">
								<div class="tbar-panel-content J-panel-content">
									<div id="J-cart-tips" class="tbar-tipbox hide">
										<div class="tip-inner">
											<span class="tip-text">还没有登录，登录后商品将被保存</span>
											<a href="#none" class="tip-btn J-login">登录</a>
										</div>
									</div>
									<?php if(is_array($all)): foreach($all as $key=>$v): ?><div id="J-cart-render">
										<div class="tbar-cart-list">
											<div class="tbar-cart-item" >
												<div class="jtc-item-promo">
													<em class="promo-tag promo-mz">满赠<i class="arrow"></i></em>
													<div class="promo-text">已购满600元，您可领赠品</div>
												</div>
												<div class="jtc-item-goods">
													<span class="p-img"><a href="#" target="_blank"><img src="<?php echo ($v['cover']); ?>" alt="" height="50" width="50" /></a></span>
													<div class="p-name">
														<a href="#"><?php echo ($v['name']); ?></a>
													</div>
													<div class="p-price"><strong>¥<?php echo ($v['now_price']); ?></strong>×<?php echo ($v['buyNum']); ?> </div>
													<a href="#none" class="p-del J-del">删除</a>
												</div>
											</div>
										</div>
									</div><?php endforeach; endif; ?>
								</div>
							</div>
							<div class="tbar-panel-footer J-panel-footer">
								<div class="tbar-checkout">
									<div class="jtc-number"> <strong class="J-count"><?php echo ($buyNum); ?></strong>件商品 </div>
									<div class="jtc-sum"> 共计：<strong class="J-total">¥<?php echo ($count); ?></strong> </div>
									<a class="jtc-btn J-btn" href="<?php echo U('ShopCar/index');?>" target="_blank">去购物车结算</a>
								</div>
							</div>
						</div>
					</div>	
					<div id="shopCart " class="item tbar-tab-cart">
						<a href="# ">
							<span class="message "></span>
						</a>
						<p>
							购物车
						</p>
						<p class="cart_num "><?php echo ($buyNum); ?></p>
					</div>


						<!-- <div class="toolbar-tabs J-tab">
							<div class="toolbar-tab tbar-tab-cart">
								<i class="tab-ico"></i>
								<em class="tab-text ">购物车</em>
								<span class="tab-sub J-count ">3</span>
							</div>
						</div>	 -->	
					<!-- 结束 -->

					<div id="asset " class="item ">
						<a href="# ">
							<span class="view "></span>
						</a>
						<div class="mp_tooltip ">
							我的资产
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="foot " class="item ">
						<a href="# ">
							<span class="zuji "></span>
						</a>
						<div class="mp_tooltip ">
							我的足迹
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="brand " class="item ">
						<a href="#">
							<span class="wdsc "><img src="/Test/Public/images/wdsc.png " /></span>
						</a>
						<div class="mp_tooltip ">
							我的收藏
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="broadcast " class="item ">
						<a href="# ">
							<span class="chongzhi "><img src="/Test/Public/images/chongzhi.png " /></span>
						</a>
						<div class="mp_tooltip ">
							我要充值
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div class="quick_toggle ">
						
						<li class="qtitem ">
							<a href="<?php echo U('Feedback/index');?>"><span class="kfzx "></span></a>
							<div class="mp_tooltip ">客服中心<i class="icon_arrow_right_black "></i></div>
						</li>
						<!--二维码 -->
						<li class="qtitem ">
							<a href="#none "><span class="mpbtn_qrcode "></span></a>
							<div class="mp_qrcode " style="display:none; "><img src="/Test/Public/images/weixin_code_145.png " /><i class="icon_arrow_white "></i></div>
						</li>
						<li class="qtitem ">
							<a href="#top " class="return_top "><span class="top "></span></a>
						</li>
					</div>

					<!--回到顶部 -->
					<div id="quick_links_pop " class="quick_links_pop hide "></div>

				</div>

			</div>
			<div id="prof-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					我
				</div>
			</div>
			<div id="shopCart-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					购物车
				</div>
			</div>
			<div id="asset-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					资产
				</div>

				<div class="ia-head-list ">
					<a href="# " target="_blank " class="pl ">
						<div class="num ">0</div>
						<div class="text ">优惠券</div>
					</a>
					<a href="# " target="_blank " class="pl ">
						<div class="num ">0</div>
						<div class="text ">红包</div>
					</a>
					<a href="# " target="_blank " class="pl money ">
						<div class="num ">￥0</div>
						<div class="text ">余额</div>
					</a>
				</div>

			</div>
			<div id="foot-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					足迹
				</div>
			</div>
			<div id="brand-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					收藏
				</div>
			</div>
			<div id="broadcast-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					充值
				</div>
			</div>
		</div>
		
		<script>
			window.jQuery || document.write('<script src="basic/js/jquery.min.js "><\/script>');
		</script>
		<!--<script type="text/javascript " src="/Test/Public/basic/js/quick_links.js "></script>-->
	</body>

</html>