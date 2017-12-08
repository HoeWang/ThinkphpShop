<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title><?php echo ($seo['0']['description']); ?></title>

		<meta name="description" content="<?php echo ($seo['1']['description']); ?>" />
		
		<meta name="keyword" content="<?php echo ($seo['2']['description']); ?>" />

		<link href="/Test/Public/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/Test/Public/css/admin.css" rel="stylesheet" type="text/css" />

		<link href="/Test/Public/css/demo.css" rel="stylesheet" type="text/css" />

		<link href="/Test/Public/css/hmstyle.css" rel="stylesheet" type="text/css"/>
		<link href="/Test/Public/css/skin.css" rel="stylesheet" type="text/css" />
		<script src="/Test/Public/js/jquery.min.js"></script>
		<script src="/Test/Public/js/amazeui.min.js"></script>

	<!-- 顶部广告样式 -->
	<style type="text/css">
		.top_ad{
			position: relative;
			height: 200px;
			border: 1px solid red;
		}
		.close{
			position: absolute;
			height: 200px;
			right: 40px;
			z-index: 10;
			cursor: default;
		}
	</style>


	<style>
		.foot-bottom{
		    margin:27px 0 20px;
		    /*border-top:1px solid #3e3a39;*/
		}
		.supfoot{
		    margin-top:17px;
		}
		.supfoot p{
		    font-size:12px;
		    color:#3e3a39;
		    line-height:25px;
		    text-align:center;
		}
		.subfoot{
		    width:980px;
		    margin:17px auto 0;
		    //border:1px solid #ccc;
		    text-align:center;
		}
		.subfoot>a{
		    display:inline-block;
		}
		.subfoot>a+a{
		    margin-left:20px;
		}
		
		.list{
		    
		    width:156px;
		    height:45px;
		}
		
	</style>
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

			<div class="banner">
                      <!--轮播 -->
						<div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
							<ul class="am-slides">
								<?php if(is_array($lun)): foreach($lun as $key=>$v): ?><li class="banner1"><a href="<?php echo ($v['ad_link']); ?>"><img src="/Test/Public/Uploads/<?php echo ($v['ad_code']); ?>" /></a></li><?php endforeach; endif; ?>
							</ul>
						</div>
						<div class="clear"></div>	
			</div>
			<div class="shopNav">
				<div class="slideall">
					
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="<?php echo U('Index/index');?>">首页</a></li>
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
		        
						<!--侧边导航 -->
						<div id="nav" class="navfull">
							<div class="area clearfix">
								<div class="category-content" id="guide_2">
									
									<div class="category">
										<ul class="category-list" id="js_climit_li">
										<?php if(is_array($types)): foreach($types as $k=>$v): if($v["pid"] == 0): ?><li class="appliance js_toggle relative first">
												<div class="category-info">
													<h3 class="category-name b-category-name"><i><img src="/Test/Public/images/cake.png"></i><a class="ml-22" title="点心"><?php echo ($v["name"]); ?></a></h3>
													<em>&gt;</em></div>
												<div class="menu-item menu-in top">
													<div class="area-in">
														<div class="area-bg">
															<div class="menu-srot">
																<div class="sort-side">
																<?php if(is_array($types)): foreach($types as $k1=>$v1): if((substr_count($v1['path'],',') == 2) AND ($v['id'] == $v1['pid']) ): ?><dl class="dl-sort">
																		<dt><span title="蛋糕"><?php echo ($v1["name"]); ?></span></dt>
																		<?php if(is_array($types)): foreach($types as $k2=>$v2): if((substr_count($v2['path'],',') == 3) AND ($v1['id'] == $v2['pid']) ): ?><dd><a title="蒸蛋糕" href="<?php echo U('XunSearch/search','q='.$v2['name']);?>"><span><?php echo ($v2["name"]); ?></span></a></dd><?php endif; endforeach; endif; ?>
																	</dl><?php endif; endforeach; endif; ?>
																</div>
																
															</div>
														</div>
													</div>
												</div>
											<b class="arrow"></b>	
											</li><?php endif; endforeach; endif; ?>

											
										</ul>
									</div>
								</div>

							</div>
						</div>
						
						
						<!--轮播-->
						
						<script type="text/javascript">
							(function() {
								$('.am-slider').flexslider();
							});
							$(document).ready(function() {
								$("li").hover(function() {
									$(".category-content .category-list li.first .menu-in").css("display", "none");
									$(".category-content .category-list li.first").removeClass("hover");
									$(this).addClass("hover");
									$(this).children("div.menu-in").css("display", "block")
								}, function() {
									$(this).removeClass("hover")
									$(this).children("div.menu-in").css("display", "none")
								});
							})
						</script>
