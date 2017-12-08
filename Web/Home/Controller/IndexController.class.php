<?php
namespace Home\Controller;
use Think\Controller;
use Think\Cache\Driver\Redis;

class IndexController extends Controller {
    /**
     * 数据处理
     */
    public function index()
    {
        
        if(IS_AJAX){
            $code = I('get.code');
            $goods = D('Index');
            
            $info = $goods->getData($code);
            
            $this->ajaxReturn($info);
        }else{
            $type = D('type');
            $arr = $type->getData($i);
            $redis = new Redis();
            //用户ID
            $setKey = 'cart:ids::'.session_id();
            $ids = $redis->sMembers($setKey);
            foreach ($ids as $k => $v) {
                $cartKey = 'cart:datas::'.session_id().':'.$v;
                $cartDatas[] = $redis->hGetAll($cartKey);
            }

            $count = '';
            foreach ($cartDatas as $key => $val) {
                $count += $val['buyNum'] * $val['now_price'];
                $buyNum += $val['buyNum'];
            }
            // dump($cartDatas);
            /**** 分配轮播图和友链 ***/
            $ad = D('advertising');
            $lun = $ad->arrSort(1);
            $you = $ad->arrSort(2);
            // dump($cartDatas);
            $seo = M('seo');
            $so = $seo->select();

            //倒计时
            $sale = M('Sales');
            $shijian = $sale->field('starttime, endtime')->find();
            $time1 = strtotime($shijian['starttime']);
            // $time2 = strtotime($shijian['endtime']);
            $start = $time1 - time();
            $this->assign('start', $start);

            $this->assign('seo', $so); // seo
            $this->assign('lun', $lun);// 轮播图
            $this->assign('you', $you);// 友情链接
            /*************************/
            $this->assign('buyNum', $buyNum);
            $this->assign('count', $count);
            $this->assign('all', $cartDatas);
            $this->assign('types',$arr);
            $this->display("Home/index");
        }
        
    }

    /**
     * 每日签到
     * @return [type] [description]
     */
    public function doSign(){

        $sign = M('Sign');
        $user = M('User');
        if(IS_AJAX){
            $map['username'] = ['eq',session('homeInfo.username')]; 
            $infos = $user->where($map)->find();
            
            $where['sname'] = ['eq',session('homeInfo.username')];
            $arr = $sign->where($where)->find();
            // echo '<pre>';
            // print_r($arr);
            if(!$arr){
                $info =[
                    'sname' => session('homeInfo.username'),
                    'signnum' => 1,
                    'signtime' => time(),
                ];
                if($sign->add($info) !==false){
                    $infos['sign'] += 2;
                    $infos['signnum'] +=1;
                    $user->save($infos);
                    $res['status'] = 1;
                    $res['msg'] = "签到成功";
                    
                }else{
                    $res['status'] = 2;
                    $res['msg'] = "签到失败";
                }
            }else{
                
                if(date("Y-m-d",$arr['signtime'])==date("Y-m-d",time())){
                    $res['status'] = 2;
                    $res['msg'] = "今日已签到";
                }else{
                    $arr['signtime'] = time();
                    $arr['signnum'] += 1;
                    if($sign->save($arr)){
                        $infos['sign'] += 2;
                        $infos['signnum'] +=1;
                        $user->save($infos);
                        $res['status'] = 1;
                        $res['msg'] = "签到成功";
                        
                    }else{
                        $res['status'] = 2;
                        $res['msg'] = "签到失败";
                    }
                }
            }
            // dump($res);
                $this->ajaxReturn($res);
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


    /**
     * 加载首页顶部广告 yh
     */
    public function top_ad(){
        $ad = M('Advertising');
        $res = $ad->where('tid=3 and status=1')->find();
        $this->ajaxReturn($res);
    }

    
}
    