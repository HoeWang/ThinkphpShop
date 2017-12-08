<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends CommonController {
    /**
     *显示分类列表
     * @return [type] [description]
     */
    public function index(){
        $type = D('Type');

        //统计总条数
        $count = $type->count();

        //实例化分页类
        $Page = new \Think\Page($count,10);
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        //获取分页类按钮
        $btn = $Page->show();

        $arr = $type->field('id,pid,name,path')->limit($Page->firstRow, $Page->listRows)->order('concat(path,id) ')->getData();


        //分配数据
        $this->assign('list',$arr);
        $this->assign('btn',$btn);

        //显示模板
        $this->display('Goods/product-category-list');
    }


    /**
     *显示添加分类页面
     */
    public function showAdd() 
    {   if(IS_GET) {
            $name = M('Type');
            $map['id'] = I('id');
            $arr = $name->field('name,id,pid,path')->where($map)->find();
            $this->assign('info',$arr);
            $this->display('product-category-add');
        }else{
        }
    }

    /**
     * 添加分类页面
     */
    public function doAdd(){
        //判断是否POST提交
        if(IS_POST) {
            $goods = D('Type');
            //自动验证
            $data = $goods->create();
            //拿到自动验证后的数组
            if($data) {
                if($goods->add($data)) {
                    $this->success('添加成功');
                } else {
                    $this->error('添加失败');
                }
            }else {
                $this->error($goods->getError());
            }
        }else{
            
        $this->display('Goods/product-category-add');
        }
    }

    /**
     * AJAX无刷新删除分类。
     */
    public function ajaxDel($id) {
        if (IS_AJAX) {
            //判断是否存在子类
            $type = M('Type');
            $arr = $type->where(['pid'=>$id])->select();
            if($arr) {
                //有子类
                $data['status'] = 2;
                $this->ajaxReturn($data);
            } else{
                //没子类
                $goods = M('Goods');
                $info = $goods->where(['tid'=>$id])->select();
                if($info) {
                    //有商品
                    $data['status'] = 3;
                    $this->ajaxReturn($data);
                } else {
                    //没有商品
                    if (M('Type')->delete($id)) {
                    $data['status'] = 1;
                    $this->ajaxReturn($data);
                    } else {
                        $this->error('删除失败');
                    }
                }
            }
        }
    }

    /**
     * 显示分类编辑页面
     */
    public function showEdit() {
        $type = M('Type');
        $id = I('id');
        $info = $type->where(['id'=>$id])->find();
        $this->assign('info',$info);
        $this->display('Goods/product-category-edit');
    }

    /**
     * 处理分类编辑信息
     */
    public function doEdit() {
        if(IS_POST){
            $type = D('Type');
            $data = $type->create();

            if($data) {
                if($type->save($data)){
                    $this->success('修改成功',U('index'));
                } else{
                    $this->error('修改失败');
                }
            } else{
                $this->getError();
            }    
        }

    }

    
    /**
     * 显示商品添加页面
     */
    public function pictureAdd() {
        //查询分类
        $type = M('Type');
        $arr = $type->where(['pid'=> 0 ])->select();

        $type = D('Type');
        $option = $type->order('concat(path,id)')->getParam();
        
        $brand = M('Brand');
        $arrBrand = $brand->field('id,name')->select();



        //分配数据
        $this->assign('option', $option);
        $this->assign('arr',$arr);
        $this->assign('brand',$arrBrand);
        //加载模板
        $this->display('Goods/picture-add');
    }

    /**
     * AJAX拿到商品子类
     */
    public function checkSon($id){

        if(IS_AJAX){
            $type = M('Type');
            $info = $type->where(['pid'=>$id])->select();
            if($info){

                $arr=$info;
            }else{
                $arr = 1;
            }
            $this->ajaxReturn($arr);
            
        }
    }

    /**
     * 显示商品规格参数模板
     */
    public function paramAdd() {

        $type = D('Type');
        $option = $type->getParam();
        $this->assign('option', $option);
        $this->display('Goods/param-add');
    }

    /**
     * 处理商品模板参数
     */
    public function paramSave() {
        if(IS_POST) {
            $arr=I('post.');
            //处理数组数据
            $a= (array_slice($arr,0,1,true));
            $b = json_encode(array_splice($arr, 1)); 
            //保存模板      
            $param = M('GoodsParamTemplate');
            $data = $param->add(['item_cat_id'=>$a[renew], 'param_data'=>$b]);
            if ($data) {
                $this->success('添加成功');
            } else {
                $this->error('添加失败');
            }
        }
    }

    /**
     * AJAX拿取模板参数
     */
    public function getParam($id) {
        if(IS_AJAX){
            $type = M('GoodsParamTemplate');
            $info = $type->where(['item_cat_id'=>$id])->getfield('param_data');
            if($info){

                $arr=$info;
            }else{
                $arr = 1;
            }
            $this->ajaxReturn($arr);
        }
    }
    
    /**
     * 商品提交处理
     */
    public function insert() {
        //实例化一个空对象
        $mol = M('');
        //开启事务处理
        $mol->startTrans();

        $goods = D('Goods');

        //拿到处理好的商品数组
        $arr = $goods->addGoods();

        $picture = D('Picture');
        //获取上传图片路径
        $p_data = $picture->added();

        $cover = $p_data[0]['pic'];

        //对数组进行自动验证
        $data = $goods->create($arr);
        //获取上传图片的第一张为商品封面
        $data['cover'] = $cover;
       
        if(!$data) {
            $this->error($goods->getError());
        } else{
            //保存商品数据，成功返回最后插入的自增ID
            $info = $goods->field('des,cover,bid,promotion_price,tid,name,brand,subtitle,price,desc,content,addtime')->data($data)->add();
        }

        //循环数组添加商品ID
        foreach ($p_data as $key => $value) {
            $p_data[$key]['gid'] = $info;
        }

        //插入数据
        $setdata = $picture->addAll($p_data);
        if(!$setdata) { 
            $this->error('插入图片失败');
        }

        //处理商品属性
        $property = D('GoodsProperty');

        $property_data = $property->manageProperty();

        //循环添加商品ID
        foreach($property_data as $j =>$z) {
            $property_data[$j]['gid'] = $info;
        }

        //插入商品属性数据
        $property_arr = $property->addAll($property_data);

        if (!$property_arr) {$this->error('商品属性插入失败');};

        //获取AJAX前台商品参数数据
        $param = M('GoodsParam');

        //获取所需要的数组
        $paramArr['item_id'] = $info;
        $paramArr['param_data'] = $_POST['param_data'];
        //存储
        $setParam = $param->add($paramArr);
       

    
        //进行事务判断
        if($info && $setParam && $setdata && $property_arr) {
            //成功提交事务
            $mol->commit();
            $this->success('商品添加成功');
        } else {
            //失败回滚事务
            $mol->rollback();
            $this->error('商品添加失败');
        }
    }

    /**
     * 显示商品列表
     * @return [type] [description]
     */
    public function productsList() {
        $goods = D('Goods');

        //实现分页类
        //统计商品数
        $count = $goods->count();

        //实例化分页类
        $Page = new \Think\Page($count,10);

        //分页显示输出
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show = $Page->show();

        //调用Model层处理数组
        $goodsList = $goods->field('id,name,price,addtime,status,promotion_price')->order('addtime desc')->limit($Page->firstRow.','.$Page->listRows)->showList();

        //分配数据
        $this->assign('list',$goodsList);
        $this->assign('page',$show);
        
        //加载模板
        $this->display('Goods/Products_List');
    }

    //AJAX删除商品
    public function delGoods() {
        if(IS_AJAX) {   
            //接收id
            $id = I('post.id');

            //实例化对象
            $goods = M('Goods');

            $del= $goods->where(['id'=>$id])->delete();

            if($del) {
                $this->ajaxReturn(1);
            } else {
                $this->ajaxReturn(2);
            }
        }
    }

    //ajax修改状态
    public function amendGoods() {
        //接手id
        $id=I('post.id');

        //实例化对象
        $goods=M('Goods');

        $status = $goods->where(['id'=>$id])->find();

        //获取商品状态
        $info = $status['status'];

        $info = $info + 1;

        if($info > 3) {
            $info = 1;
        }

        $status['status'] = $info;

        $data = $goods->where(['id'=>$id])->save($status);

        if($data) {
            $this->ajaxReturn($info);
        }
    }

    //显示商品编辑
    public function amendPicture() {
        $id = I('get.id');

        $goods =D('Goods'); 

        //查询商品信息
        $arr = $goods->field('tid,name,id,brand,subtitle,price,promotion_price,desc,content,cover')->where(['id'=>$id])->find();

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

        //查询商品属性
        $property = M('GoodsProperty');
        $propertys = $property->where(['gid'=>$id])->select();

        //查询商品参数
        $param = M('GoodsParam');
        $params = $param->field('param_data')->where(['item_id'=>$id])->find();

        $brand = M('Brand');
        $arrBrand = $brand->field('id,name')->select();


        //分配数据
        $this->assign('goods',$arr);
        $this->assign('type',$types);
        $this->assign('param',$params);
        $this->assign('property',$propertys);
        $this->assign('brand',$arrBrand);
        //加载模板
        $this->display('Goods/picture-amend');
    }

    //商品编辑
    public function edit(){
        $arr = I('post.');
         //实例化一个空对象
        $mol = M('');
        //开启事务处理
        $mol->startTrans();

        //实例化商品
        $goods = D('Goods');

        //实例化商品图片
        $picture = D('Picture');
        //获取上传图片路径
        $p_data = $picture->added();
        if ($p_data){

        $cover = $p_data[0]['pic'];
        //获取上传图片的第一张为商品封面
        $arr['cover'] = $cover;
        }

        //保存商品数据，成功返回最后插入的自增ID
        $info = $goods->where(['id'=>$arr['id']])->save($arr);

        if($p_data) {
        //循环数组添加商品ID
        foreach ($p_data as $key => $value) {
            $p_data[$key]['gid'] = $arr['id'];
        }

        //删除旧商品图片
        $del = $picture->where(['gid'=>$arr['id']])->delete();
        //插入数据
        $setdata = $picture->addAll($p_data);

        }

        //处理商品属性
        $property = D('GoodsProperty');
        //处理属性数组
        $property_data = $property->manageProperty();


        //循环添加商品ID
        foreach($property_data as $j =>$z) {
            $property_data[$j]['gid'] = $arr['id'];
        }

        //删除旧商品属性
        $del = $property->where(['gid'=>$arr['id']])->delete();

        //插入商品属性数据
        $property_arr = $property->addAll($property_data);

        if (!$property_arr) {
            $this->error('商品属性插入失败');
        };
        //进行事务判断
        if($info) {
            //成功提交事务
            $mol->commit();
            $this->success('商品编辑成功');
        } else {
            //失败回滚事务
            $mol->rollback();
            $this->error('商品编辑失败');
        }
    }

}