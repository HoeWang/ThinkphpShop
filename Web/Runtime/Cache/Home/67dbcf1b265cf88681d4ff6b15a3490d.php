<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<title>登录</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />

		<link rel="stylesheet" href="/Test/Public/css/amazeui.css" />
		<link href="/Test/Public/css/dlstyle.css" rel="stylesheet" type="text/css">
		<script src="/Test/Public/js/jquery.min.js"></script>
		<script src="/Test/Public/js/gt.js"></script>
		<style>
        
        #embed-captcha {
            width: 300px;
            margin: 0 auto;
        }
        .show {
            display: block;
        }
        .hide {
            display: none;
        }
        #notice {
            color: red;
        }
    </style>
	</head>
		
	<body>

		<div class="login-boxtitle">
			<a href="home.html"><img alt="logo" src="/Test/Public/images/logobig.png" /></a>
		</div>

		<div class="login-banner">
			<div class="login-main">
				<div class="login-banner-bg"><span></span><img src="/Test/Public/images/big.jpg" /></div>
				<div class="login-box">

							<h3 class="title">登录商城</h3>

							<div class="clear"></div>
						
						<div class="login-form">
						  <form action="<?php echo U('index');?>" method="post" id="form1">
							   <div class="user-name">
								    <label for="user"><i class="am-icon-user"></i></label>
								    <input type="text" name="username" id="user" placeholder="邮箱/用户名/手机号" />
                 </div>
                 <div class="user-pass">
								    <label for="password"><i class="am-icon-lock"></i></label>
								    <input type="password" name="pwd" id="password" placeholder="请输入密码">
                 </div>
				<div class="yan">
					<div id="embed-captcha"></div>
    				<p id="wait" class="show">正在加载验证码......</p>
    				<p id="notice" class="hide">请先完成验证</p>
               
				</div>
              </form>
           </div>

            

            <div class="login-links">
               <!--  <label for="remember-me"><input id="remember-me" type="checkbox">记住密码</label> -->
								<a href="<?php echo U('Login/repass');?>" class="am-fr">?忘记密码</a>
								<a href="<?php echo U('Login/register');?>" class="zcnext am-fr am-btn-default" >注册</a>
								<br />
            </div>
								<div class="am-cf">
									<input type="submit" name="" value="登 录" id="subbs" class="am-btn am-btn-primary am-btn-sm" onclick="document.getElementById('form1').submit()" disabled>
								</div>
						<div class="partner">		
								<h3>合作账号</h3>
							<div class="am-btn-group">
								<li><a href="#"><i class="am-icon-qq am-icon-sm"></i><span>QQ登录</span></a></li>
								<li><a href="#"><i class="am-icon-weibo am-icon-sm"></i><span>微博登录</span> </a></li>
								<li><a href="#"><i class="am-icon-weixin am-icon-sm"></i><span>微信登录</span> </a></li>
							</div>
						</div>	

				</div>
			</div>
		</div>


					<div class="footer ">
						<div class="footer-hd ">
							<p>
								<a href="# ">恒望科技</a>
								<b>|</b>
								<a href="# ">商城首页</a>
								<b>|</b>
								<a href="# ">支付宝</a>
								<b>|</b>
								<a href="# ">物流</a>
							</p>
						</div>
						<div class="footer-bd ">
							<p>
								<a href="# ">关于恒望</a>
								<a href="# ">合作伙伴</a>
								<a href="# ">联系我们</a>
								<a href="# ">网站地图</a>
								<em>© 2015-2025 Hengwang.com 版权所有. 更多模板 <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></em>
							</p>
						</div>
					</div>
	</body>
<script type="text/javascript">
	// 验证码生成  
		// var captcha_img = $('#captcha-container').find('img')  
		// var verifyimg = captcha_img.attr("src");  
		// captcha_img.attr('title', '点击刷新');  
		// captcha_img.click(function(){  
		//     if( verifyimg.indexOf('?')>0){  
		//         $(this).attr("src", verifyimg+'&random='+Math.random());  
		//     }else{  
		//         $(this).attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());  
		//     }  
		// }); 
		    var handlerEmbed = function (captchaObj) {
        $("#embed-submit").click(function (e) {
            var validate = captchaObj.getValidate();
            if (!validate) {
                $("#notice")[0].className = "show";
                setTimeout(function () {
                    $("#notice")[0].className = "hide";
                }, 2000);
                e.preventDefault();
            }
        });
        // 将验证码加到id为captcha的元素里，同时会有三个input的值：geetest_challenge, geetest_validate, geetest_seccode
        captchaObj.appendTo("#embed-captcha");
        captchaObj.onReady(function () {
            $("#wait")[0].className = "hide";
        });
        // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
    };
    $.ajax({
        // 获取id，challenge，success（是否启用failback）
        url: "<?php echo U('Login/getVerify', ['t'=>time()]);?>", // 加随机数防止缓存
        type: "get",
        dataType: "json",
        success: function (data) {
            console.log(data);
            // 使用initGeetest接口
            // 参数1：配置参数
            // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
            initGeetest({
                gt: data.gt,
                challenge: data.challenge,
                new_captcha: data.new_captcha,
                product: "embed", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
                // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
            }, handlerEmbed);
        }
    });
	//是否生成验证码的判断
	// var str = $('.yan').html();
	// $('body').delegate('#user','blur',function(){
	// 	var val = $('#user').val();
	// 	$.ajax({
	// 		url:"<?php echo U('Login/index');?>",
	// 		type:'get',
	// 		data:"username="+val,
	// 		async:true,
	// 		success:function(res){
	// 			console.log(res);
	// 			if(res == 1){
	// 				$('.yan').html();
					
	// 			}else{
	// 				$('.yan').html('');
	// 			}
	// 		}
	// 	});
	// });
	$(document).on('mouseout',".geetest_slider_button",function(){
		// $('.am-btn am-btn-primary am-btn-sm').prop('disabled',false);
		console.log(1);
		var timer = setTimeout(function(){
			if($('.geetest_success_radar_tip_content').html() == '验证成功'){
			$('#subbs').prop('disabled',false);
		}},2000);
		
	});
// 	$(document).ready(function(){
//     $(".geetest_slider_button").show(function(){
//     	cosole.log(1);
//         	$('.am-btn am-btn-primary am-btn-sm').prop('disabled',false);
//     });
// });
</script>
</html>