<?php
namespace Home\Model;

class AddressModel extends \Think\Model
{
	/**
	 * 开启自动验证
	 * @var [type]
	 */
	protected $_validate = [
	['address', 'require', '请输入详细地址',0],
	['mobile', 'require', '请输如手机号码',0],
	['mobile',"/^1(3[0-9]|4[57]|5[0-35-9]|7[0135678]|8[0-9])\\d{8}$/",'请输入正确的手机',2],
	];

	
	
}