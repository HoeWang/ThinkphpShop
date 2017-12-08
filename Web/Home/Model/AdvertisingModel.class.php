<?php
namespace Home\Model;
use Think\Model;

class AdvertisingModel extends Model
{

	

	/**
	 * 二维数组排序,按二维数组中的值排序
	 */
	public function arrSort($tid){

    	$arr = $this->where('tid='.$tid.' and status=1')->select();

		$sort = array(
		     'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
		     'field'     => 'orderby',       //排序字段
		);

		$arrSort = array();

		foreach($arr AS $uniqid => $row){

			foreach($row AS $key=>$value){

		    	$arrSort[$key][$uniqid] = $value;
		 	}
		}

		if($sort['direction']){

			array_multisort($arrSort[$sort['field']], constant($sort['direction']), $arr);
		}

		return $arr;
	}


}