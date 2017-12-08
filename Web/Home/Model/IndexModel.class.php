<?php
namespace Home\Model;
use Think\Model;
class IndexModel extends Model
{
	Protected $tableName = "goods";
	public function getData($i){
		if($i == 1){
			$where['tid'] = ['eq',174];
					
		}elseif($i == 2){
			$where['tid'] = ['eq',175];

		}elseif($i == 3){
			$where['tid'] = ['eq',176];
		}else{
			$where['tid'] = ['eq',177];
		}

		$arr = $this->where($where)->select();
		foreach($arr as $k=>$v){
			$info = $this->table('__PICTURE__')->where("gid = ".$v['id'])->find();
			$arr[$k]['pic'] = $info['pic'];
		}
		return $arr;
	}	
}