<script>
	$.ajax({
		url:"<?php echo U('Index/top_ad');?>", 
        type:'post',  
        async : false, //默认为true 异步  
        success:function(data){  
           //self.data=data;  
           //self.doData();  
           
           console.log("发送成功");  
           console.log(data['ad_link']);

           if (data) {
           		console.log('youtu');
           		s = "/Test/Public/Uploads/"+data['ad_code'];
           		console.log(s);
           		$('#top_ad div').html('关闭');
           		$('#top_ad a').append('<img>');
           		// 得到地址 添加到img标签中
           		$('#top_ad img').attr('src',s);
           		$('#top_ad a').attr('href',data['ad_link']);
           } else {
           		console.log('nooo');
           }
           
        },
        error:function(){  
           console.log("获取错误");  
           return "error";  
        }  
	});

	src = $('#top_ad img').attr('src');
	console.log(src);
	if (src) {
		console.log('yes');
		$('#top_ad').addClass('top_ad');
		$('#top_ad div').addClass('close');
		// $('#top_ad').css('height','200px');
		$('#top_ad img').css('height','200px');
		$('.banner').css('top','380px');

		// 点击关闭
		$('#top_ad div').click(function(){
			$('#top_ad').remove();
			$('.banner').css('top','180px');
		});
	} else {
		$('#top_ad').remove();
		console.log('no');
	}
	// adtt = $('#top_ad').html();
	// console.log(adtt);
	// if (adtt.indexOf('img') > 0)
	// {
	// 	console.log(123321);
		
	// }
