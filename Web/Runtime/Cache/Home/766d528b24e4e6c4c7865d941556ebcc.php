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
	<!-- <block name="abc">
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

			<!--购物车 -->
			<div class="concent">
				<div id="cartTable">
					<div class="cart-table-th">
						<div class="wp">
							<div class="th th-chk">
								<div id="J_SelectAll1" class="select-all J_SelectAll">

								</div>
							</div>
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
							<div class="th th-op">
								<div class="td-inner">操作</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>

					<tr class="item-list">
						<div class="bundle  bundle-last ">
							<div class="bundle-hd">
								<div class="bd-promos">
									<div class="bd-has-promo">已享优惠:<span class="bd-has-promo-content"></span>&nbsp;&nbsp;</div>
									<span class="list-change theme-login">编辑</span>
								</div>
							</div>
							<div class="clear"></div>
							<div class="bundle-main">
							<?php if(empty($cartDatas)): ?><ul class="item-content clearfix">
									<li><h3>暂无数据~~~</h3></li>
								</ul>
							<?php else: ?>
							<?php if(is_array($cartDatas)): foreach($cartDatas as $key=>$v): ?><ul class="item-content clearfix">
									<li class="td td-chk">
										<div class="cart-checkbox goodsList">
											<input class="check" id="J_CheckBox_170037950254" name="items[]" value="170037950254" type="checkbox">
											<label for="J_CheckBox_170037950254"></label>
										</div>
									</li>
									<li class="td td-item">
										<div class="item-pic">
											<a href="#" target="_blank" data-title="<?php echo ($v['name']); ?>" class="J_MakePoint" data-point="tbcart.8.12">
												<img src="/Test/<?php echo ($v['cover']); ?>" style="width:80px;height:80px;" class="itempic J_ItemImg"></a>
										</div>
										<div class="item-info">
											<div class="item-basic-info">
												<a href="#" target="_blank" title="<?php echo ($v['subtitle']); ?>" class="item-title J_MakePoint" data-point="tbcart.8.11"><?php echo ($v['subtitle']); ?></a>
											</div>
										</div>
									</li>
									<li class="td td-info">
										<div class="item-props">
											<span class="sku-line">口味：<?php echo ($v['taste']); ?></span>
											<!-- <span class="sku-line">包装：裸装</span> -->
											<i class="theme-login am-icon-sort-desc"></i>
										</div>
									</li>
									<li class="td td-price">
										<div class="item-price price-promo-promo">
											<div class="price-content">
												<div class="price-line">
													<em class="price-original"><?php echo ($v['price']); ?></em>
												</div>
												<div class="price-line">
													<em class="price J_Price price-now" tabindex="0"><?php echo ($v['now_price']); ?></em>
												</div>
											</div>
										</div>
									</li>
									<li class="td td-amount">
										<div class="amount-wrapper">
											<div class="item-amount ">
												<div class="sl">
													<input type="hidden" class="id" value="<?php echo ($v['id']); ?>">
													<input id="min" class="min am-btn" itype="jian" name="" type="button" value="-" />
													<input class="text_box num" name="num" onblur="value=(parseInt((value=value.replace(/\D/g,''))==''||parseInt((value=value.replace(/\D/g,''))==0)?'1':value,10))" onafterpaste="value=(parseInt((value=value.replace(/\D/g,''))==''||parseInt((value=value.replace(/\D/g,''))==0)?'1':value,10))" disabled="true" type="text" value="<?php echo ($v['buyNum']); ?>" style="width:30px;text-align: center" />
													<input id="add" class="add am-btn" name="" type="button" value="+" />
												</div>
											</div>
										</div>
									</li>
									<li class="td td-sum">
										<div class="td-inner">
											<em tabindex="0" class="allprc J_ItemSum number"><?php echo number_format($v['now_price']*$v['buyNum'], 2);?></em>
										</div>
									</li>
									<li class="td td-op">
										<div class="td-inner">
											<a href="javascript:;" data-point-url="#" class="delete">删除</a>
										</div>
									</li>
								</ul><?php endforeach; endif; endif; ?>
							</div>
						</div>
					</tr>
				</div>
				<div class="clear"></div>

				<div class="float-bar-wrapper">
					<div id="J_SelectAll2" class="select-all J_SelectAll">
						<div class="cart-checkbox">
							<input class="check-all check" style="margin-top:20px;" id="selectAll" name="select-all" value="true" type="checkbox">
							<label for="J_SelectAllCbx2"></label>
						</div>
						<span>全选</span>
					</div>
					<div class="operations">
						<!-- <a href="#" hidefocus="true" class="deleteAll">删除</a> -->
						<a href="#" hidefocus="true" class="J_BatchFav">移入收藏夹</a>
					</div>
					<div class="float-bar-right">
						<div class="amount-sum">
							选中商品数:
                    		<span id="count" class="specialItem">
                        		0
                    		</span><span class="txt">件</span>
							<div class="arrow-box">
								<span class="selected-items-arrow"></span>
								<span class="arrow"></span>
							</div>
						</div>
						<div class="price-sum">
							<span class="txt">合计:</span>
							<strong class="price">¥<span id="total" >0.00</span></strong>
						</div>
						<div class="btn-area">
							<a href="<?php echo U('Order/addOrder', ['id'=>$ids]);?>" id="J_Go" class="che submit-btn submit-btn-disabled" aria-label="请注意如果没有选择宝贝，将无法结算">
								<span>结&nbsp;算</span></a>
						</div>
					</div>

				</div>

			</div>	
