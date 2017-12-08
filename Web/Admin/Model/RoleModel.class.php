<?php
namespace Admin\Model;
use Think\Model;

class RoleModel extends Model 
{
	/**
	 * 获取所有的管理员和除了超级管理员的其他管理员
	 */
	public function getDate()
	{
		//管理员分类列表
		$list = $this->getField('id,name', true);
		$newlsit = $list;
		//可添的加管理员
		// $acc = array_splice($list, 1);//这种方法有缺陷，数组的下标会重置
		unset($list[1]);//用unset可以不改变下标的情况下，达到理想的需求
		$acc = $list;

		// 把数据打包成数组返回
		$arr = [$newlsit,$acc];
		return $arr;
	}

}
