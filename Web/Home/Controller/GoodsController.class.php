<?php
namespace Home\Controller;
use Think\Controller;
use Think\Cache\Driver\Redis;

class GoodsController extends Controller{

    /**
     * 商品详情
     * 
     */
    public function detail() {
        //查询商品表
        $goods =D('Goods');
        $id = I('get.id');

        //查询商品
        $g_detail = $goods->field('tid,id,name,subtitle,price,promotion_price,addtime,click,sold,brand,comment')->where(['id'=>$id])->getData();

        if($g_detail) {

            //查询商品属性表
            $property = M('GoodsProperty');
            $g_property = $property->field('taste,id,repertory,now_price')->where(['gid'=>$id])->select();
            
            //查询商品图片
            $picture = M('Picture');
            $g_pictrue = $picture->field('pic')->where(['gid'=>$id])->select();

            //查询商品参数
            $param = M('GoodsParam');
            $g_param = $param->field('param_data')->where(['item_id'=>$id])->find();


            $g_param = json_decode($g_param['param_data'],true);


            //面包屑
            //实例化对象
            $type = M('Type');
            $goods = M('Goods');

            //获取商品分类tid
            $g_tid = $goods->where(['id'=>$id])->getField('tid');
            $g_path = $type->where(['id'=>$g_tid])->getField('path');

            $num = substr_count($g_path, ',');
            
            if(!empty($g_tid)) {
                //通过子类循环查找父类
                for($i=0 ; $i < $num; $i++){
                    $data = $type->where(['id'=>$g_tid])->find();

                    $arr[] = $data;
                    $g_tid = $data['pid']; 
                }
            }

            //翻转数组
            $arr = array_reverse($arr);

            /**
             * 商品浏览记录
             */
            //采用SESSION保存商品的ID
            //
            if (!isset($_SESSION['browse'])) {
                $_SESSION['browse'] = [];
            }

            //判断$id是存在
            if(!in_array($id, $_SESSION['browse'])){
                //不存在着保存当前$id
                $_SESSION['browse'][] = $id;
            }else {
                //存在着删除之前的$id再把ID追加进去
                $k = array_keys($_SESSION['browse'], $id);

                unset($_SESSION['browse'][$k[0]]);
                unset($k);

                $_SESSION['browse'][] = $id;

            }

            //根据$id查询商品信息.
            foreach($_SESSION['browse'] as $v) {
                $b_goods[] = $goods->field('id,name,promotion_price,cover')->where(['id'=>$v])->find();
            }
            //倒转数组，让最近浏览的商品在上面

            $b_goods = array_reverse($b_goods);

            /**
             * 商品点击次数，每一个ID一个小时内只添加一次商品点击数
             */

            //获取当前用户的IP地址.
            $ip = $_SERVER['REMOTE_ADDR'];

            if (!in_array($ip,$_SESSION['click'])) {
                // //不存在
                $_SESSION['click']['IP'] = $ip;
                $_SESSION['click']['time'] = time();

                $goods=M('Goods');
                $num = $goods->where(['id'=>$id])->setInc('click',1); //商品浏览次数+1
            } else {
                //存在,或去当前时间戳和数组的的时间戳比较
                $time = time();
                if ($time > $_SESSION['click']['time']+3600 ) {
                    //时间过去一个小时
                    $num = $goods->where(['id'=>$id])->setInc('click',1); //商品浏览次数+1
                    // //更新当前时间戳
                    $_SESSION['click']['time'] = $time;

                } 

            }

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
            $this->assign('buyNum', $buyNum);
            $this->assign('count', $count);
            $this->assign('all', $cartDatas);
            //分配数据
            $this->assign('h_detail',$g_detail);
            $this->assign('h_pictrue',$g_pictrue);
            $this->assign('h_property',$g_property);
            $this->assign('bread',$arr);
            $this->assign('browse',$b_goods);
            $this->assign('h_param',$g_param);

            //调用模板
            $this->display('Goods/details');
        } else {
            //查不到商品跳转到首页
            $this->redirect('Index/index');
        }
 

    }

    //AJAX查询库存与价格
    public function g_Pro($name) {
        if(IS_AJAX) {
            $property = M('GoodsProperty');
            $pro = $property->field('repertory,now_price')->where(['taste'=>$name])->find();
            $this->ajaxReturn($pro);
        }
    }

    /**
     * AJAX删除商品浏览记录session
     */
    public function clearId() {
        if(IS_AJAX) {
            if(!session('browse',null)) {
                $this->ajaxReturn(1);
            }else {
                $this->ajaxReturn(2);
            }
        }
    }

    /**
     * AJAX查询商品库存
     */
    public function stock() {
        $id = I('post.id');

        //实例化对象
        $property = M('GoodsProperty');
        $data = $property->where(['id'=>$id])->find();

        $this->ajaxReturn($data['repertory']);

    }

    //AJAX添加商品收藏功能
    public function addCollect() {
        if(IS_AJAX) {

            //获取id
            $id=$_GET;
            //添加商品收藏量
            //实例化对象
            $goods=M('Goods');
            $collect = M('Collect');
            //用户表收藏数加一
            $addMum = $goods->where(['id'=>$id['gid']])->setInc('collect');
            
            //收藏表添加
            $id['addtime'] = time();
            $addcollect = $collect->add($id);

            if ($addMum && $addcollect) {
                $this->ajaxReturn(1);
            } else {
                $this->ajaxReturn(2);
            }
        }
    }

    //ajax取消收藏
    public function reduceCollect() {
        if(IS_AJAX) {
            //获取id
            $id=$_GET;
            //添加商品收藏量
            //实例化对象
            $goods=M('Goods');
            $collect = M('Collect');
            //用户表收藏数加一
            $addMum = $goods->where(['id'=>$id['gid']])->setDec('collect');
            
            //收藏表删除
            $addcollect = $collect->where(['gid'=>$id['gid'],'uid'=>$id['uid']])->delete();

            if ($addMum && $addcollect) {
                $this->ajaxReturn(1);
            } else {
                $this->ajaxReturn(2);
            }
        }
    }

    //商品AJAX选项卡
    public function goodsComment() {
        $gid = I('post.gid');

        //实例化对象
        $evaluate = D('Evaluate');
        $user = M('User');

        //实例化分页类
        $count = $evaluate->where(['gid'=>$gid])->count();
        $Page = new \Think\Page($count,2);
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $btn = $Page->show();

        //查询数据
        $goods_evaluate = $evaluate->where(['gid'=>$gid,'state'=> 1])->order('addtime')->limit($Page->firstRow.','.$Page->listRows)->dispose();

        $this->assign('list',$goods_evaluate);
        $this->assign('btn',$btn);

        $html = $this->fetch('Goods/content');

        $this->ajaxReturn($html);

    }   


    
}