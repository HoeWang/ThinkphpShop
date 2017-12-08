<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
        if (empty($_SESSION['adminInfo'])) {
        	$this->redirect('Login/index');
        	exit;
        }

        //有常量获取当前是哪个控制器和哪个方法
    	// echo '当前控制器是：',CONTROLLER_NAME,'<br>';
    	// echo '当前操作是：',ACTION_NAME,'<br>';
    	$node = CONTROLLER_NAME.'/'.ACTION_NAME;
        $admin = M('Admin');
        // dump($_SESSION['adminInfo']['name']);
        $arr = $admin->where(['username'=>$_SESSION['adminInfo']['name']])->field('oneforall')->find();
        // dump($arr['oneforall']);
    	if ($arr['oneforall'] != 1) {
            if (!in_array($node, session('nodeList'))) {
                $this->redirect('Admin/error');
                exit;
            }
        }
    }

    public function _empty()
    {
    	echo '404';
    }
}