<script>
	$('.che').click(function(){
		if ($('.check').attr('checked')) {
		    console.log(1);
		} else {
			alert('请选择宝贝去结算');
			return false;
		}
	});

	$('.delete').click(function(){
		a = $(this).closest('ul').find('.id').val();
		b = $(this).closest('ul');
		console.log(a);
		$.ajax({
            url:"<?php echo U('ShopCar/delete');?>",
            data:{'id':a},
            type:'get',
            success:function(res) {
            	if (res == 1) {
            		alert('删除成功');
            		b.remove();
            	}
            },
            error:function(er) {
                alert('获取失败');
            }
       });
	});

	/**
	* 
	*/
	$(function() {
		var adds=$('.add'); //加
		var mins =$('.min');	//减
		var selects = $('.goodsList input[type=checkbox]'); //子input
		var prices =$('.price'); 	//单价
		var nums =$('.num');		//总数

		var num =nums.eq(0).val();
		var price = prices.eq(0).text();
		// console.log(num, price);
		function getTotal(){
			var total=0; //总价格，初始化为0
			//循环每个子input框
			for(var i=0;i<selects.length;i++){
				//每个input框
				var select =selects.eq(i);
				//如果被选中
				if(select.attr("checked")){
					var num =nums.eq(i).val(); //对应input的数量
					var price = prices.eq(i).text(); //对应input的价格
					//总价格 之前input的价格   数量              价格
					total = parseFloat(total)+parseFloat(num)*parseFloat(price);

				}
			}
					mtotal = parseFloat(num)*parseFloat(price);  //小计

			$('#total').text(total.toFixed(2));
			
		};

		function xiaoji(a) {
			var num =a.val(); //对应input的数量
			var price = $(a).closest('.clearfix').find('.price').text(); //对应input的价格
			mtotal = parseFloat(num)*parseFloat(price);
			$(a).closest('.clearfix').find('.allprc').text(mtotal.toFixed(2));
		}

		function getTotal(){
			var total=0; //总价格，初始化为0
			//循环每个子input框
			for(var i=0;i<selects.length;i++){
				//每个input框
				var select =selects.eq(i);
				//如果被选中
				if(select.attr("checked")){
					var num =nums.eq(i).val(); //对应input的数量
					var price = prices.eq(i).text(); //对应input的价格
					//总价格 之前input的价格   数量              价格
					total = parseFloat(total)+parseFloat(num)*parseFloat(price);
					mtotal = parseFloat(num)*parseFloat(price);  //小计

				}
			}

			$('#total').text(total.toFixed(2));
			
		};

		function getCount(){
			var count=0;  //总件
			//同上
			for( var i=0;i<selects.length;i++){
			    if(selects.eq(i).attr("checked")){
			    	var num =nums.eq(i).val();
			        count = count+parseFloat(num);
			    }
			}
			$('#count').text(count);
		}

		selects.click(function(){
			getCount();
			getTotal();
		});


        $('#selectAll').click(function(){
        	for(var i=0;i<selects.length;i++){
                selects.eq(i).attr("checked",$(this).prop('checked'));
            }
            getCount();
                    getTotal();
			$(this).closest('.concent').find('.check').prop('checked', $(this).prop('checked'));
			
		});
		//保存库存数量
		$('body').delegate('.add', 'click', function(){
	        num = Number($(this).prev().val());
	        a = $(this).prev().prev().prev().val();
	        console.log(a);
	        var fuck = $(this).prev();
	        $(this).val();
	        // console.log(num);

	        $.ajax({
	            url:"<?php echo U('ShopCar/changeNum');?>",
	            data:{'id':a,'status':'up','buyNum':num},
	            type:'post',
	            success:function(res) {
	            	// console.log(res);
	            	// console.log(num);
	                if (num > res) {
	                	alert('商品数量不能大于库存');
			            fuck.val(Number(res));
			            
	                } else {
	                	fuck.val(parseInt(num));
	                }
                    fuck.closest('.concent').find('.check').prop('checked', true);
                    xiaoji(fuck);
	                getCount();
                    getTotal();
	            },
	            error:function(er) {
	                alert('获取失败');
	            }
	       });
	    });
		//减
		$('body').delegate('.min', 'click', function(){
	        num = Number($(this).next().val());
	        a = $(this).prev().val();
	        fuck = $(this).next();
	        console.log(num);
	        $(this).val();
	        // console.log(num);
	        $.ajax({
	            url:"<?php echo U('ShopCar/changeNum');?>",
	            data:{'id':a,'status':'down','buyNum':num},
	            type:'post',
	            success:function(res) {
	                if (res == 2) {
	                	alert('商品数量不能小于0');
	                	fuck.val(1);
	        			getTotal();

	                } else {
	                	fuck.val(parseInt(num));
	                }
	                fuck.closest('.concent').find('.check').prop('checked', true);
	                xiaoji(fuck);
	                getCount();
                    getTotal();
	            },
	            error:function(er) {
	                alert('获取失败');
	            }
	       });
	    });

        // nums.on('change',function(){
        //     getTotal();
        // });


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
		
	

		<script>
			window.jQuery || document.write('<script src="basic/js/jquery.min.js "><\/script>');
		</script>
		<!--<script type="text/javascript " src="/Test/Public/basic/js/quick_links.js "></script>-->
	</body>

</html>