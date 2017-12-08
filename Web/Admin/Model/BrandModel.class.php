<?php
namespace Admin\Model;
use Think\Model;

class BrandModel extends Model
{   
    /**
     * 商品品牌
     */
    public function brandPictrye() {
        $brandInfo = I('post.');
        if (!empty($brandInfo)){
            // 实例化上传类
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
            
            if( !empty($info)) {
                //得到图片路径
                $a = '';
                foreach ($info as $k=>$v) {
                    $a= "/Test/Public/Admin/Uploads/".$info[$k]['savename'];
                }
                
                return $a;
            }
        
        } 
    }
}