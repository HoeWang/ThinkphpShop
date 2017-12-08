<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <title>商品页面</title>

        <link href="/Test/Public/css/admin.css" rel="stylesheet" type="text/css" />
        <link href="/Test/Public/css/amazeui.css" rel="stylesheet" type="text/css" />
        <link href="/Test/Public/css/demo.css" rel="stylesheet" type="text/css" />
        <link type="text/css" href="/Test/Public/css/optstyle.css" rel="stylesheet" />
        <link type="text/css" href="/Test/Public/css/style.css" rel="stylesheet" />
        <link type="text/css" href="/Test/Public/css/paging.css" rel="stylesheet" />
        <script type="text/javascript" src="/Test/Public/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="/Test/Public/js/quick_links.js"></script>
        <script type="text/javascript" src="/Test/Public/js/amazeui.js"></script>
        <script type="text/javascript" src="/Test/Public/js/jquery.imagezoom.min.js"></script>
        <script type="text/javascript" src="/Test/Public/js/jquery.flexslider.js"></script>
        <script type="text/javascript" src="/Test/Public/js/list.js"></script>

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

<!-- 浏览历史 -->
<div   style="position:absolute;right:35px;top:200px;border:1px solid lightgray;width:110px;height:450px;overflow:auto;background:white">
    <center>
        <font color="#b81c22">最近还看了</font>
        <a href="#" id="clear_id">
            <button style="background: #A10000 url() repeat-x;
            display: inline-block;
            padding: 5px 10px 6px;
            color: #fff;
            text-decoration: none;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.6);
            -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.6);
            text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
            border-bottom: 1px solid rgba(0,0,0,0.25);
            position: relative;
            cursor: pointer">清空浏览</button>
        </a>
    </center>
    <hr>
    <center>
        <ul>
            <?php if(is_array($browse)): foreach($browse as $key=>$val): ?><li><hr>
                <a href="<?php echo U('Goods/detail',['id'=>$val['id']]);?>" >
                    <img src="/Test/<?php echo ($val['cover']); ?>?>" width="80" height="80"></a ><br><a href="<?php echo U('Goods/detail',['id'=>$val['id']]);?>">
                    <font size="2">名称:<?php echo ($val['name']); ?></font>
                </a >           
                <div>
                    <span><font size="2" id="sc">售价￥<?php echo number_format($val['promotion_price'],2);?></font></span>
                </div>           
            </li><?php endforeach; endif; ?>
        </ul>
    </center>
