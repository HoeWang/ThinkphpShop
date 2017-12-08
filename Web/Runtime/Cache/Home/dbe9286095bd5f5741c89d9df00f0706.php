<?php if (!defined('THINK_PATH')) exit();?><div class="order-list">
											
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

							<?php case "待收货": ?><a href="<?php echo U('Order/doGet',['id'=>$v['id']]);?>"><div class="am-btn am-btn-danger anniu">确认收货</div></a><?php break;?>

							<?php case "已完成": ?><a href="<?php echo U('Order/commentList',['id'=>$v['id']]);?>"><div class="am-btn am-btn-danger anniu">立刻评价</div></a><?php break; endswitch;?>
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