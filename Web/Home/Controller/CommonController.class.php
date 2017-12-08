<?php
namespace Home\Controller;
use Think\Controller;

class CommonController extends Controller {
	/**
	 * 会在所有方法执行之前判断是否登录.
	 */
    public function _initialize(){
    	if (!session('?homeInfo')) {
    		$this->redirect('Login/index');
    	}
    }

    /**
     * 防止手贱用户，直接退出并跳404
     */
    public function _empty()
    {
    	session('homeInfo', null);
    	$this->display('Public/404');
    }
}