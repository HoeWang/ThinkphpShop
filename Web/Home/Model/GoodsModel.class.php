<?php
namespace Home\Model;
use Think\Model;
class GoodsModel extends Model
{
	public $count = '';	// 用于存放搜索到的数据数量

	public function getData(){
		$arr = $this->find();
        
        if($arr) {
            $arr['addtime'] = date('Y-m-d H:i',$arr['addtime']);
        }
        
        return $arr;

	}	


	/**
	 * 商品类型搜索   yanhui
	 */
	public function typeSearch($q, $s){
		
		// 拼接 where 条件
		$where = 'name="'.$q.'"';
		
		// 去shop_type表中搜索
		$type = M('type');
		$res = $type->where($where)->find();
		
		if (!$res) return '';
		if ($res) {
			// 获得 path 中的逗号数量
			$dn = substr_count($res['path'], ',');
			// 创建XS对象
			$xs = new \XS('goods');
        	$search = $xs->search;
        	$search->setCharset('UTF-8');

			if ($dn == 3) {
				// 三级分类 直接按类名 搜索商品

           	 	$arr = $search->setQuery('tname:('.$q.') AND status:2')->search();
            	
			} elseif ($dn == 2) {
				// 二级分类 查找出包含的 三级分类后 遍历搜索商品
				// 查找出所有三级分类
				$types = $type->where('pid='.$res['id'])->getField('id,name');
				// 定义一个数组 将遍历后的数据放在数组中
				$arr = [];
				foreach ($types as $v) {
					$ar = $search->setQuery('tname:('.$v.') AND status:2')->search();

					foreach ($ar as $va) {
						$arr [] = $va;
						
					}
					
				}
				
			} elseif($dn == 1) {
				// 顶级分类 循环遍历 出所有三级分类后 搜索商品
				
				// 查找出二级分类
				$types = $type->where('pid='.$res['id'])->getField('id,name');
				// 定义一个数组 准备存放搜索到的商品数据
				$arr = [];
				// 遍历二级分类
				foreach ($types as $k => $v) {
					// 查出二级分类下的三级分类
					$typex = $type->where('pid='.$k)->getField('id,name');
					// 遍历三级分类
					foreach ($typex as $val) {
						// 搜索三级分类下的商品
						$ar = $search->setQuery('tname:('.$val.') AND status:2')->search();
						// 遍历查找出的结果,放入准备的数组中
						foreach ($ar as $value) {
							$arr[] = $value;
						}
					}
				}
				
			}
			// 统计商品数量
            $this->count = count($arr);
            
            if (!empty($s)) {
            	if (strpos($s, 'price') !== false) {
					// 按价格从高到低
					for ($i = 0; $i < $this->count; $i++) {
						for ($j = $i; $j < $this->count; $j++) {
							if ($arr[$i]->price < $arr[$j]->price) {
								$z = $arr[$j];
								$arr[$j] = $arr[$i];
								$arr[$i] = $z;
							}
						}
					}

					// 按价格从低到高
					if (strpos($s, 'ASC')) {
						$arr = array_reverse($arr);
					} 
            		
            	} elseif (strpos($s, 'sold') !== false) {
            		// 按销量从高到低
					for ($i = 0; $i < $this->count; $i++) {
						for ($j = $i; $j < $this->count; $j++) {
							if ($arr[$i]->sold < $arr[$j]->sold) {
								$z = $arr[$j];
								$arr[$j] = $arr[$i];
								$arr[$i] = $z;
							}
						}
					}

					// 按销量从低到高
					if (strpos($s, 'ASC')) {
						$arr = array_reverse($arr);
					} 
            	}
            	
            }
			
		}
		
		return $arr;
	}
}