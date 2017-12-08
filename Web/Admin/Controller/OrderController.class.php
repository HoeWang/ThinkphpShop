<?php
namespace Admin\Controller;
use Think\Controller;
class OrderController extends CommonController 
{
	/**
	 * 订单列表
	 */
	public function OrderForm(){
		$orders = D('Orders');
		$user = M('User');
		$where = null;
    	$map = null;
		
		if(I('get.username') != null){
			$where['username'] = ['eq',I('get.username')];
			$arr = $user->where($where)->find();

			$map['uid'] = ['eq',$arr['id']];
		}
		if(I('get.status') != null){
			$map['status'] = ['eq',I('get.status')];
		}
		
			$count = $orders->where($map)->count();
		

		$page = new \Think\Page($count,5);
		
		$page->setConfig('prev','上一页');
		$page->setConfig('next','下一页');
		$btn = $page->show();
		// var_dump($btn);
		$arr = $orders->where($map)->limit($page->firstRow,$page->listRows)->order('id desc')->getData();
		$arr2 = $orders->getDetail();

		if(IS_AJAX){
			$this->assign('list',$arr);
			$this->assign('list2',$arr2);
			$html = $this->fetch('Order/ajaxPage');
			$data['html'] = $html;
			$data['btn'] = $btn;
			$this->ajaxReturn($data);
		}
		$this->assign('count',$count);
		$this->assign('list',$arr);
		$this->assign('list2',$arr2);
		$this->assign('btn',$btn);

        
		$this->display('Order/Orderform');
	}

	/**
	 * 发货模块
	 */
	public function sends(){
		if(IS_AJAX){
			$order = D('Orders');
			$arr = I('get.');
			$info = $order->changeStatus($arr);
			if($info){
				$data['status'] = 1;
				$data['msg'] = '发货成功';
				$data['id'] = $arr['id'];
			}else{
				$data['status'] = 2;
				$data['msg'] = '发货失败';
			}
			$this->ajaxReturn($data);
		}
	}

	/**
	 * 订单详情
	 */
	public function detail(){
	
		$user = M('User');

		$id = I('get.id');
		$order = D('Orders');
		$arr = $order->Detail($id);
		$arr2 = $order->where('id='.$id)->getData();
		
		$arr2 = $arr2[0];
		$userInfo = $user->find($arr2['uid']);
		// dump($userInfo);
		$this->assign('list',$arr);
		$this->assign('list2',$arr2);
		$this->assign('userInfo',$userInfo);
		$this->display('Order/order_detailed');
	}
}



