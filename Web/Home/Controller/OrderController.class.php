<?php
namespace Home\Controller;
use Think\Controller;
use Think\Cache\Driver\Redis;
class OrderController extends CommonController
{
	/**
	 * 订单列表首页
	 */
	public function index(){
		
			$id = session('homeInfo.id');
			$order = D('Orders');

			$map['uid'] =['eq',$id];
			if(I('get.status') != null || strlen(I('get.status')) > 0){
			$map['status'] = ['eq',I('get.status')];
			}

			$count = $order->where($map)->count();
		

		$page = new \Think\Page($count,5);
		
		$page->setConfig('prev','上一页');
		$page->setConfig('next','下一页');
		$btn = $page->show();
		$arr = $order->where($map)->limit($page->firstRow,$page->listRows)->order('id desc')->getData();
		$arr2 = $order->getDetail();
			// dump($arr);
		if(IS_AJAX){
			$this->assign('btn',$btn);
			$this->assign('list',$arr);
			$this->assign('list2',$arr2);

			$html = $this->fetch('Order/ajaxPage');
			$this->ajaxReturn($html);
		}
			$this->assign('btn',$btn);
			$this->assign('list',$arr);
			$this->assign('list2',$arr2);
			$this->display('Order/order');
		
		
		
	}
	/**
	 * 订单详情页
	 * @return [type] [description]
	 */
	public function orderInfo(){
		$order = D('Orders');
		$user = $order->find(I('get.id'));
		if($user['uid'] == session('homeInfo.id')){
			$id = I('get.id');
			
			$arr = $order->Detail($id);
			$arr2 = $order->where('id='.$id)->getData();

			$arr2 = $arr2[0];
			
			$this->assign('list',$arr);
			$this->assign('list2',$arr2);
			$this->display('Order/orderinfo');
		}else{
			$this->error('请勿非法操作');
		}
	}

	/**
	 * 支付页面
	 */
	public function pay(){
		$id = I('get.id');
		

		//收货地址
		$address =M('Address');
		$default_ad = $address->field('default,zipcode,consignee,province,city,district,id,address,mobile')->where(['uid'=>$_SESSION['homeInfo']['id']])->order('id desc')->select();

		
		$order = D('Orders');
		$arr = $order->Detail($id);
		$arr2 = $order->where('id='.$id)->getData();

		$arr2 = $arr2[0];
		
		$this->assign('address',$default_ad);
		$this->assign('list',$arr);
		$this->assign('list2',$arr2);
		$this->display('Order/pay');
	}

	/**
	 * 支付处理
	 */
	public function doPay(){
		$user = M('User');
		$post = I('post.');
		$post['status'] = 2;
		$order = D('Orders');
		$orders = M('Orders');
		$arr = $orders->find($post['id']);

		$num = $arr['total']/10;


		$res = $order->changeStatus($post);
		if($res){
			$user->where('id='.session('homeInfo.id'))->setInc('sign',$num);
			// dump(1);
			$this->redirect('Order/success',['id'=>$post['id']]);
		}else{
			$this->error('支付失败');
		}
	}
	/**
	 * 支付成功页
	 */
	public function success(){
		
		$order = M('Orders');
		$arr = $order->find(I('get.id'));
		$this->assign('list',$arr);
		$this->display('Order/success');
	}

	/**
	 * 收货处理
	 */
	public function doGet(){
		$order = D('Orders');
		$user = $order->find(I('get.id'));
		if($user['uid'] == session('homeInfo.id')){
			$arr['id'] = I('get.id');
			$arr['status'] = 4;
			$res = $order->changeStatus($arr);
			if($res){
				$this->redirect('Order/commentList',['id'=>I('get.id')]);
			}else{
				$this->error('确认收货失败!请重新再来！');
			}
		}else{
			$this->error('请勿非法操作');
		}
	}


