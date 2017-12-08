<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	
	<head>
	
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>地址管理</title>

		<link href="/Test/Public/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/Test/Public/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/Test/Public/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/Test/Public/css/addstyle.css" rel="stylesheet" type="text/css">
		<script src="/Test/Public/js/jquery.min.js" type="text/javascript"></script>
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
					
<div class="user-address">
	<!--标题 -->
	<div class="am-cf am-padding">
		<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small></div>
	</div>
	<hr/>
	<ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">
		<?php if(is_array($d_address)): foreach($d_address as $key=>$v): ?><li class="user-addresslist <?php echo ($v['default']==2?defaultAddr:''); ?>">
				<span class="new-option-r" name="id" value="<?php echo ($v['id']); ?>"><i class="am-icon-check-circle"></i>默认地址</span>
				<p class="new-tit new-p-re">
					<span class="new-txt"><?php echo ($v['consignee']); ?></span>
					<span class="new-txt-rd2"><?php echo ($v['mobile']); ?></span>
				</p>
				<div class="new-mu_l2a new-p-re">
					<p class="new-mu_l2cw">
						<span class="title">地址：</span>
						<span class="province"><?php echo ($v['province']); ?></span>省
						<span class="city"><?php echo ($v['city']); ?></span>市
						<span class="dist"><?php echo ($v['district']); ?></span>区
						<span class="street"><?php echo ($v['address']); ?></span></p>
				</div>
				<div class="new-addr-btn">
					<a href="<?php echo U('User/goodsAddress',['id'=>$v['id']]);?>"><i class="am-icon-edit"></i>编辑</a>
					<span class="new-addr-bar">|</span>
					<a href="javascript:void(0)" onclick="delClick(this,<?php echo ($v['id']); ?>);"><i class="am-icon-trash"></i>删除</a>
				</div>
			</li><?php endforeach; endif; ?>

	</ul>
	<div class="clear"></div>
	<a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
	<!--例子-->
	<div class="am-modal am-modal-no-btn" id="doc-modal-1">
		<div class="add-dress">

			<!--标题 -->
			<div class="am-cf am-padding">
				<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add&nbsp;address</small></div>
			</div>
			<hr/>
			<div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
				<form class="am-form am-form-horizontal"  id="location" action="<?php echo U('User/addAddress');?>" method="post">
					<!-- 隐藏域传用户ID -->
					<input type="hidden" name="uid" value="<?php echo ($_SESSION[homeInfo][id]); ?>"/>
                    <!-- 隐藏域传修改地址ID -->
                    <input type="hidden" name="id" value="<?php echo ($alterAdd['id']); ?>" />
					<div class="am-form-group">
						<label for="user-name" class="am-form-label">收货人</label>
						<div class="am-form-content">
							<input type="text" id="user-name" placeholder="收货人" name="consignee" value="<?php echo ($alterAdd['consignee']); ?>">
						</div>
					</div>

					<div class="am-form-group">
						<label for="user-phone" class="am-form-label">手机号码</label>
						<div class="am-form-content">
							<input id="user-phone" placeholder="手机号必填" type="text" name="mobile" value="<?php echo ($alterAdd['mobile']); ?>">
						</div>
					</div>
					<div class="am-form-group">
						<label for="user-phone" class="am-form-label">邮政编码</label>
						<div class="am-form-content">
							<input id="user-phone"  placeholder="邮政码必填" type="text" name="zipcode" value="<?php echo ($alterAdd['zipcode']); ?>">
						</div>
					</div>
					<div class="am-form-group">
						<label for="user-address" class="am-form-label">所在地</label>
						<div class="am-form-content address">
							<select  name="province_sl">
								<option value="0">--请选择--</option>
								<?php if(is_array($data)): foreach($data as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v['area_name']); ?></option><?php endforeach; endif; ?>
							</select>
							<input type="hidden" name="province" value="" />
							<select  name="city_sl">
								<option value="0">--请选择--</option>
							</select>
							<input type="hidden" name="city" value="" />
							<select  name="district_sl">
								<option value="0">--请选择--</option>
							</select>
							<input type="hidden" name="district" value="" />
						</div>
					</div>

					<div class="am-form-group">
						<label for="user-intro" class="am-form-label">详细地址</label>
						<div class="am-form-content">
							<textarea class="" rows="3" id="user-intro" placeholder="输入详细地址" name="address" ><?php echo ($alterAdd['address']); ?></textarea>
							<small>100字以内写出你的详细地址...</small>
						</div>
					</div>

					<div class="am-form-group">
						<div class="am-u-sm-9 am-u-sm-push-3">
							<button class="am-btn am-btn-danger">保存</button> 
						</div>
					</div>
				</form>
			</div>

		</div>

	</div>

</div>

<script type="text/javascript">
	$(document).ready(function() {							
		$(".new-option-r").click(function() {
			$(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
		});
		
		var $ww = $(window).width();
		if($ww>640) {
			$("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
		}
		
	})
</script>

<div class="clear"></div>

<script type="text/javascript">
	//三级联动
	var test = document.getElementById('location');
    //绑定事件
    test.province_sl.onchange = function() {
    	$('input[name="province"]').val($("select[name='province_sl'] option:selected").text());
        //清空下级的选项
        test.city.length = 1;
    	test.district.length = 1;
        $.ajax({
            url:"<?php echo U('User/checkRegion');?>",
            data:'id='+this.value,
            type:'post',
            success:function(res) {
                    //循环遍历创建元素
                    for (var i = 0;i < res.length; i++){
                        //创建标签
                        var option = document.createElement('option');
                        //设置值
                        option.value = res[i].id;
                        //设置子类名
                        option.innerHTML = res[i].area_name;

                        //添加到节点树上
                        //找到son下拉框
                        test.city_sl.appendChild(option);
                    }
            },
            error:function(data) {
                alert('错误');
            },
        });
    }

    test.city_sl.onchange = function() {
    	$('input[name="city"]').val($("select[name='city_sl'] option:selected").text());
        //清空下级的选项
        test.district.length = 1;
    
        $.ajax({
            url:"<?php echo U('User/checkRegion');?>",
            data:'id='+this.value,
            type:'post',
            success:function(res) {
                    //循环遍历创建元素
                    for (var i = 0;i < res.length; i++){
                        //创建标签
                        var option = document.createElement('option');
                        //设置值
                        option.value = res[i].id;
                        //设置子类名
                        option.innerHTML = res[i].area_name;

                        //添加到节点树上
                        //找到son下拉框
                        test.district_sl.appendChild(option);
                    }
            },
            error:function(data) {
                alert('错误');
            },
        });
    }

    test.district_sl.onchange = function() {
    	$('input[name="district"]').val($("select[name='district_sl'] option:selected").text());
    }
    var id = 0;
   	// 点击默认地址ajax修改状态
   	$('.new-option-r').click(function() {
   		//获取id
   		 id = $(this).attr('value');
   		$.ajax({
   			url:"<?php echo U('User/addressStatus');?>",
   			data:'id='+id,
   			type:'post',
   			success:function(res) {
   				if(res == 1) {

   				alert('选择成功');
   				}
   			},
   			error:function(cuo) {},
   		});
   	});


    //点击删除。AJAX请求删除
    function delClick(obj,id) {
        //ajax请求
        $.ajax({
            url:"<?php echo U('User/delAddress');?>",
            data:'id='+id,
            type:'post',
            success:function(res) {
                if(res == 1) {
                    $(obj).parent().parent().remove();
                }
            },
            error:function(error){
                alert('删除失败');
            }
        });
    } 
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