</script>


					<!--小导航 -->
					<div class="am-g am-g-fixed smallnav">
						<div class="am-u-sm-3">
							<a href="sort.html"><img src="/Test/Public/images/navsmall.jpg" />
								<div class="title">商品分类</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="/Test/Public/images/huismall.jpg" />
								<div class="title">大聚惠</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="/Test/Public/images/mansmall.jpg" />
								<div class="title">个人中心</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="/Test/Public/images/moneysmall.jpg" />
								<div class="title">投资理财</div>
							</a>
						</div>
					</div>
				

					<!--走马灯 -->

					<div class="marqueen">
						<span class="marqueen-title">商城头条</span>
						<div class="demo">

							<ul>
								<li class="title-first"><a target="_blank" href="#">
									<img src="/Test/Public/images/TJ2.jpg"></img>
									<span>[特惠]</span>商城爆品1分秒								
								</a></li>
								<li class="title-first"><a target="_blank" href="#">
									<span>[公告]</span>商城与广州市签署战略合作协议
								     <img src="/Test/Public/images/TJ.jpg"></img>
								     <p>XXXXXXXXXXXXXXXXXX</p>
							    </a></li>
							    
						<div class="mod-vip">
							<div class="m-baseinfo">
								<a href="<?php echo U('User/index');?>">
								<?php if(empty($_SESSION['homeInfo'])): ?><img src="/Test/Public/images/getAvatar.do.jpg">
								<?php else: ?>
									<img src="<?php echo ($_SESSION['homeInfo']['head']); ?>"><?php endif; ?>
								</a>
								<em>
									
									<?php if(empty($_SESSION['homeInfo'])): else: ?>
									Hi,<span class="s-name"><?php echo ($_SESSION['homeInfo']['username']); ?></span><?php endif; ?>
									
									<a href="#"><p>点击更多优惠活动</p></a>									
								</em>
							</div>
							<div class="member-logout">
								
								<?php if(empty($_SESSION['homeInfo'])): ?><a class="am-btn-warning btn" href="<?php echo U('Login/index');?>">登录</a>
									<a class="am-btn-warning btn" href="<?php echo U('Login/register');?>">注册</a>
								<?php else: ?>
									<button class="am-btn-warning btn" id="sign">签到</button>
									<a class="am-btn-warning btn" href="<?php echo U('Login/logout');?>">退出</a><?php endif; ?>
							</div>
							<div class="member-login">
								<a href="#"><strong>0</strong>待收货</a>
								<a href="#"><strong>0</strong>待发货</a>
								<a href="#"><strong>0</strong>待付款</a>
								<a href="#"><strong>0</strong>待评价</a>
							</div>
							<div class="clear"></div>	
						</div>																	    
							    
								<li><a target="_blank" href="#"><span>[特惠]</span>洋河年末大促，低至两件五折</a></li>
								<li><a target="_blank" href="#"><span>[公告]</span>华北、华中部分地区配送延迟</a></li>
								<li><a target="_blank" href="#"><span>[特惠]</span>家电狂欢千亿礼券 买1送1！</a></li>
								
							</ul>
                        <div class="advTip"><img src="/Test/Public/images/advTip.jpg"/></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<script type="text/javascript">
					if ($(window).width() < 640) {
						function autoScroll(obj) {
							$(obj).find("ul").animate({
								marginTop: "-39px"
							}, 500, function() {
								$(this).css({
									marginTop: "0px"
								}).find("li:first").appendTo(this);
							})
						}
						$(function() {
							setInterval('autoScroll(".demo")', 3000);
						})
					}

					$('#sign').click(function(){
						$.ajax({
							url:"<?php echo U('Index/doSign');?>",
							type:'get',
							success:function(res){
				
								$('#sign').html('已签到');
								alert(res.msg);
								

							},
							error:function(){
								console.log('miss');
							}
						});
					});
				</script>
			</div>
			<div class="shopMainbg">
				<div class="shopMain" id="shopmain">

					<!--今日推荐 -->

					<div class="am-g am-g-fixed recommendation">
						<div class="clock am-u-sm-3">
							<img src="/Test/Public/images/2016.png "></img>
							<p>今日<br>推荐</p>
						</div>
						<div class="am-u-sm-4 am-u-lg-3 ">
							<div class="info ">
								<h3>真的有鱼</h3>
								<h4>开年福利篇</h4>
							</div>
							<div class="recommendationMain one">
								<a href="introduction.html"><img src="/Test/Public/images/tj.png "></img></a>
							</div>
						</div>						
						<div class="am-u-sm-4 am-u-lg-3 ">
							<div class="info ">
								<h3>囤货过冬</h3>
								<h4>让爱早回家</h4>
							</div>
							<div class="recommendationMain two">
								<img src="/Test/Public/images/tj1.png "></img>
							</div>
						</div>
						<div class="am-u-sm-4 am-u-lg-3 ">
							<div class="info ">
								<h3>浪漫情人节</h3>
								<h4>甜甜蜜蜜</h4>
							</div>
							<div class="recommendationMain three">
								<img src="/Test/Public/images/tj2.png "></img>
							</div>
						</div>

					</div>
					<div class="clear "></div>
					<!--热门活动 -->

					<div class="am-container activity ">
						<div class="shopTitle ">
							<h4>活动</h4>
							<h3>每期活动 优惠享不停 </h3>
							<span class="more ">
                              <a href="# ">全部活动<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                        </span>
						</div>
					  <div class="am-g am-g-fixed ">
						<div class="am-u-sm-3 ">
							<div class="icon-sale one "></div>	
								<h4>秒杀</h4>							
							<div class="activityMain ">
								<img src="/Test/Public/images/activity1.jpg "></img>
							</div>
							<div class="info ">
								<h3>春节送礼优选</h3>
							</div>														
						</div>
						
						<div class="am-u-sm-3 ">
						  <div class="icon-sale two "></div>	
							<h4>特惠</h4>
							<div class="activityMain ">
								<img src="/Test/Public/images/activity2.jpg "></img>
							</div>
							<div class="info ">
								<h3>春节送礼优选</h3>								
							</div>							
						</div>						
						
						<div class="am-u-sm-3 ">
							<div class="icon-sale three "></div>
							<h4>团购</h4>
							<div class="activityMain ">
								<img src="/Test/Public/images/activity3.jpg "></img>
							</div>
							<div class="info ">
								<h3>春节送礼优选</h3>
							</div>							
						</div>						

						<div class="am-u-sm-3 last ">
							<div class="icon-sale "></div>
							<h4>超值</h4>
							<div class="activityMain ">
								<img src="/Test/Public/images/activity.jpg "></img>
							</div>
							<div class="info ">
								<h3>春节送礼优选</h3>
							</div>													
						</div>

					  </div>
                   </div>
					<div class="clear "></div>


                    <div id="f1">
					<!--甜点-->
					
					<div class="am-container ">
						<div class="shopTitle ">
							<h4>甜品</h4>
							<h3>每一道甜品都有一个故事</h3>
							<div class="today-brands ">
								<a href="# ">桂花糕</a>
								<a href="# ">奶皮酥</a>
								<a href="# ">栗子糕 </a>
								<a href="# ">马卡龙</a>
								<a href="# ">铜锣烧</a>
								<a href="# ">豌豆黄</a>
							</div>
							<span class="more ">
                    <a href="# ">更多美味<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                        </span>
						</div>
					</div>
					
					<div class="am-g am-g-fixed floodFour">
						<div class="am-u-sm-5 am-u-md-4 text-one list ">
							<div class="word">
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>	
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>									
							</div>
							<a href="# ">
								<div class="outer-con ">
									<div class="title ">
									开抢啦！
									</div>
									<div class="sub-title ">
										零食大礼包
									</div>									
								</div>
                                  <img src="/Test/Public/images/load.gif " id="sign"/>								
							</a>
							<div class="triangle-topright"></div>						
						</div>
						
							<div class="am-u-sm-7 am-u-md-4 text-two sug">
								<div class="outer-con ">
									<div class="title ">
										雪之恋和风大福
									</div>									
									<div class="sub-title ">
										¥13.8
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>
								<a href="# "><img src="/Test/Public/images/load.gif" /></a>
							</div>

							<div class="am-u-sm-7 am-u-md-4 text-two">
								<div class="outer-con ">
									<div class="title ">
										雪之恋和风大福
									</div>
									<div class="sub-title ">
										¥13.8
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>
								<a href="# "><img src="/Test/Public/images/load.gif" /></a>
							</div>


						<div class="am-u-sm-3 am-u-md-2 text-three big">
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
							</div>
							<a href="# "><img src="/Test/Public/images/load.gif" /></a>
						</div>

						<div class="am-u-sm-3 am-u-md-2 text-three sug">
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
							</div>
							<a href="# "><img src="/Test/Public/images/load.gif" /></a>
						</div>

						<div class="am-u-sm-3 am-u-md-2 text-three ">
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
							</div>
							<a href="# "><img src="/Test/Public/images/load.gif" /></a>
						</div>

						<div class="am-u-sm-3 am-u-md-2 text-three last big ">
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
							</div>
							<a href="# "><img src="/Test/Public/images/load.gif" /></a>
						</div>

					</div>
                 <div class="clear "></div>  
                 </div>
                 
  				<div id="f2">
					<!--甜点-->
					
					<div class="am-container ">
						<div class="shopTitle ">
							<h4>甜品</h4>
							<h3>每一道甜品都有一个故事</h3>
							<div class="today-brands ">
								<a href="# ">桂花糕</a>
								<a href="# ">奶皮酥</a>
								<a href="# ">栗子糕 </a>
								<a href="# ">马卡龙</a>
								<a href="# ">铜锣烧</a>
								<a href="# ">豌豆黄</a>
							</div>
							<span class="more ">
                    <a href="# ">更多美味<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                        </span>
						</div>
					</div>
					
					<div class="am-g am-g-fixed floodFour">
						<div class="am-u-sm-5 am-u-md-4 text-one list ">
							<div class="word">
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>	
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>									
							</div>
							<a href="# ">
								<div class="outer-con ">
									<div class="title ">
									开抢啦！
									</div>
									<div class="sub-title ">
										零食大礼包
									</div>									
								</div>
                                  <img src="/Test/Public/images/load.gif " id="sign"/>								
							</a>
							<div class="triangle-topright"></div>						
						</div>
						
							<div class="am-u-sm-7 am-u-md-4 text-two sug">
								<div class="outer-con ">
									<div class="title ">
										雪之恋和风大福
									</div>									
									<div class="sub-title ">
										¥13.8
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>
								<a href="# "><img src="/Test/Public/images/load.gif" /></a>
							</div>

							<div class="am-u-sm-7 am-u-md-4 text-two">
								<div class="outer-con ">
									<div class="title ">
										雪之恋和风大福
									</div>
									<div class="sub-title ">
										¥13.8
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>
								<a href="# "><img src="/Test/Public/images/load.gif" /></a>
							</div>


						<div class="am-u-sm-3 am-u-md-2 text-three big">
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
							</div>
							<a href="# "><img src="/Test/Public/images/load.gif" /></a>
						</div>

						<div class="am-u-sm-3 am-u-md-2 text-three sug">
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
							</div>
							<a href="# "><img src="/Test/Public/images/load.gif" /></a>
						</div>

						<div class="am-u-sm-3 am-u-md-2 text-three ">
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
							</div>
							<a href="# "><img src="/Test/Public/images/load.gif" /></a>
						</div>

						<div class="am-u-sm-3 am-u-md-2 text-three last big ">
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
							</div>
							<a href="# "><img src="/Test/Public/images/load.gif" /></a>
						</div>

					</div>
                 <div class="clear "></div>  
                 </div>
                    
				<div id="f3">
					<!--甜点-->
					
					<div class="am-container ">
						<div class="shopTitle ">
							<h4>甜品</h4>
							<h3>每一道甜品都有一个故事</h3>
							<div class="today-brands ">
								<a href="# ">桂花糕</a>
								<a href="# ">奶皮酥</a>
								<a href="# ">栗子糕 </a>
								<a href="# ">马卡龙</a>
								<a href="# ">铜锣烧</a>
								<a href="# ">豌豆黄</a>
							</div>
							<span class="more ">
                    <a href="# ">更多美味<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                        </span>
						</div>
					</div>
					
					<div class="am-g am-g-fixed floodFour">
						<div class="am-u-sm-5 am-u-md-4 text-one list ">
							<div class="word">
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>	
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>									
							</div>
							<a href="# ">
								<div class="outer-con ">
									<div class="title ">
									开抢啦！
									</div>
									<div class="sub-title ">
										零食大礼包
									</div>									
								</div>
                                  <img src="/Test/Public/images/load.gif " id="sign"/>								
							</a>
							<div class="triangle-topright"></div>						
						</div>
						
							<div class="am-u-sm-7 am-u-md-4 text-two sug">
								<div class="outer-con ">
									<div class="title ">
										雪之恋和风大福
									</div>									
									<div class="sub-title ">
										¥13.8
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>
								<a href="# "><img src="/Test/Public/images/load.gif" /></a>
							</div>

							<div class="am-u-sm-7 am-u-md-4 text-two">
								<div class="outer-con ">
									<div class="title ">
										雪之恋和风大福
									</div>
									<div class="sub-title ">
										¥13.8
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>
								<a href="# "><img src="/Test/Public/images/load.gif" /></a>
							</div>


						<div class="am-u-sm-3 am-u-md-2 text-three big">
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
							</div>
							<a href="# "><img src="/Test/Public/images/load.gif" /></a>
						</div>

						<div class="am-u-sm-3 am-u-md-2 text-three sug">
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
							</div>
							<a href="# "><img src="/Test/Public/images/load.gif" /></a>
						</div>

						<div class="am-u-sm-3 am-u-md-2 text-three ">
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
							</div>
							<a href="# "><img src="/Test/Public/images/load.gif" /></a>
						</div>

						<div class="am-u-sm-3 am-u-md-2 text-three last big ">
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
							</div>
							<a href="# "><img src="/Test/Public/images/load.gif" /></a>
						</div>

					</div>
                 <div class="clear "></div>  
                 </div>

                     
  				<div id="f4">
					<!--甜点-->
					
					<div class="am-container ">
						<div class="shopTitle ">
							<h4>甜品</h4>
							<h3>每一道甜品都有一个故事</h3>
							<div class="today-brands ">
								<a href="# ">桂花糕</a>
								<a href="# ">奶皮酥</a>
								<a href="# ">栗子糕 </a>
								<a href="# ">马卡龙</a>
								<a href="# ">铜锣烧</a>
								<a href="# ">豌豆黄</a>
							</div>
							<span class="more ">
                    <a href="# ">更多美味<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                        </span>
						</div>
					</div>
					
					<div class="am-g am-g-fixed floodFour">
						<div class="am-u-sm-5 am-u-md-4 text-one list ">
							<div class="word">
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>	
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>
								<a class="outer" href="#"><span class="inner"><b class="text">核桃</b></span></a>									
							</div>
							<a href="# ">
								<div class="outer-con ">
									<div class="title ">
									开抢啦！
									</div>
									<div class="sub-title ">
										零食大礼包
									</div>									
								</div>
                                  <img src="/Test/Public/images/load.gif " id="sign"/>								
							</a>
							<div class="triangle-topright"></div>						
						</div>
						
							<div class="am-u-sm-7 am-u-md-4 text-two sug">
								<div class="outer-con ">
									<div class="title ">
										雪之恋和风大福
									</div>									
									<div class="sub-title ">
										¥13.8
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>
								<a href="# "><img src="/Test/Public/images/load.gif" /></a>
							</div>

							<div class="am-u-sm-7 am-u-md-4 text-two">
								<div class="outer-con ">
									<div class="title ">
										雪之恋和风大福
									</div>
									<div class="sub-title ">
										¥13.8
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>
								<a href="# "><img src="/Test/Public/images/load.gif" /></a>
							</div>


						<div class="am-u-sm-3 am-u-md-2 text-three big">
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
							</div>
							<a href="# "><img src="/Test/Public/images/load.gif" /></a>
						</div>

						<div class="am-u-sm-3 am-u-md-2 text-three sug">
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
							</div>
							<a href="# "><img src="/Test/Public/images/load.gif" /></a>
						</div>

						<div class="am-u-sm-3 am-u-md-2 text-three ">
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
							</div>
							<a href="# "><img src="/Test/Public/images/load.gif" /></a>
						</div>

						<div class="am-u-sm-3 am-u-md-2 text-three last big ">
							<div class="outer-con ">
								<div class="title ">
									小优布丁
								</div>
								<div class="sub-title ">
									¥4.8
								</div>
								<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
							</div>
							<a href="# "><img src="/Test/Public/images/load.gif" /></a>
						</div>

					</div>
                 <div class="clear "></div>  
                 </div>

                  
	<script type="text/javascript">
	var a = 1;
	
	$(window).scroll(function(){
		var height = Math.floor($(document).scrollTop()/523);

		var span = $('#f' + height + ' img').eq(1);
		var divs = $('#f' + height + ' #sign');
		if(span.attr('src') =='/Test/Public/images/load.gif'&& a == 1 ){
		a = 0;
		
				$.ajax({
					url:"<?php echo U('Index/index');?>",
					type:'get',
					data:"code=" + height,
					success:function(res){
						console.log(res);
						var i = 1;
						var j = 0;
						for( var k in res){
							
							var div = $('#f' + height +" a img");
							div.eq(i).attr('src',"/Test/" + res[k].pic);
							var ids =  Number(res[k].id);
							console.log(typeof(ids),ids);
							 
							div.eq(i).parent().attr('href',"<?php echo U('Goods/detail');?>?id="+ids);


							div.eq(i).parent().prev().children().eq(0).html(res[k].name);
							div.eq(i).parent().prev().children().eq(1).html("￥" + res[k].price);
							divs.parent().prev().children().eq(j).attr('href',"<?php echo U('Goods/detail');?>?id="+ids);
							divs.parent().prev().children().eq(j).children().eq(0).children().eq(0).html(res[k].name);
							 i++;
							 j++;							
						}

						divs.attr('src',"/Test/" + res[1].pic);
						a = 1;
					},
					error:function(){
						console.log('miss');
					}
				});
				
			
		
		
	}

	});
	</script>
   

		
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