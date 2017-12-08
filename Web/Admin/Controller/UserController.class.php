<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController {
	/**
	 * 后台用户列表展示
	 * @return [type] [description]
	 */
    public function index(){

    	$user = D('User');
    	$map = null;
		if(I('get.username') != null || strlen(I('get.username')) > 0){
			$map['username'] = ['like','%'.I('get.username').'%'];
		}
		if(I('get.sex') != null){
			$map['sex'] = ['eq',I('get.sex')];
		}
		if(I('get.status') != null){
			$map['status'] = ['eq',I('get.status')];
		}
		
			$count = $user->where($map)->count();
		

		$page = new \Think\Page($count,5);
		
		$page->setConfig('prev','上一页');
		$page->setConfig('next','下一页');
		$btn = $page->show();
		// var_dump($btn);
		$arr = $user->where($map)->limit($page->firstRow,$page->listRows)->order('id desc')->getData();

		if(IS_AJAX){
			$data = $arr;
			$data['page'] = $btn;
			$this->ajaxReturn($data);
			exit;
		}
		$this->assign('count',$count);
		$this->assign('list',$arr);
		$this->assign('btn',$btn);

        $this->display('list');
    }

    
   

    /**
     * 添加用户操作同时用来验证用户存在情况
     */
    public function addUser(){

    	if(IS_AJAX){
    		$this->ajaxReturn(0);
    	}
    }
    /**
     * 用来改变用户的状态
     * id 用户id  status 状态值
     * @return $arr 受影响的行数
     */
    public function changeUser(){
    	if(IS_AJAX){
    		$user = D('User');
    		$info = $user->changeData(I('get.'));
    		if($info){
    			if(I('get.status') == '正常'){
    				$this->ajaxReturn(1);
    			}else{
    				$this->ajaxReturn(2);
    			}
    		}else{
    			$this->ajaxReturn(0);
    		}
    	}
    }
    /**
     * 积分列表
     * @return [type] [description]
     */
    public function sign(){
        $user = D('User');
        $info = $user->getData();
        $this->assign('list',$info);
        $this->display('User/sign');
    }
}