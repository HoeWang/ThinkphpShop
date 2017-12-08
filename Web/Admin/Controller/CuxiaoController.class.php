<?php
namespace Admin\Controller;
use Think\Controller;

class CuxiaoController extends CommonController {
	/**
	 * 列表页
	 */
	public function index() {
		if (IS_POST) {
			// dump(I('post.'));
			$data = I('post.');
			$sale = M('Sales');
			$arr = $sale->add($data);
		}
		$sale = M('Sales');
		$arr = $sale->select();
		// dump($arr);
		$this->assign('list', $arr);
		$this->display();
	}

	/**
	 * 添加促销商品
	 */
	public function addSale() {
		$this->display();
	}
}