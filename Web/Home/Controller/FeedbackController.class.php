<?php
namespace Home\Controller;
use Think\Controller;

class FeedbackController extends CommonController {

    public function index(){
        // dump(session('homeInfo.id'));
        $uid = session('homeInfo.id');

        $this->assign('uid',$uid);
        $this->display('Feedback/suggest');
    }

    public function do(){
    	if (IS_AJAX) {
            $uid = I('uid');
            $type = I('type');
            $text = I('text');
            // $uid = session('homeInfo.id')
    		$arr = array(
    			'b'=>'产品问题',
    			'c'=>'促销问题',
    			'd'=>'支付问题',
    			'e'=>'退款问题',
    			'f'=>'配送问题',
    			'g'=>'售后问题',
    			'h'=>'发票问题',
    			'o'=>'退换货',
    			'm'=>'其他'
    		);

    		$data['uid'] = $uid;
    		$data['type'] = $arr[$type];
    		$data['text'] = $text;
    		$data['addtime'] = time();

    		$feed = M('suggest');
    		$res = $feed->add($data);

    		if ($res) {
    			$this->ajaxReturn($text);
    		}
    	}
    }
}