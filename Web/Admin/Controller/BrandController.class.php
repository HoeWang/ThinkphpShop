<?php
namespace Admin\Controller;
use Think\Controller;
class BrandController extends CommonController {
    /**
     * 显示品牌页面
     */
    public function brandList() {
        $brand = M('Brand');

        $count = $brand->count();

        //实例化分页类
        $Page = new \Think\Page($count,3);

        //分页显示输出
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show = $Page->show();

        $arr =  $brand->limit($Page->firstRow.','.$Page->listRows)->select();

        //分配数据
        $this->assign('page',$show);
        $this->assign('brand',$arr);

        $this->display('Goods/Brand_Manage');
    }

    /**
     * 品牌添加页面
     */
    public function addBrand() {

        $this->display('Goods/brand-add');
    }

    /**
     * 处理品牌添加
     */
    public function Add() {
        //实例化对象
        $brand = D('Brand');
        $type_brand = M('TypeBrand');

        //处理数组
        $arr['name'] = I('post.name');
        //拿到上传路径
        $arr['picture'] = $brand->brandPictrye();
        $arr['addtime'] = time();

        //添加数据
        $add = $brand->add($arr);

        if($add) {
            $this->success('添加成功');
        }
    }

    /**
     * 品牌编辑页面
     */
    public function addType() {
        //接受数据
        $id = I('get.id');
        //实例化数据
        $brand = M('Brand');
        //查询品牌商品
        $data = $brand->where(['id'=>$id])->find();

         //查询分类
        $type = M('Type');
        $types = $type->order('concat(path,id)')->select();
        foreach($types as $k=>$v) {
            $str='';
            $num=substr_count($types[$k]['path'], ',');
            for($i= 1; $i < $num; $i++){
                $str .= "　　";
            }
            $str .= '┗-'.$types[$k]['name']; 
            $types[$k]['name'] = $str;
        }

        //分配数据
        $this->assign('data',$data);
        $this->assign('type',$types);
        //加载模板
        $this->display('Goods/brand-addtype');
    }

    /**
     * 商品品牌分类添加处理
     */
    public function editData() {
        //获取数据
        $arrID = I('post.');

        //实例化对象
        $type_brand = M('TypeBrand');

        $info =$type_brand->add($arrID);

        if($info) {
            $this->success('添加成功');
        }
    }

    /**
     *ajax删除品牌
     */
    public function delBrand() {
        if(IS_AJAX) {   
            //接收id
            $id = I('post.id');

            //实例化对象
            $goods = M('Brand');

            $del= $goods->where(['id'=>$id])->delete();

            if($del) {
                $this->ajaxReturn(1);
            } else {
                $this->ajaxReturn(2);
            }
        }
    }

    /**
     * 分类编辑页面
     */
    public function editBrand() {
        //接收ID
        $id = I('get.id');

        //实例化对象
        $brand=D('Brand');
        $type_brand = M('TypeBrand');

        //查询品牌数据
        $info = $brand->where(['id'=>$id])->find();
        //查询品牌与分类ID
        $arrID = $type_brand->where(['bid'=>$info['id']])->select();

         //查询分类
        $type = M('Type');
        $types = $type->order('concat(path,id)')->select();
        foreach($types as $k=>$v) {
            $str='';
            $num=substr_count($types[$k]['path'], ',');
            for($i= 1; $i < $num; $i++){
                $str .= "　　";
            }
            $str .= '┗-'.$types[$k]['name']; 
            $types[$k]['name'] = $str;
        }

        //分配数据
        $this->assign('info',$info);
        $this->assign('arrid',$arrID);
        $this->assign('type',$types);

        //加载模板
        $this->display('Goods/brand-edit');

    }

    /**
     * 商品编辑数据处理
     */
    public function disposeEdit() {
        //接受数组
        $arr = I('post.');dump($arr);

        $TypeBrand = M('TypeBrand');

        $id =$arr['bid']; 
        unset($arr['bid']);

        $del=$TypeBrand->where(['bid'=>$id])->delete();


        foreach($arr as $k=>$v) {
            $type_brand[$k]['bid'] = $id;
            $type_brand[$k]['tid'] = $v;
        }
        dump($type_brand);

        //循环数组修改
        foreach($type_brand as $val) {
            $data= $TypeBrand->add($val);
        }
    }

    // ajax删除品牌分类
    public function delTB() {
        if(IS_AJAX) {

            $tid = I('get.');
            
            //实例化对象
            $type=M('TypeBrand');

            $del=$type->where($tid)->delete();

            if($del) {
                $this->ajaxReturn(1);
            }
        }
    }

}