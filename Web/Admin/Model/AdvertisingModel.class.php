<?php
namespace Admin\Model;
use Think\Model;

class AdvertisingModel extends Model
{
	/**
	 * 处理广告列表数据
	 * @param  array $type 广告分类的分类名称
	 * @return array $arr  处理完成的数据
	 */
	public function ad_list($type)
	{
		$arr = $this->select();

		$status = ['已关闭','显示'];

		foreach ($arr as $k => $v) {

			$arr[$k]['tid'] = $type[$v['tid']];

			$arr[$k]['status'] = $status[$v['status']];

			$arr[$k]['addtime'] = date('Y-m-d H:i:s', $v['addtime']);
		}

		return $arr;
	}

	/**
	 * 分组统计每个字段的数量
	 */
	public function count_group($f1, $f2, $t){
		
        $arr = $this->field($f1.',count(*)')->group($f2)->select();

        foreach ($arr as $k => $v) {
        	$v['tname'] = $t[$v['tid']];
        	$arr[$k] = $v;
        	
        }
        
        return $arr;
	}
}