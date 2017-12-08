<?php
namespace Admin\Model;
use Think\Model;

class GoodsModel extends Model
{       
    //自动验证
    protected $_validate = [
        //检测商品名是否为空
        ['name', 'require', '请输入商品名'],
        // //验证商品名是否合格
        // ['name','/^[\w\x{4e00}-\x{9fa5}]+$/u','商品名格式错误'],
        //检测分类是否为空
        ['sire', 'require', '请选择分类'],
        //检测标题是否为空
        ['title', 'require', '请输入标题'],
        // //验证商品名是否合格
        // ['title','/^[\w\x{4e00}-\x{9fa5}]+$/u','商品标题格式错误'],
        //检测副标题是否为空
        ['subtitle', 'require', '请输副标题'],
        // //验证商品副标题是否合格
        // ['subtitle','/^[\w\x{4e00}-\x{9fa5}]+$/u','商品副标题格式错误'],
        //检测品牌名是否为空
        ['brand', 'require', '请输入品牌'],
        // //验证商品品牌是否合格
        // ['brand','/^[\w\x{4e00}-\x{9fa5}]+$/u','商品品牌格式错误'],
        //检测关键字是否为空
        ['desc', 'require', '请输关键字，请以逗号相隔'],
        //检测价格是否为空
        ['price', 'require', '请输入原价'],
        //正则判断价格
        ['price','/^\+?(?:[1-9]\d*(?:\.\d{1,2})?|0\.(?:\d[1-9]|[1-9]\d))$/', '原价钱格式出错'],
        //检测品牌名是否为空
        ['content', 'require', '请输详细内容'],
        // //验证商品品牌是否合格
        // ['content','/^[\w\x{4e00}-\x{9fa5}]+$/u','详细内容格式错误'],
    ];

    /**
    *处理商品类别ID
    */
    public function addGoods() {
        //存放商品表数据数据
        $arr = I('post.');

        $arr['addtime'] = time();
        //处理数据，判断是否是三级分类
        if (array_key_exists('minson',$arr)) {
            //获取三级分类的ID
            unset($arr['sire']);
            foreach($arr as $k=>$v){
                if($k == 'minson' ) {
                    $arr['tid'] = $v;
                    unset($arr['minson']);
                    break; 
                }
            }
        }else {
            //拿到二级分类ID
            foreach($arr as $a=>$b){
                if($a == 'son') {
                    $arr['tid'] = $b;
                    unset($arr['son']);
                    break;
                }
            }
        }
        

        return $arr;
    }

    /**
     * 商品列表处理
     */
    public function showList() {

        $list = $this->select();

        $state = ['1'=>'新添加', '2'=>'在售中', '3'=>'已下架'];
        foreach ($list as $k=>$v) {
            $list[$k]['status'] = $state[$v['status']];
            $list[$k]['addtime'] = date('Y-m-d H:i',$v['addtime']);
        }
        
        return $list;
    }
}