</div>
<div class="listMain">
    <ol class="am-breadcrumb am-breadcrumb-slash">
    <!-- 遍历面包屑 -->
        <li><a href="<?php echo U('Index/index');?>">首页</a></li>
        <?php if(is_array($bread)): foreach($bread as $key=>$v): ?><li><a href="#"><?php echo ($v['name']); ?></a></li><?php endforeach; endif; ?>
    </ol>
             
    <script type="text/javascript">
        $(function() {});
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                start: function(slider) {
                    $('body').removeClass('loading');
                }
            });
        });
    </script>
    <div class="scoll">
        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                 <?php if(is_array($h_pictrue)): foreach($h_pictrue as $key=>$val): ?><li class="tb-selected">
                        <div class="tb-pic tb-s40">
                            <a href="#"><img src="/Test/<?php echo ($val['pic']); ?>" mid="/Test/<?php echo ($val['pic']); ?>" big="/Test/<?php echo ($val['pic']); ?>"></a>
                        </div>
                    </li><?php endforeach; endif; ?>
                </ul>
            </div>
        </section>
    </div>
    <!--放大镜-->
    <div class="item-inform">
        <div class="clearfixLeft" id="clearcontent">

            <div class="box">
                <script type="text/javascript">
                    $(document).ready(function() {
                        $(".jqzoom").imagezoom();
                        $("#thumblist li a").click(function() {
                            $(this).parents("li").addClass("tb-selected").siblings().removeClass("tb-selected");
                            $(".jqzoom").attr('src', $(this).find("img").attr("mid"));
                            $(".jqzoom").attr('rel', $(this).find("img").attr("big"));
                        });
                    });
                </script>
                <div class="tb-booth tb-pic tb-s310">
                    <a href="/Test/<?php echo ($h_pictrue[0]['pic']); ?>"><img src="/Test/<?php echo ($h_pictrue[0]['pic']); ?>" alt="细节展示放大镜特效" rel="/Test/<?php echo ($h_pictrue[0]['pic']); ?>" class="jqzoom" /></a>
                </div>
                <ul class="tb-thumb" id="thumblist">
                <?php if(is_array($h_pictrue)): foreach($h_pictrue as $key=>$val): ?><li class="tb-selected">
                        <div class="tb-pic tb-s40">
                            <a href="#"><img src="/Test/<?php echo ($val['pic']); ?>" mid="/Test/<?php echo ($val['pic']); ?>" big="/Test/<?php echo ($val['pic']); ?>"></a>
                        </div>
                    </li><?php endforeach; endif; ?>
                </ul>
            </div>

        <div class="clear"></div>
    </div>
    <div class="clearfixRight">
    <!--规格属性-->
    <!--名称-->
    <div class="tb-detail-hd">
        <h1><?php echo ($h_detail['subtitle']); ?></h1>
    </div>

    <div class="tb-detail-list">
        <!--价格-->
        <div class="tb-detail-price">
            <li class="price iteminfo_price">
                <dt>促销价</dt>
                <dd><em>¥</em><b class="sys_item_price"><?php echo ($h_detail['promotion_price']); ?></b>  </dd>                                 
            </li>
            <li class="price iteminfo_mktprice">
                <dt>原价</dt>
                <dd><em>¥</em><b class="sys_item_mktprice"><?php echo ($h_detail['price']); ?></b></dd>                                   
            </li>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>

        <!--销量-->
        <ul class="tm-ind-panel">
            <li class="tm-ind-item tm-ind-sumCount canClick">
                <div class="tm-indcon"><span class="tm-label">累计销量</span><span class="tm-count"><?php echo ($h_detail['sold']); ?></span></div>
            </li>
            <li class="tm-ind-item tm-ind-reviewCount canClick tm-line3">
                <div class="tm-indcon"><span class="tm-label">累计评价</span><span class="tm-count"><?php echo ($h_detail['comment']); ?></span></div>
            </li>
        </ul>
        <div class="clear"></div>

        <!--各种规格-->
        <dl class="iteminfo_parameter sys_item_specpara">
            <dt class="theme-login"><div class="cart-title">可选规格<span class="am-icon-angle-right"></span></div></dt>
            <dd>
                <!--操作页面-->

                <div class="theme-popover-mask"></div>

                <div class="theme-popover">
                    <div class="theme-span"></div>
                    <div class="" style="background:#fff;">
                        <!-- <a href="javascript:;" id="close"  title="关闭" class="close">关闭</a> -->
                    </div>
                    <div class="theme-popbod dform">
                      <form class="theme-signin" name="loginform" action="<?php echo U('ShopCar/doAction');?>" method="post" id="search_form">

                            <div class="theme-signin-left">
                                <div class="theme-options">
                                    <div class="cart-title">口味</div>
                                    <ul>
                                    <?php if(is_array($h_property)): foreach($h_property as $k=>$asd): ?><li class="sku-line"><?php echo ($asd['taste']); ?><i></i></li>
                                        <input type="hidden" name="pid" value="<?php echo ($asd['id']); ?>"/><?php endforeach; endif; ?>
                                    </ul>
                                    <!-- 隐藏域传属性id -->
                                    <input type="hidden" name="pid" value=""/>
                                </div>
                            
                                <div class="theme-options">
                                    <div class="cart-title number">数量</div>
                                    <dd>
                                        <input id="min" class="am-btn am-btn-default" name="" type="button" value="-" />
                                        <input id="text_box" name="buyNum" onkeyup="details(this)" type="number" value="1" style="width:50px;" />
                                        <input id="add" class="am-btn am-btn-default" name="" type="button" value="+" />
                                        <span id="Stock" class="tb-hidden">库存<span class="stock"><?php echo ($h_property['0']['repertory']); ?></span>件</span>
                                    </dd>
                                </div>
                                <div class="clear"></div>
                            </div>
                            
                    </div>
                </div>

            </dd>
        </dl>
        <div class="clear"></div>
        <!--活动  -->
        <div class="shopPromotion gold">
            <div class="hot">
                <dt class="tb-metatit">店铺优惠</dt>
                <div class="gold-list">
                    <p>购物满2件打8折，满3件7折</p>
                </div>
            </div>
            <div class="clear"></div>
            <div class="coupon">
                <dt class="tb-metatit">优惠券</dt>
                <div class="gold-list">
                    <ul>
                        <li>125减5</li>
                        <li>198减10</li>
                        <li>298减20</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="pay">
        <div class="pay-opt">
            <a href="home.html"><span class="am-icon-home am-icon-fw">首页</span></a>
            <a><span class="am-icon-heart am-icon-fw">收藏</span></a> 
        </div>
        <!-- <li>
            <div class="clearfix tb-btn tb-btn-buy theme-login">
                <a id="LikBuy" title="点此按钮到下一步确认购买信息" href="#">立即购买</a>
            </div>
        </li> -->
        <li>
            <div class="clearfix tb-btn tb-btn-basket theme-login">
                <button id="LikBasket" title="加入购物车"  href="javascript:void(0)"><i></i>加入购物车</button>
            </div>
