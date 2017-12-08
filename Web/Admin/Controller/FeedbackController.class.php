<?php
namespace Admin\Controller;
use Think\Controller;

class FeedbackController extends CommonController 
{
	public function index(){
		$fed = M('suggest');
		$user = M('user');
		
		$arr = $fed->field('shop_suggest.id,shop_suggest.type,shop_suggest.text,shop_suggest.addtime,shop_user.username')->join('shop_user on shop_suggest.uid=shop_user.id')->select();
		foreach ($arr as $key => $val) {
			$arr[$key]['addtime'] = date('Y-m-d H:i:s',$val['addtime']);
		}

		$count = count($arr);
		
		$this->assign('count',$count);
		$this->assign('arr',$arr);
		$this->display('Feedback/suggest');
	}
}