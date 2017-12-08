<?php
namespace Home\Model;
use Think\Model;
class OrdersModel extends Model
{
	/**
	 * 前台用户订单数据
	 */
	public function getData(){
		$arr = $this->select();
		$info = ['','待付款','待发货','待收货','已完成','已评价','已失效'];
		$sendtype = ['','天天快递','圆通快递','中通快递','顺丰快递','申通快递','邮政EMS','邮政小包','韵达快递'];
		foreach($arr as $k=>$v){
			$arr[$k]['status'] = $info[$v['status']];
			$arr[$k]['statusNum'] = intval($v['status']);
			$arr[$k]['addtime'] = date('Y-m-d H:i:s',$v['addtime']);
			$arr[$k]['sendtype'] = $sendtype[$v['sendtype']];
		}
		return $arr;
	}
	/**
	 * 前台订单内部详情展示
	 * @return [type] [description]
	 */
	public function getDetail(){

		return $arr = $this->table('__DETAIL__')->select();
	}

	/**
	 * 修改状态处理
	 */
	public function changeStatus($arr){
		$info = $this->save($arr);
		return $info;

	} 

	/**
	 * 订单详情页
	 */
	public function Detail($id){
		return $arr = $this->table('__DETAIL__')->where('orderid='.$id)->select();
	}
}