</form> 
             <div>
                    <?php if($_SESSION['homeInfo']): ?><span id="g_collect" name="collect" onclick="add(this,<?php echo ($h_detail['id']); ?>,<?php echo ($_SESSION['homeInfo']['id']); ?>)" style="width:100px;height:60px;margin-top:50px;">收藏商品
                        </span>
                    <?php else: ?>
                        <span onclick="log(this)" style="width:100px;height:60px;margin-top:50px;">收藏商品
                        </span><?php endif; ?>
                </div>
        </li>
    </div>
    </div>

    <div class="clear"></div>
    </div>              
                            
    <!-- introduce-->

    <div class="introduce">
        <div class="browse">
            <div class="mc"> 
                 <ul>                       
                    <div class="mt">            
                        <h2>看了又看</h2>        
                    </div>
                    
                      <li class="first">
                        <div class="p-img">                    
                            <a  href="#"> <img class="" src="/Test/Public/images/browse1.jpg"> </a>               
                        </div>
                        <div class="p-name"><a href="#">
                            【三只松鼠_开口松子】零食坚果特产炒货东北红松子原味
                        </a>
                        </div>
                        <div class="p-price"><strong>￥35.90</strong></div>
                      </li>
                 </ul>                  
            </div>
        </div>
        <div class="introduceMain">
            <div class="am-tabs" data-am-tabs>
                <ul class="am-avg-sm-3 am-tabs-nav am-nav am-nav-tabs">
                    <li class="am-active">
                        <a href="#" id="goodsDetail" ><span  class="index-needs-dt-txt">宝贝详情</span></a>
                    </li>
                    <li>
                        <a href="#"  id="comment" gid="<?php echo ($h_detail['id']); ?>"><span class="index-needs-dt-txt">全部评价</span></a>
                    </li>
                </ul>

                <div class="am-tabs-bd">
                    <div class="am-tab-panel am-fade am-in am-active">
                        <div class="J_Brand">
                            <div class="attr-list-hd tm-clear">
                                <h4>产品参数：</h4></div>
                            <div class="clear"></div>
                            <ul id="J_AttrUL">
                            <?php if(is_array($h_param)): foreach($h_param as $k=>$v): ?><li title=""><?php echo ($k); ?>:<?php echo ($v); ?></li><?php endforeach; endif; ?>
                            </ul>
                            <div class="clear"></div>
                        </div>

                        <div class="clear"></div>

                    </div>
                    <!-- 评论选项卡 -->
                    <div class="am-tab-panel am-fade" id="goods_comment"></div>

                </div>
            </div>
