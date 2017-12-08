<?php
namespace Home\Model;
use Think\Model;

class GoodsPropertyModel extends Model
{

	public function getData($id){
		$where['id'] = ':id';
        $date[':id'] = [$id];
		$one = $this->where($where)->bind($date)->find();
		$gid = $one['gid'];
		$goods = M('Goods');
		$msg = $goods->where('id='.$gid)->getField('id, name, subtitle, price, cover');
		$msg = $msg[$gid];
		// unset($one['id']);
		unset($one['gid']);
		unset($one['repertory']);
		unset($msg['id']);
		$arr = array_merge($one, $msg);
		return $arr;
	}	
}