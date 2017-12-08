<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<title>注册</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />

		<link rel="stylesheet" href="/Test/Public/css/amazeui.min.css" />
		<link href="/Test/Public/css/dlstyle.css" rel="stylesheet" type="text/css">
		<script src="/Test/Public/js/jquery.min.js"></script>
		<script src="/Test/Public/js/amazeui.min.js"></script>

	</head>

	<body>

		<div class="login-boxtitle">
			<a href="home/demo.html"><img alt="" src="/Test/Public/images/logobig.png" /></a>
		</div>

		<div class="res-banner">
			<div class="res-main">
				<div class="login-banner-bg"><span></span><img src="/Test/Public/images/big.jpg" /></div>
				<div class="login-box" stype="height:540px">

						<div class="am-tabs" id="doc-my-tabs">
							<ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
								<li class="am-active"><a href="">邮箱注册</a></li>
								<li><a href="">账号注册</a></li>
								<li><a href="">手机注册</a></li>
							</ul>

							<div class="am-tabs-bd">
								<div class="am-tab-panel am-active">
									<form method="post" id="form1">
										<input type="hidden" name="mode" value="email">
							    <div class="user-email">
										<label for="email"><i class="am-icon-envelope-o"></i></label>
										<input type="email" name="email" id="email" placeholder="请输入邮箱账号">
                 </div>										
                 <div class="user-pass" id="pass1">
								    <label for="password"><i class="am-icon-lock"></i></label>
								    <input type="password" name="pwd" id="password" placeholder="输入由6-18位数字字母密码">
                 </div>										
                 <div class="user-pass" id="pass2">
								    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
								    <input type="password" name="pwd2" id="passwordRepeat" placeholder="确认密码">
                 </div>	
                 
                 </form>
                 
								 <div class="login-links">
										<label for="reader-me">
											<input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
										</label>
							  	</div>
										<div class="am-cf">
											<input type="submit" name="" id="subb" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl" onclick="document.getElementById('form1').submit()" disabled>
										</div>

								</div>

								<div class="am-tab-panel" id="test2">
									<form method="post" id="form2">
									<input type="hidden" name="mode" value="phone">
                 <div class="user-phone">
								    <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
								    <input type="tel" name="username" id="phone" placeholder="账号">
                 </div>																			
										
                  <div class="user-pass" id="pass1">
								    <label for="password"><i class="am-icon-lock"></i></label>
								    <input type="password" name="pwd" id="password" placeholder="输入由6-18位数字字母密码">
                 </div>										
                 <div class="user-pass" id="pass2">
								    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
								    <input type="password" name="pwd2" id="passwordRepeat" placeholder="确认密码">
                 </div>									
                 	
									</form>
								 <div class="login-links">
										<label for="reader-me">
											<input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
										</label>
							  	</div>
										<div class="am-cf">
											<input type="submit" name="" id="subb" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl" onclick="document.getElementById('form2').submit()" disabled>
										</div>
								
									<hr>
								</div>

								<div class="am-tab-panel" id="test3">
									<form method="post" id="form3" action="<?php echo U('Phone/doAddPhone');?>">
                 <div class="user-phone" id="rephone">
								    <label for="phone2"><i class="am-icon-mobile-phone am-icon-md"></i></label>
								    <input type="tel" name="phone" id="phone2" placeholder="请输入手机号">
                 </div>			

										<div class="verification">
											<label for="codess"><i class="am-icon-code-fork"></i></label>
											<input type="tel" name="code" id="codess" placeholder="请输入验证码">
											
												<span id="dyMobileButton" ><a class="btn" href="javascript:void(0);"  id="sendMobileCode">获取</a></span>

										</div>
                 <div class="user-pass" id="pass1">
								    <label for="password"><i class="am-icon-lock"></i></label>
								    <input type="password" name="pwd" id="password" placeholder="输入由6-18位数字字母密码">
                 </div>										
                 <div class="user-pass" id="pass2">
								    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
								    <input type="password" name="pwd2" id="passwordRepeat" placeholder="确认密码">
                 </div>		
									</form>
								 <div class="login-links">
										<label for="reader-me">
											<input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
										</label>
							  	</div>
										<div class="am-cf">
											<input type="submit" name="" id="subb" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl" onclick="document.getElementById('form3').submit()" disabled>
										</div>
								
									<hr>
								</div>

								<script>
									$(function() {
									    $('#doc-my-tabs').tabs();
									  })
								</script>

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
	//邮箱验证
	$('#email').blur(function(){
		var val = $('#email').val();
		$.ajax({
			url:"<?php echo U('Login/register');?>",
			type:'get',
			data:"email="+val,
			async:true,
			success:function(res){
				if(res.status == 1){
					$('.user-email + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
					var span = $('<span style="color:red;font-size:5px">×' + res.msg +'</span>');
					$('.user-email').after(span);

					test();
				}else{
					$('.user-email + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
					var span = $('<span id="q1" style="color:green;font-size:5px">•'+ val + res.msg +'</span>');
					$('.user-email').after(span.attr('title','1'));

					test();
				}
				//console.log(res.status,res.msg);
			},
			error:function(){
				console.log('miss');
			}
		});
	});

	

	//密码验证：
	$('#password').blur(function(){
		console.log(1);
		var val = $('#password').val();
		var val2 = $('#passwordRepeat').val();
		if(val2){
			var all = {pwd:val,pwd2:val2};
		}else{
			var all = "pwd="+val;
		}
		$.ajax({
			url:"<?php echo U('Login/register');?>",
			type:'get',
			data:all,
			async:true,
			success:function(res){
				if(res.status == 1){
					$('#pass1 + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
					var span = $('<span style="color:red;font-size:5px">×' + res.msg +'</span>');
					$('#pass1').after(span);

					test();

				}else{
					$('#pass1 + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
					var span = $('<span id="q2" style="color:green;font-size:5px">•密码可用</span>');
					$('#pass1').after(span.attr('title','2'));

					test();
				}
				//console.log(res.status,res.msg);
			},
			error:function(){
				console.log('miss');
			}
		});
	});

	$('#passwordRepeat').blur(function(){
		var val = $('#password').val();
		var val2 = $('#passwordRepeat').val();
		if(val2){
			var all = {pwd:val,pwd2:val2};
		}else{
			var all = "pwd="+val;
		}
		$.ajax({
			url:"<?php echo U('Login/register');?>",
			type:'get',
			data:all,
			async:true,
			success:function(res){
				if(res.status == 1){
					$('#pass2 + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
					var span = $('<span style="color:red;font-size:5px">×' + res.msg +'</span>');
					$('#pass2').after(span);

					test();
				}else{
					$('#pass2 + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
					var span = $('<span id="q3" style="color:green;font-size:5px">•密码可用</span>');
					$('#pass2').after(span.attr('title','3'));

					test();

				}
				//console.log(res.status,res.msg);
			},
			error:function(){
				console.log('miss');
			}
		});
		
	});


	$('#reader-me').click(function(){
		console.log($('#q1'));
		// console.log($('#subb').prop('disabled'));
		test();
	});

	var test = function (){
		if($('#reader-me').prop('checked') && $('#q1').attr('title') && $('#q2').attr('title') && $('#q3').attr('title')){

						$('#subb').prop('disabled',false);
					}else{
						$('#subb').prop('disabled',true);
					}
	}


	//账号验证
	$('#phone').blur(function(){
		var val = $('#phone').val();
		$.ajax({
			url:"<?php echo U('Login/register');?>",
			type:'get',
			data:"username="+val,
			async:true,
			success:function(res){
				if(res.status == 1){
					$('.user-phone + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
					var span = $('<span style="color:red;font-size:5px">×' + res.msg +'</span>');
					$('.user-phone').after(span);

					test2();
				}else{
					$('.user-phone + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
					var span = $('<span id="q1" style="color:green;font-size:5px">•'+ val + res.msg +'</span>');
					$('.user-phone').after(span.attr('title','1'));

					test2();
				}
				//console.log(res.status,res.msg);
			},
			error:function(){
				console.log('miss');
			}
		});
	});

	$('#form2 #password').blur(function(){
		console.log(1);
		var val = $('#form2 #password').val();
		var val2 = $('#form2 #passwordRepeat').val();
		if(val2){
			var all = {pwd:val,pwd2:val2};
		}else{
			var all = "pwd="+val;
		}
		$.ajax({
			url:"<?php echo U('Login/register');?>",
			type:'get',
			data:all,
			async:true,
			success:function(res){
				if(res.status == 1){
					$('#form2 #pass1 + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
					var span = $('<span style="color:red;font-size:5px">×' + res.msg +'</span>');
					$('#form2 #pass1').after(span);

					test2();

				}else{
					$('#form2 #pass1 + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
					var span = $('<span id="q2" style="color:green;font-size:5px">•密码可用</span>');
					$('#form2 #pass1').after(span.attr('title','2'));

					test2();
				}
				//console.log(res.status,res.msg);
			},
			error:function(){
				console.log('miss');
			}
		});
	});


	$('#form2 #passwordRepeat').blur(function(){
		var val = $('#form2 #password').val();
		var val2 = $('#form2 #passwordRepeat').val();
		if(val2){
			var all = {pwd:val,pwd2:val2};
		}else{
			var all = "pwd="+val;
		}
		$.ajax({
			url:"<?php echo U('Login/register');?>",
			type:'get',
			data:all,
			async:true,
			success:function(res){
				if(res.status == 1){
					$('#form2 #pass2 + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
					var span = $('<span style="color:red;font-size:5px">×' + res.msg +'</span>');
					$('#form2 #pass2').after(span);

					test2();
				}else{
					$('#form2 #pass2 + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
					var span = $('<span id="q3" style="color:green;font-size:5px">•密码可用</span>');
					$('#form2 #pass2').after(span.attr('title','3'));

					test2();

				}
				//console.log(res.status,res.msg);
			},
			error:function(){
				console.log('miss');
			}
		});
		
	});

	$('#test2 #reader-me').click(function(){
		console.log($('#test2 #q1'));
		// console.log($('#subb').prop('disabled'));
		test2();
	});

	var test2 = function (){
		if($('#test2 #reader-me').prop('checked') && $('#test2 #q1').attr('title') && $('#test2 #q2').attr('title') && $('#test2 #q3').attr('title')){

						$('#test2 #subb').prop('disabled',false);
					}else{
						$('#test2 #subb').prop('disabled',true);
					}
	}


	//手机注册
	//
    //
	
	$('#phone2').blur(function(){
        var val = $('#phone2').val();
		$.ajax({
            url:"<?php echo U('Phone/addPhone');?>",
            type:'get',
            data:"phone=" + val,
            success:function(res){
                console.log(res);
                if(res.status == 2){
                    
                    $('#rephone + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
                    var span = $('<span style="color:red;font-size:5px">×' + res.msg +'</span>');
                    $('#rephone').after(span);

                    test3();
                }else{
                    $('#rephone + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
                    var span = $('<span id="q1" style="color:green;font-size:5px">•' + res.msg +'</span>');
                    $('#rephone').after(span.attr('title','1'));

                    test3();
                }
            },
            error:function(){
                console.log('miss');
            }
        });
	});

    function mt_rand(start, end) {
        var intNum = Math.floor(Math.random() * 1000000000);
        var num = (end - start) + 1;
        var random = (intNum % num) + start ;
        // 返回随机数
        return random;
    }

    var code = null;
    var timer = null;
    $('#dyMobileButton a').click(function(){
        
        if(timer !== null){
            clearInterval(timer);
        }
        
        var val = $('#phone2').val();
        // if($('#test3 #q1')){
        //     alert('请填写正确的手机号');
        //     return false;
        // }
        code = mt_rand(0,9) + mt_rand(0,9)*10 + mt_rand(0,9)*100 + mt_rand(0,9)*1000;            
        console.log(code);
        $.ajax({
            url:"<?php echo U('Phone/doAddPhone');?>",
            type:"get",
            data:{phone:val,code:code},
            success:function(res){
                if(res.msg == "发送失败"){
                    alert('发送失败，请重新发送');
                    clearInterval(timer);
                    
                    $('#dyMobileButton').html('<a class="btn" href="javascript:void(0);"  id="sendMobileCode">重发</a>');
                }else{
                    
                    var i = 60;
        
                    timer = setInterval(function(){
                        $('#dyMobileButton').html(i + 'S');
                        i--;
                        if(i == 0){
                            clearInterval(timer);
                            
                            $('#dyMobileButton').html('<a class="btn" href="javascript:void(0);"  id="sendMobileCode">重发</a>');
                        }
                    },1000);
                }
            },
            error:function(){
                console.log('miss');
            }
        });
    });

    $('#codess').blur(function(){
        var val = $('#codess').val();
        if(val == code){

            $('.verification + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
            var span = $('<span id="q4" style="color:green;font-size:5px">.' + '正确' +'</span>');
            $('.verification').after(span.attr('title','4'));
            test3();
        }else{
            $('.verification + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
            var span = $('<span style="color:red;font-size:5px">.' + '错误或过期' +'</span>');
            $('#dyMobileButton').html('<a class="btn" href="javascript:void(0);"  id="sendMobileCode">重发</a>');
            $('.verification').after(span);
            test3();
                }
        
    });


	$('#form3 #password').blur(function(){
		
		var val = $('#form3 #password').val();
		var val2 = $('#form3 #passwordRepeat').val();
		if(val2){
			var all = {pwd:val,pwd2:val2};
		}else{
			var all = "pwd="+val;
		}
		$.ajax({
			url:"<?php echo U('Login/register');?>",
			type:'get',
			data:all,
			async:true,
			success:function(res){
				
				if(res.status == 1){
					$('#form3 #pass1 + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
					var span = $('<span style="color:red;font-size:5px">×' + res.msg +'</span>');
					$('#form3 #pass1').after(span);

					test3();

				}else{
					$('#form3 #pass1 + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
					var span = $('<span id="q2" style="color:green;font-size:5px">•密码可用</span>');
					$('#form3 #pass1 ').after(span.attr('title','2'));

					test3();
				}
				//console.log(res.status,res.msg);
			},
			error:function(){
				console.log('miss');
			}
		});
	});


	$('#form3 #passwordRepeat').blur(function(){
		
		var val = $('#form3 #password').val();
		var val2 = $('#form3 #passwordRepeat').val();
		if(val2){
			var all = {pwd:val,pwd2:val2};
		}else{
			var all = "pwd="+val;
		}
		$.ajax({
			url:"<?php echo U('Login/register');?>",
			type:'get',
			data:all,
			async:true,
			success:function(res){
				
				if(res.status == 1){
					$('#form3 #pass2 + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
					var span = $('<span style="color:red;font-size:5px">×' + res.msg +'</span>');
					$('#form3 #pass2').after(span);

					test3();
				}else{
					$('#form3 #pass2 + span').remove();//第一个span标签删除，不够完美因为不知道页面中前面还有没有span标签
					var span = $('<span id="q3" style="color:green;font-size:5px">•密码可用</span>');
					$('#form3 #pass2').after(span.attr('title','3'));

					test3();

				}
				//console.log(res.status,res.msg);
			},
			error:function(){
				console.log('miss');
			}
		});
		
	});

	$('#test3 #reader-me').click(function(){
		console.log($('#test3 #q2'));
		// console.log($('#subb').prop('disabled'));
		test3();
	});

	function test3 (){
		if($('#test3 #reader-me').prop('checked') && $('#test3 #q1').attr('title') && $('#test3 #q4').attr('title') && $('#test3 #q2').attr('title') && $('#test3 #q3').attr('title')){       
                    $('#test3 #q1').remove();
                    $('#test3 #q4').remove();
                    $('#test3 #q2').remove();
                    $('#test3 #q3').remove();


				$('#test3 #subb').prop('disabled',false);
			}else{
				$('#test3 #subb').prop('disabled',true);
			}
	}
	</script>

</html>