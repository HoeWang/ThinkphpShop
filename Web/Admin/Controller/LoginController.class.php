<?php
namespace Admin\Controller;
use Think\Controller;
use Org\Util\GeetestLib;
class LoginController extends Controller {
    public function index(){
        if (IS_POST) {
            // dump($_SESSION['gtserver']);exit;
            $GtSdk = new GeetestLib(C('CAPTCHA_ID'), C('PRIVATE_KEY'));
            $data = array(
                    "user_id" => $_SESSION['user_id']
                );
            // dump($_SESSION);
            // dump($_POST);dump(I('post.username'));
            if ($_SESSION['gtserver'] == 1) {   //服务器正常
                $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $data);
                    if ($result) {
                        $admin = D(Admin);
                        $a = I('post.');
                        $a['id'] = 2;
                        $data = $admin->create($a);  
                        // dump($data);
                        $where['username'] = ':username';
                        $verify = $admin->where($where)->bind(':username', $data['username'])->find();
                        // dump($verify);exit;
                        if ($data) {
                            unset($data['id']);
                            // dump($data);
                            if (!$verify) {
                                $this->error('用户名或密码错误');
                                exit;
                            }
                            if (password_verify($data['password'], $verify['password'])) {
                                $this->error('用户名或密码错误2');
                                exit;
                            }
                            if ($verify['status'] != 1) {
                                $this->error('账户已禁用');
                                exit;
                            } 
                             $_SESSION['adminInfo'] = ['name'=>$data['username'], 'id'=>$verify['id']];
                            //1.根据用户id获取当前用户的角色id
                            $urs = M('UserRole');
                            $roleIds = $urs->where(['user_id'=>$verify['id']])->getField('role_id', true);
                            // dump($roleIds);exit;

                            //2.根据角色id查节点id
                            $nodeIds = M('RoleNode')->where(['role_id'=>['in', $roleIds]])->getField('node_id', true);
                            // dump($nodeIds);exit;
                            // echo M('admin')->_sql();
                            //3.根据节点id查出所有节点
                            if ($nodeIds != null) {
                                $arr = M('Node')->where(['id'=>['in', $nodeIds]])->getField('urls', true);
                            }
                            // dump($nodeIds);exit;
                           
                            // dump($arr);exit;
                            //追加一个首页的权限
                            $arr[] = 'Index/index';
                            $arr[] = 'Admin/error';
                            // dump($arr);
                            session('nodeList', $arr);
                             $this->success('登录成功', U('Index/index'));   
                        } else {
                            $this->error($admin->getError());
                        }                         
                    }else{ 
                        $this->error('验证码错误');
                    } 
                //服务器宕机,走failback模式
                }else {
                    if ($GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode'])) {
                        $this->error('验证失败');
                    }else{
                        $this->error('验证码错误2');
                    }
                
            }
            // if (I('username') == 'lzl') {
            //  //登录成功
            //  $_SESSION['adminInfo'] = ['name'=>'lzl', 'id'=>1];
            //  $this->success('登录成功', U('Index/index'));
            // } else {
            //  $this->error('用户名或密码错误');
            // }
      //       $post = I('post.');
      //       dump($post);
        } else {
            $this->display();
        }
    }

    /**
     * 
     */
    public function getVerify()
    {
        // $a = '24a8c2df30b227173234f05bafb01f11';
        // $b = '6161da8d7f097ea27c9674079bd45945';
        $GtSdk = new GeetestLib(C('CAPTCHA_ID'), C('PRIVATE_KEY'));
        $datas = [
            "user_id" => "web"
            ];
        $status = $GtSdk->pre_process($datas, 1);
        session('gtserver',$status);
        session('user_id',$datas['user_id']);

        // $data = array('gt'=>C('CAPTCHA_ID'),
        //              'new_captcha'=>1
        //         );
        // $data = array_merge($data,$datas);
        
        // $query = http_build_query($data);
        // $url = "http://api.geetest.com/register.php?" . $query;
        // $challenge = $GtSdk->send_request($url);
        // dump(strlen($challenge));
        echo $GtSdk->get_response_str();

    }


    //退出
    public function logout()
    {
        // unset($_SESSION['adminInfo']);
        session('adminInfo', null);
        $this->redirect('Login/index');
    }

}