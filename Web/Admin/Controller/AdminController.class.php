<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends CommonController {
	/**
	 * 角色管理
	 */
    public function index(){
        $user = M('Role');
        $admin = M('Admin');
        $mod = D('UserRole');
        //角色表
        $arr = $user->getField('id, name, description');
        //管理员表
        $peo = $admin->order('id')->getField('id, username');
        //中间表的数据
        $kid = $mod->getDate($peo);
        
        // 统计每个角色的人数
        $count = $mod->field('count(*) as count,role_id')->group('role_id')->select();
        // 每个角色id对应的用户id的个数
        $countTwo = $mod->field('group_concat(user_id) as a, role_id')->group('role_id')->getField('role_id, group_concat(user_id)');
        //每个角色对应的用户
        $a = abc($kid);

        // dump($arr);
        // dump($count);   
        // dump($kid);
        // 分配数据
        $this->assign('peo', $a);
        $this->assign('count', $count);
        $this->assign('countTwo', $countTwo);
        $this->assign('list', $arr);

        $this->display('Admin/index');
    }

    /**
     * 管理员列表
     */
    public function showList(){
        if (IS_POST) {
            // 实例化用户表
            $user = D('Admin');
            // 实例化角色表
            $role = M('Role');
            //实例化用户角色表
            $usro = M('UserRole');
            // 使用create方法来创建数据对象
            $data = $user->create();

            if ($data) {
                // dump($data);exit;
               if ($user->add($data)) {
                    //用户ID
                    $uid = $user->getUid($data['username']);
                    //用户角色表添加数据
                    $usro->add(['user_id'=>$uid, 'role_id'=>$_POST['roleId']]);
                    $this->success('添加成功', U('showList'));
               } else {
                    $this->error('添加失败');
               }

            } else {
                $this->error($user->getError());
            }
        } else {
            // 实例化角色表
            $role = D('Role');
            $admin = D('Admin');
            $midle = M('UserRole');
            //中间表的数据
            $mid = $midle->getField('user_id, role_id');
            //管理员分类列表
            $arr = $role->getDate();
            //管理员列表
            $list = $admin->getDate();
            // $where['id'] = ':id';
            // $arr = $Admin->where($where)->bind(':id',I('get.id'))->find();
            // // dump($arr);
            // $this->assign('arr', $arr);
            // dump($arr[0]);
            //分配数据
            // dump($arr[0]);
            $this->assign('mid', $mid);  //中间表
            $this->assign('list', $list); //用户列表
            $this->assign('newlist', $arr[0]); //角色表
            $this->assign('acc', $arr[1]); //没有admin的角色表

            $this->display('Admin/showList');
        }
    	
    }

    /**
     * 权限管理
     */
    public function powers() {
        $power = M('node');
        $arr = $power->getField('id, urls, title');
        // dump($arr);
        $this->assign('list', $arr);
        $this->display('Admin/powers');
    }

    /**
     * 
     */
    public function doList() {
        if (IS_POST) {
            // dump(I('post.'));
            $usro = M('UserRole');
            $user = M('Admin');
            if ($_POST['password'] == '') {
                unset($_POST['password']);
            }
            if ($_POST['content'] == '') {
                unset($_POST['content']);
            }
            $rid = $_POST['roleId'];
            unset($_POST['roleId']);
            unset($_POST['password2']);
            $data = I('post.');
            // dump($data);
            //用户ID
            $uid = $_POST['id'];
            //用户角色表添加数据
            // $shuju['user_id'] = $uid;
            $shuju['role_id'] = $rid;
            // dump($user->save($data));
            // dump($usro->where('user_id='. $uid)->save($shuju));
            if ($user->save($data) || $usro->where('user_id='. $uid)->save($shuju)) {
                $this->success('修改成功', U('showList'));
            }
        } else {
            $role = D('Role');
            $admin = M('admin');
            $midle = M('UserRole');
            $where['id'] = ':id';
            $arr1 = $admin->where($where)->bind(':id',I('get.id'))->find();
            $arr = $role->getDate();
            $this->assign('arr', $arr1);
            $this->assign('acc', $arr[1]);
            $this->display();
        }
        
    }

    public function ajaxDel($id) {
        if (IS_AJAX) {
            if (M('admin')->delete($id) && M('UserRole')->where('user_id='.$id)->delete()) {
                $data['status'] = 1;
                $this->ajaxReturn($data);
            } else {
                $this->ajaxReturn(2);
            }
        }
    }
    /**
     * 管理员日志
     */
    public function info(){
    	$this->display('Admin/info');
    }

    /**
     * 添加角色
     */
    public function competence() {
        if (IS_POST) {
            // dump(I('post.'));
            // 事务
            $role = M('Role');
            $dlb = M('RoleNode');
            $role->startTrans();
            $dlb->startTrans();
            $data['name'] = I('post.name');
            $data['description'] = I('post.description');
            $arr1 = I('post.');
            unset($arr['name']);unset($arr['description']);
            $arr = $arr1['node'];
            if (I('post.id')) {
                $id = I('post.id');
                $shuju = I('post.');
                $mid = $shuju['node'];
                unset($shuju['node']);
                $data['id'] = $id;
                $role->save($data);
                $return = '';
                $dlb->where('role_id='.$id)->delete();
                foreach ($mid as $k => $v) {
                    // dump($v);
                    if ($dlb->add(['role_id'=>$id, 'node_id'=>$v])) {
                        $return += 1;
                    }
                }
                // dump($return);exit;
                if ($return > 0) {  
                        $role->commit(); // 成功则提交事务  
                        $dlb->commit(); // 成功则提交事务  
                        $this->success('添加成功', U('Admin/index'));
                    } else {  
                        $role->rollback(); // 否则将事务回滚  
                        $dlb->rollback(); // 否则将事务回滚  
                        $this->error('添加失败');
                }
            } else {
                
                $a = $role->add($data);
                if ($a) {
                    //用户ID
                    $where['name'] = ':name';
                    $date[':name'] = $data['name'];
                    $uid = $role->where($where)->bind($date)->getField('id');
                    //用户角色表添加数据
                    $return = '';
                    // dump($arr);
                    foreach ($arr as $k => $v) {
                        // dump($v);
                        if ($dlb->add(['role_id'=>$uid, 'node_id'=>$v])) {
                            $return += 1;
                        }
                    }
                    // exit;
                    if ($return > 0) {  
                        $role->commit(); // 成功则提交事务  
                        $dlb->commit(); // 成功则提交事务  
                        $this->success('添加成功', U('index'));
                    } else {  
                        $role->rollback(); // 否则将事务回滚  
                        $dlb->rollback(); // 否则将事务回滚  
                        $this->error('添加失败');
                    } 
                   
                }
            }
                
        } else {
            $num = I('get.id');
            // dump($num);
            $node = M('Node');
            $role = M('Role');
            $dlb = M('RoleNode');
            $arr = $node->order('urls desc')->select();
            $where['role_id'] = ':role_id';
            $date[':role_id'] = $num;
            $list = $dlb->where($where)->bind($date)->getField('node_id', true);
            $name = $role->select();
            // dump($arr);
            // 分配数据
            $this->assign('arr', $arr);
            $this->assign('list', $list);
            $this->assign('name', $name);
            $this->display('Admin/competence');
        }
        
    }

    /**
     * 删除角色
     */
    public function lastDel() {
        $id = I('get.id');
        if (IS_AJAX) {
            $role = M('Role');
            $dlb = M('RoleNode');
            $role->startTrans();
            $dlb->startTrans();
            $return = '';
            if ($role->delete($id) && $dlb->where('role_id='.$id)->delete()) {
                $return =2;
            }
            if ($return ==2) {  
                $role->commit(); // 成功则提交事务  
                $dlb->commit(); // 成功则提交事务  
                $this->ajaxReturn(1);
            } else {  
                $role->rollback(); // 否则将事务回滚  
                $dlb->rollback(); // 否则将事务回滚  
                $this->ajaxReturn(2);
            }
        }
    }

    /**
     * 添加，修改权限
     */
    public function node() {
        if (IS_POST) {
            // dump(I('post.'));exit;
            $data = I('post.');
            $id = I('post.id');
            if ($id) {
                if (M('Node')->save($data)) {
                    $this->success('修改成功', U('Admin/powers'));
                    exit;
               } else {
                    $this->error('修改失败');
                    exit;
               }
            } else {
                unset($data['id']);
                if (M('Node')->add($data)) {
                    $this->success('添加成功', U('Admin/powers'));
                    exit;
               } else {
                    $this->error('添加失败');
                    exit;
               }
            }
            

        }
        $power = M('node');
        $where['id'] = ':id';
        $arr = $power->where($where)->bind(':id',I('get.id'))->find();
        // dump($arr);
        $this->assign('arr', $arr);
        $this->display('Admin/node');
    }

    public function del($id) {
        if (IS_AJAX) {
            if (M('Node')->delete($id)) {
                $data['status'] = 1;
                $this->ajaxReturn($data);
            } else {
                $this->ajaxReturn(2);
            }
        }
    }

    /**
     * 改变状态
     */
    public function status() {
        
        if (IS_AJAX) {
            $admin = D('Admin');
            $arr = $admin->change(I('get.'));
            
            if($arr){
                if(I('get.status') == '已启用'){
                    $data['zt'] = 1;
                    // $data['status'] = '已禁用';
                    // $data['id'] = I('get.id');
                }else{
                    $data['zt'] = 2;
                    //  $data['status'] = '已启用';
                    // $data['id'] = I('get.id');
                }
                $this->ajaxReturn($data);
                    }
        }
    }

    /**
     * 
     */
    public function error() {
        $this->display('Admin/error');
    }
}