	/**
	 * 生成订单
	 */
	public function addOrder(){
		$arr = json_decode($_GET['id']);
		$redis = new Redis();
		foreach ($arr as $k => $v) {
			$cartKey = 'cart:datas::'.session_id().':'.$v;
			$cartDatas[] = $redis->hGetAll($cartKey);
		}
		foreach ($cartDatas as $key => $val) {
			$buyNum[] = $val['buyNum'];
		}
		for ($i = 0; $i < count($arr); $i++) {
			$test[] = ['id'=>$arr[$i], 'num'=>$buyNum[$i]];
		}
		session('shopcar',$test);
		if(!session('homeInfo')){
			$this->error('请登录后再进行下单',U('Login/index'));
		}
		$GoodsDetail = M('GoodsProperty');
		$Goods = M('Goods');
		$detail = M('Detail');
		//生成订单
		foreach(session('shopcar') as $v){
			//判断库存和提交过来的对比
			//商品的详情数据
			$info = $GoodsDetail->find($v['id']);
			$total += $info['now_price']*$v['num'];
			//订单数据
		}
			$res['total'] = $total;
			$res['addtime'] = time();
			$res['uid'] = session('homeInfo.id');
			$res['oid'] = session('homeInfo.id').date('His',time());
			
			$order = M('Orders');
			//开启事务
			$order->startTrans();
			$ids = $order->add($res); 
			if(!$ids){
				$order->rollback();
				$this->error('下单失败');
			}
		foreach(session('shopcar') as $v){
			//判断库存和提交过来的对比
			//商品的详情数据
			$info = $GoodsDetail->find($v['id']);
			//商品数据
			$info2 = $Goods->find($info['gid']); 
			$result = $Goods->where('id='.$info2['id'])->setInc('sold',$v['num']);
			if($v['num'] > $info['repertory']){
				$this->error('商品库存不足');
			}
			//订单详情的数组
			$arr['picname'] = $info2['cover'];
			$arr['goodsid'] = $info2['id'];
			$arr['name'] = $info2['name'];
			$arr['num'] = $v['num'];
			$arr['taste'] = $info['taste'];
			$arr['orderid'] = $ids;
			$arr['price'] = $info['now_price'];
			//插入订单详情
			//追加的时候顺便减库存
			$kucun = $GoodsDetail->where('id='.$v['id'])->setDec('repertory',$v['num']);
			$addres = $detail->add($arr);
			if(!$addres || !$kucun){
				$order->rollback();
				$this->error('下单失败');
			}
		}	
		
		//全部完成进行提交
			$order->commit();
			
		
			foreach ($arr as $v) {
				
				$redis->delete('cart:datas::'.session_id().':'.$v);
			}

			$redis->delete();
			$this->redirect('Order/pay',['id'=>$ids]);


	}


	/**
	 * 发表评论
	 */
	public function commentList(){
		$order = D('Orders');
		$user = $order->find(I('get.id'));
		if($user['uid'] == session('homeInfo.id')){
			$id = I('get.id');
			
			$arr = $order->Detail($id);
			$arr2 = $order->where('id='.$id)->getData();

			$arr2 = $arr2[0];
			
			$this->assign('list',$arr);
			$this->assign('list2',$arr2);

			$this->display('Order/commentlist');

		}else{
			$this->error('请登录后再进行下单',U('Login/index'));
		}
	}

	/**
	 * 处理发表评论
	 */
	public function doComment(){
		$post = I('get.');
		$post['addtime'] = time();
		$post['uid'] = session('homeInfo.id');
		$comment = M('Evaluate');
		$detail = M('detail');
		$res1 = $detail->save(['id'=>I('get.id'),'ping'=>2]);
		  
		$info = $detail->find(I('get.id'));
		$where['orderid'] = ['eq',$info['orderid']];
		$where['ping'] = ['eq',1];
		$info2 = $detail->where($where)->select();
		if(!$info2){
			$order = M('Orders');
			$order->save(['id'=>$info['orderid'],'status'=>5]);
		}
		unset($post['id']);
		$res = $comment->add($post);

		if($res && $res1){
			$data['msg'] = '评论成功';
			$data['status'] = 1;
			$data['deid'] = I('get.id');
		}else{
			$data['msg'] = '评论失败';
			$data['status'] = 2;
			$data['deid'] = I('get.id');
		}
		$this->ajaxReturn($data);
	}





}



   