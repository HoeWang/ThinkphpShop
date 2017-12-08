<?php
namespace Home\Controller;
use Think\Controller;
use Think\Cache\Driver\Redis;

class ShopCarController extends Controller{
	/**
	 * 购物车页面  
	 */
	public function index() {
		$setKey = 'cart:ids::'.session_id();
		//先去集合中拿到购物车商品ID
		$redis = new Redis();
		$ids = $redis->sMembers($setKey);
            // dump($ids);
            // dump(session_id());
		foreach ($ids as $k => $v) {
			$cartKey = 'cart:datas::'.session_id().':'.$v;
			// dump($cartKey);
			$cartDatas[] = $redis->hGetAll($cartKey);
		}
		
		// dump($cartDatas);

		//分配数据
		$this->assign('ids', json_encode($ids));
		$this->assign('cartDatas', $cartDatas);
		$this->display();
	}	

	/**
	 * 加入购物车
	 */
	public function doAction() {
		$id = I('post.pid');
		// dump(I('post.'));exit;
		$buyNum = I('post.buyNum');

		$redis = new Redis();
		
		//根据用户的id查询商品数据
		$property = D('GoodsProperty');
		$arr = $property->getData($id);
		// dump($arr);exit;

		//商品ID
		$cartKey = 'cart:datas::'.session_id().':'.$id;
		//保存7天，每次加入购物车刷新
		setcookie('PHPSESSID', session_id(), time()+60*60*24*7);
		

		//判断购物车中有没有对应的商品数据
		if (!$redis->exists($cartKey)) {
			$arr['buyNum'] = $buyNum;
			//hash保存购物车必须数据
			$redis->hMSet($cartKey, $arr);
			//用户ID
			$setKey = 'cart:ids::'.session_id();
			//将已经放入到购物车的商品ID存放到集合中
			$redis->sAdd($setKey, $id);
		} else {
			//购物车已经有对应的商品,修改对应购物车商品的数量
			$redis->hIncrBy($cartKey, 'buyNum', $buyNum);
		}

		// name  price promotion_price buyNum cover
		// $cartKey = 'cart:datas:'.$gid;
		// $redis->set('username', $cartKey);
		// $redis->Hset('a', 'username', '123');
		// $redis->sAdd($setKey, $id);
		// dump($redis->sMembers($setKey));
		// echo $redis->Hget('a', 'username');
		$this->display();
		
	}

	/**
	 * 修改购物车数量
	 */
	public function changeNum() {
		$id = I('post.id');
		// dump($id);
		$status = I('post.status');
		$buyNum = I('post.buyNum');
		$property = M('GoodsProperty');
        $data = $property->where(['id'=>$id])->find();
        // dump($data['repertory']);
        // dump($buyNum);
		$redis = new Redis();
		//商品ID
		$cartKey = 'cart:datas::'.session_id().':'.$id;
		// dump($buyNum);exit;
		if (IS_AJAX) {
			if ($status == 'up') {
				if ($buyNum > $data['repertory']) {
					$this->ajaxReturn($data['repertory']);
					exit;
				} else {
					$redis->hIncrBy($cartKey, 'buyNum', 1);
					$this->ajaxReturn($data['repertory']);
				}
			} else {
				if ($buyNum < 1) {
					$this->ajaxReturn(2);
					exit;
				} else {
					$redis->hIncrBy($cartKey, 'buyNum', -1);
				}
				
			}
			$this->ajaxReturn(1);
		}
		
		
		
	}

	/**
	 * 删除
	 */
	public function delete() {
		$id = I('get.id');
		$redis = new Redis();
		$cartKey = 'cart:datas::'.session_id().':'.$id;
		$setKey = 'cart:ids::'.session_id();

		// dump($cartKey);
		if (IS_AJAX) {
			if ($redis->delete($cartKey) && $redis->srem($setKey, $id)) {
				$this->ajaxReturn(1);
			} else {
				$this->ajaxReturn(2);
			}
		}
	}
}
