<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
	/**
	 * 后台首页展示
	 * @return [type] [description]
	 */
    public function index(){
    	
        $this->display('Index/index');
    }
}