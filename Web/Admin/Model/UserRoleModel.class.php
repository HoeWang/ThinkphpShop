<?php
namespace Admin\Model;
use Think\Model;

class UserRoleModel extends Model 
{
	/**
	 * 
	 */
	public function getDate($arr)
	{
		$mid = $this->getField('user_id, role_id');
		// array_combine  通过合并两个数组来创建一个新数组，其中的一个数组元素为键名，另一个数组元素为键值：
		$kid = array_combine($arr, $mid);
		return $kid;
	}

}