<!--选中不同口味有不同的库存 -->
<script>
    $('.sku-line').click(function() {
        var val = $(this).text();
        //ajax请求获取不同属性的库存和价格
        $.ajax({
            url:"<?php echo U('Goods/g_Pro');?>",
            type:'post',
            data:"name="+val,
            success:function(res) {
                //得到货存和价格，遍历到对象上
                $('span[class=stock]').text(res.repertory);
                $('b[class=sys_item_price]').text(res.now_price);
            },
            error:function(er) {
                alert('出错');
            }

        });

    });

    //当模板缩小为640px时候，点击可选规格里的关闭，隐藏可选规格
    $('#close').click(function() {
        $('div[class=theme-popover-mask]').css('display','none');
        $('div[class=theme-popover]').css('display','none');
    });

    //点击清空浏览历史时候清空浏览商品历史
    $('#clear_id').click(function() {
        $.ajax({
            url:"<?php echo U('Goods/clearId');?>",
            type: "post",
            success:function(res) {
                if(res == 1){
                    $('#sc').parent().parent().parent().parent().remove();
                }
            },
            error:function(dat){
                alert('删除失败');
            }

        });
    });

    //点击口味时候用隐藏域存ID
    //保存库存
    var selectNum = 0;
    var select = 0;
    $('.sku-line').click(function() {
        selectNum = $(this).next().val()
        $('input[name="pid"]').val(selectNum);
        select = $('input[name="gid"]').val(selectNum);
    });


    //点击添加商品数量。ajax查询库存
    //保存库存数量
    var stock = $('.stock').text(); 
    //保存选择数量
    var num = 1;
   
    $('#add').click(function(){
        num = Number($('#text_box').val()) + 1;
        $.ajax({
            url:"<?php echo U('Goods/stock');?>",
            data:'id='+selectNum,
            type:'post',
            success:function(res) {
                stock = res;
            },
            error:function(er) {
                alert('获取失败');
            }
       });
    });
    $('#min').click(function(){
        num = Number($('#text_box').val()) - 1;
        $.ajax({
            url:"<?php echo U('Goods/stock');?>",
            data:'id='+selectNum,
            type:'post',
            success:function(res) {
                stock = res;
            },
            error:function(er) {
                alert('获取失败');
            }
       });
    });

    //选择数量变成负数和0时候自动返回1
    function details(obj) {
        setTimeout(function(){
            //获取当前商品数量
            min=$(obj).val();
            if (Number(min) < 1) {
                $(obj).val(num);
            }
        },500);
    }

    //点击加入购物车判断

    //判断选择数量是否为空
    $('#text_box').change(function() {
        num = $('#text_box').val();
    });
    $('#LikBasket').click(function() {
        //判断是否选择口味
        if(select) {
            if(num == 1) {
            } else if(num > 1){
                if (Number(num) <= Number(stock)){
                    //库存量满足。成功加入购物车
                    console.log('加入成功');
                } else{
                    //库存不足
                    alert('不好意思库存不足');
                }
            }
        }else {

            alert('请选择口味');return false;
        }

    });

    //收藏开关
    var shut = true;
    //收藏功能
    function add(obj,id,userid) {
        if(shut) {
            //ajax添加收藏
            $.ajax({
                url:"<?php echo U('Goods/addCollect');?>",
                data:{"gid":id,"uid":userid},
                type:'get',
                success:function(res) {
                    if (res == 1) {
                       $(obj).text('商品已收藏');
                       shut = false;
                    }else if(res ==2) {
                        alert('收藏失败');
                    }
                },
                error:function(er) {
                    alert('收藏失败');
                }
            });
        } else {
            //ajax取消收藏
            $.ajax({
                url:"<?php echo U('Goods/reduceCollect');?>",
                data:{"gid":id,"uid":userid},
                type:'get',
                success:function(res) {
                    if (res == 1) {
                       $(obj).text('商品收藏');
                        shut = true;
                    }else if(res ==2) {
                        alert('取消失败');
                    }
                },
                error:function(er) {
                    alert('取消失败');
                }
            });
        }
    }

    /**
     * 判断商品收藏没有登录就去登录页面
     */
    function log(obj) {
        alert('请登录后收藏');
        $(window).attr('location',"<?php echo U('Login/index');?>");
    }

    //选项卡
    
    //绑定事件
    $('body').delegate('#comment','click',function() {
        var num = $(this).attr('gid');
        if ($('#goods_comment').text() == '') {
            $.ajax({
                url: "<?php echo U('Goods/goodsComment');?>",
                data:'gid='+num,
                type:'post',
                success:function(res) {
                    $('#goods_comment').html(res);
                    $('#paging .pagination a,.pagination span').unwrap('<div></div>').wrap('<li></li>');
                }
            });
        }
    });

    //为a标签绑定点击事件    
    $('body').delegate('.pagination a', 'click', function() {
        var ss = $('#comment').attr('gid');
        var pageobj = this;
        var url = pageobj.href;
        $.ajax({
                url: url,
                data: 'gid='+ss,
                type:'post',
                success:function(res) { 
                    $('#goods_comment').html(res);
                    $('#paging .pagination a,.pagination span').unwrap('<div></div>').wrap('<li></li>');
                }
            });
        return false;
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