<?php
namespace Home\Model;

class EvaluateModel extends \Think\Model
{
	public function dispose() {
		$info = $this->select();
		$user = M('User');
		//处理数组
		foreach ($info as $k => $v) {
			$arr = $user->field('username')->where(['id'=>$info[$k]['uid']])->find();
			$info[$k]['username'] = $arr['username'];
			$arr = $user->field('head')->where(['id'=>$info[$k]['uid']])->find();
			$info[$k]['head'] =$arr['head'];
			$info[$k]['addtime'] = date('Y-m-d H:i',$info[$k]['addtime']);
		}
		return $info;
	}
}