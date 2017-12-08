<?php
namespace Admin\Controller;
use Think\Controller;

class AdvertisingController extends CommonController {

	/**
	 * 广告列表
	 *
	 */
    public function index(){
    	// 查找出所有广告分类的分类名
    	$type = D('adtype')->getField('id,name',true);
    	// 实例化Advertising对象
    	$ad = D('Advertising');
        // 查找出每个类型的广告数量
        $tidc = $ad->count_group('tid', 'tid', $type);
        
    	$res = $ad->ad_list($type);

        $count = $ad->count();

        $this->assign('list', $res);
        $this->assign('count', $count);
    	$this->assign('tidc', $tidc);

        $this->display('Advertising/index');
    }

    /**
     * 修改广告的状态、删除广告
     * 
     */
    public function handle(){
    	if(IS_AJAX){
    		$id = I('post.id','','trim');
    		$mark = I('post.mark','','trim');
			$ad = D('Advertising');
    		// 判断mark为1,将广告状态修改为隐藏
    		if($mark == 1){
    			$res = $ad->where('id='.$id)->save(['status'=>0]);
    			if($res > 0){
    				$this->ajaxReturn($res);
    			} else {
    				$this->ajaxReturn(0);
    			}
    		} else if($mark == 2){
    		// 当mark为2时,将广告状态修改为显示
    			$res = $ad->where('id='.$id)->save(['status'=>1]);
    			if($res > 0){
    				$this->ajaxReturn($res);
    			} else {
    				$this->ajaxReturn(0);
    			}
    		} else if($mark == 3){
    		// 当mark为3时,执行删除广告命令
    			$res = $ad->where('id='.$id)->delete();
    			if($res > 0){
    				$this->ajaxReturn($res);
    			} else {
    				$this->ajaxReturn(0);
    			}
    		} else if($mark == 'del_all'){
                $checkId = I('post.check_id');
                $res = $ad->where('id in('.$checkId.')')->delete();
                if ($res > 0) {
                    $this->ajaxReturn($res);
                } else {
                    $this->ajaxReturn(0);
                }
            }
    		
    	}

    }

    /**
     * 广告分类列表
     * 
     */
    public function sort_ads(){

    	$type = D('adtype');
    	$res = $type->select();
    	
    	$this->assign('adtype', $res);
        $this->display('Advertising/sort_ads');
    }

    /**
     * 分类查看广告列表
     */
    public function ads_list(){

        $type = D('adtype')->getField('id,name',true);
        
        $ad = D('Advertising');
        $res = $ad->where('tid='.I('tid'))->ad_list($type);
        
        $this->assign('list', $res);
        
        $this->display('Advertising/ads_list');
    }

    /**
     * 添加广告页面
     * 
     */
    public function upload(){
    	if(IS_POST){
    		if(empty(I()['ad_name'])) $this->error('名称不能为空');
    		if(empty(I()['tid'])) 	  $this->error('分类不能为空');
    		if(empty(I()['orderby'])) $this->error('排序不能为空');
    		if(empty(I()['ad_link'])) $this->error('链接不能为空');

    		$upload = new \Think\Upload();// 实例化上传类    
    		$upload->maxSize   =     3145728 ;// 设置附件上传大小    
    		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
    		$upload->savePath  =      ''; // 设置附件上传目录    
    		$upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录    
    		// 上传文件     
    		$info   =   $upload->upload();    
    		if(!$info) {
    			// 上传错误提示错误信息        
    			$this->error($upload->getError());    
    		} else {
    			// 上传成功        
    			$data = I();

    			// $data['ad_size'] = '100x100';
    			$data['addtime'] = time();
    			$data['ad_code'] = $info['photo']['savepath'].$info['photo']['savename'];
    			$ad = D('Advertising');
    			$ad->add($data);
    			$this->success('上传成功！'); 

    		}

    	} else {
    		// 查找出所有广告分类的分类名
	    	$typs = D('adtype')->getField('id,name',true);

	    	$this->assign('typs', $typs);

	    	$this->display('Advertising/add');
    	}
    	
    }

    /**
     * 修改广告
     */
    public function edit(){
	
    	// 实例化Advertising
    	$ad = D('Advertising');

    	if(IS_POST) {
    		$data = I();
    		$id = $_GET['id'];
			// $data['ad_code'] = $info['photo']['savepath'];
			$field = 'ad_name';
			$ad->where('id='.$id)->setField($data);;
			$this->success('修改成功！', U('Advertising/index')); 
    	} else {
			// 获取要编辑的广告的id
			$id = I()['id'];
	    	// 查找出广告的信息
	    	$res = $ad->where('id='.$id)->select();
	    	// 获得广告的分类
	    	$typs = D('adtype')->getField('id,name',true);

		    $this->assign('typs', $typs);
	    	$this->assign('list',$res);
	    	$this->display('Advertising/edit');
    	}
    	
    }

    /**
     * SEO管理
     */
    public function seo(){
        $seo = M('seo');
        if (IS_AJAX) {
            $id = I('post.id','','trim');
            $val = I('post.val','','trim');

            $info = $seo->where('id='.$id)->setField('description',$val);

            // $this->ajaxReturn($info);
        } else {
            $res = $seo->select();
            
            $this->assign('seo',$res);

            $this->display('Advertising/seo');
        }
        
    }

}