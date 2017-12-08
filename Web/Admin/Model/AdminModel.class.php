<?php
namespace Admin\Model;
use Think\Model;

class AdminModel extends Model
{

	//自动验证
	protected $_validate = [
		// 检测用户名是否存在
		['username', '', '用户名已经存在', 0, 'unique', 1],
		//require表示必须输入
		['username', 'require', '请输入用户名'],
		// 验证用户名是否合法
		['username', '/^[\w\x{4e00}-\x{9fa5}]{2,18}$/u', '请输入3到18字母、数字、下划线或者中文组成的用户名', 0, '', 1],
		// password必须输入
		['password', 'require', '请输入密码'],
		//password2必须输入
		['password2', 'require', '请输入确认密码'],
		// 验证密码是否合法
		['password', '/^\w{6,18}$/u', '请输入6-18个字符组成的密码,区分大小写', 0, '', 1],
		//验证两次密码是否一致
		['password2', 'password', '两次密码不一致', 0, 'confirm'],
		//角色必选
		['role', 'require', '请选择角色'],

	];

	// 自动完成
	protected $_auto = [
		['password', 'password_hash', 1, 'function', [PASSWORD_DEFAULT]],
		// 对addtime字段在新增数据的时候写入当前的时间戳
		['addtime', 'time', 1, 'function'],
		//
		// ['loginip', 'get_client_ip', 1, 'function'],
	];

	/**
	 * 获取用户id
	 */
	public function getUid($username) 
	{
		// 参数绑定
		$where['username'] = ':username';
        $date[':username'] = [$username];
		$uid = $this->where($where)->bind($date)->getField('id');
		
		return $uid;
	}

	/**
	 * 获取数据
	 */
	public function getDate()
	{
		$list = $this->getField('id, username, addtime, status', true);
		$trans = ['1'=>'已启用', '2'=>'已禁用'];
		foreach ($list as $k=>$v) {
			$list[$k]['addtime'] = date('Y-m-d H:i:s', $v['addtime']);
			$list[$k]['status'] = $trans[$v['status']];
		}

		return $list;
	}

	/**
	 * 获取所有用户(admin除外)
	 */
	public function getAllUser()
	{
		$alluser = $this->order('id')->getField('id,username', true);
		unset($alluser[12]);
		$alluser = $alluser;
		return $alluser;
	}

	/**
	 * 改变管理员的状态
	 */
	public function change($stu) {
		if ($stu['status'] == '已启用') {
			$stu['status'] = 2;
		} else {
			$stu['status'] = 1;
		}
		// $trans = ['1'=>'已启用', '2'=>'已禁用'];

		$arr = $this->where('id='.$stu['id'])->field('status')->save($stu);
		// $list = $this->getField('id, status');
		// foreach ($list as $k=>$v) {
		// 	$list[$k]['status'] = $trans[$v['status']];
		// }
		return $arr;
	}
}

