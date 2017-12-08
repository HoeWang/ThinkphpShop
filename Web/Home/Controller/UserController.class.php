<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends CommonController
{
	
	/**
	 * 个人中心首页
	 */
	public function index(){
		$this->display('User/index');
	}

	

	/**
	 * 修改密码页
	 * @return [type] [description]
	 */
	public function changePass(){
		if(IS_POST){
			$user = D('User');
			$post = I('post.');
			$userInfo = $user->where('id='.session('homeInfo.id'))->getData();
			if(password_verify($post['oldpwd'],$userInfo['pwd'])){	
				$data = $user->create();
				if($data){
					$data['id'] = session('homeInfo.id');
					$res = $user->doChangePass($data);
					if($res){
						session('homeInfo', null);
						$this->success('修改成功',U('Login/index'));
					}else{
						$this->error('修改失败');
					}
				}else{
					$this->error($user->getError());
				}
			}else{
				$this->error('原密码错误');
			}
		}else{
			$this->display('User/password');
		}
	}

	/**
	 * 个人中心收货地址管理
	 */
	public function goodsAddress() {
		//查询一级地址
		$location = M('Location');
		$province = $location->field('id,area_name')->where(['parent_id'=>1])->select();

		//收货地址
		$address =M('Address');
		$default_ad = $address->field('default,zipcode,consignee,province,city,district,id,address,mobile')->where(['uid'=>$_SESSION['homeInfo']['id']])->order('id desc')->select();

		//修改地址信息
		$id = I('get.id');
		$alter = $address->field('zipcode,consignee,province,city,district,id,address,mobile')->where(['id'=>$id])->find();

		//分配数据
		$this->assign('data',$province);
		$this->assign('d_address',$default_ad);
		$this->assign('alterAdd',$alter);

		//加载模板
		$this->display('User/address');
	}


	/**
	 * ajax获取2.3级联动内容
	 */
	public function checkRegion() {
		if(IS_AJAX) {

			$id = I('post.id');
			$location = M('Location');

			$arr = $location->field('id,area_name')->where(['parent_id'=>$id])->select();

			$this->ajaxReturn($arr);
		}
	}

	/**
	 * ajax修改默认地址状态
	 */
	public function  addressStatus(){
		$id = I('post.id');
		$address = M('Address');

		//先把所有默认地址状态改为1
		$arr = $address->field('id,default')->select();
		foreach ($arr as $key => $value) {
			$arr[$key]['default'] = 1;
		}
		//循环修改状态
		foreach ($arr as $k => $v) {
			$data = $address->where(['id'=>$arr[$k]['id']])->save(['default'=>$arr[$k]['default']]);	
		}

		//修改默认地址状态
		$default['default']= 2;
		$status = $address->where(['id'=>$id])->save($default);

		if($status) {
			$this->ajaxReturn(1);
		}

	}

	/**
	 * ajax删除地址
	 */
	public function delAddress() {
		$id = I('post.id');
		$address = M('Address');
		
		//根据ID，根据状态分两种情况，1删除普通地址 2.删除默认地址
		$default = $address->where(['id'=>$id])->find();

		if ($default['default'] == 1) {
			//删除普通地址
			$ar = $address->where(['id'=>$id])->delete();

			if($ar) {
				$this->ajaxReturn(1);
			} else{
				$this->ajaxReturn(2);
			}

		} else if($default['default'] == 2) {
			//删除默认地址
			$arr = $address->where(['id'=>$id])->delete();
			if ($arr){

				//获取最大的id
				$id_arr = $address->field('id')->select();

				$max = 0;
				foreach ($id_arr as $k => $v) {
					if ($v['id'] > $max) {
						$max = $v['id'];
					}
				}

				//修改获取最大ID的地址为默认地址
				$status['default']= 2;
				$maxID = $address->where(['id'=>$max])->save($status);

				if($maxID) {
					$this->ajaxReturn(1);
				} else{
					$this->ajaxReturn(2);
				}
			}

		}
	}


	/**
	 * 处理地址添加
	 */
	public function addAddress() {
		if (IS_POST) {
			//实例化对象
			$address =M('Address');
			$data = $address->create();
			
			if($data) {
				if($data['id']) {
					//存在ID即为修改地址
					$aletrA = $address->where(['id'=>$data['id']])->save($data);
					if($aletrA) {
						$this->success('修改成功',U('User/goodsAddress'));
					} else{
						$this->error('修改失败');
					} 
				}else {

					//判断用户只能存放5个地址
					$default  = $address->where(['uid'=>$data['uid']])->count();

					if($default < 5) {
						//判断是否第一个地址，如果是设为默认
						$default = $address->where(['uid'=>$data['uid']])->count();
						if($default == 0) {
							//初始地址设为默认地址
							$data['default'] = 2;
							$info = $address->field('uid,id,default,zipcode,consignee,province,city,district,address,mobile')->data($data)->add();
							if($info) {
								$this->success('保存成功');
							} else{
								$this->error('保存失败');
							}
						} else{
							//不为初始地址
							$info = $address->field('uid,id,zipcode,consignee,province,city,district,address,mobile')->data($data)->add();
							if($info) {
								$this->success('保存成功');
							} else{
								$this->error('保存失败');
							}
						}
					}else {
						$this->error('不好意思，只能保存5个地址');
					}
				}
			} else{
				//自动验证失败返回错误信息
				$this->error($address->getError());
			}
		} else {
			$this->error('不要乱来');
		}
	}

	/**
	 * 显示个人资料页面
	 */
	public function personage () {
		
		$uid = $_SESSION['homeInfo']['id'];

		//实例化对象
		$user = D('User');
		$userinfo = $user->where(['id'=>$uid])->queryUser();
		
		//分配数据
		if(IS_AJAX){
			$post = I('post.');
			$post['id'] = session('homeInfo.id');
			$data = $user->create($post);
			if($data){
				$data['status'] = 1;
				$data['msg'] = "以上信息可用";
			}else{
				$data['status'] = 2;
				$data['msg'] = $user->getError();
			}
			$this->ajaxReturn($data);

		}else{
			
			$this->assign('info',$userinfo);

			//加载模板
			$this->display('User/information');
		}
	}
	/**
	 * 修改个人中心资料
	 * @return [type] [description]
	 */
	public function doPerson(){
			$user = D('User');

			$post = I('post.');
			if($post['phone']==''){
				unset($post['phone']);
			}
			if($post['email']==""){
				unset($post['email']);
			}
			$post['id'] = session('homeInfo.id');
			$data = $user->create($post);
			$users = M('User');
			

		if($data){

			$upload = new \Think\Upload();
            // 设置附件上传大小（8）
            $upload->maxSize = 3145728;
            // 设置附件上传类型
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
            // 设置附件上传目录
            $upload->rootPath = 'Public/Admin/Uploads/';
            //关闭子目录
            $upload->autoSub = false;
            // 上传文件
            $info = $upload->upload();
            if($info){

            $data['head'] = "/Test/Public/Admin/Uploads/".$info['pic']['savename'];
            session('homeInfo.head',$data['head']);
        	}

			$res = $users->save($data);
			if($res !== false){
				session('homeInfo.head',$data['head']);
				$this->success("修改成功");
			}else{
				$this->error('修改失败');
			}
		}else{
			$this->error($user->getError());
		}
	}

	/**
	 * 显示商品收藏页面
	 */
	public function collect() {


		//实例化对象
		$collect = M('Collect');
		$goods = M('Goods');

		//获取收藏的商品ID
		$id = $_SESSION['homeInfo']['id'];
		$allgid = $collect->field('gid')->where(['uid'=>$id])->select();
		foreach ($allgid as $k=> $v) {
			$gid[] = $v['gid'];
		}

		//查询商品信息
		$arr = $goods->field('id,name,price,promotion_price,cover,sold')->where(['id'=>array('in',$gid)])->select();
		
		//分配数据
		$this->assign('arr',$arr);


		$this->display('User/collection');
	}
}