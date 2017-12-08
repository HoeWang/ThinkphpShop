<?php
namespace Admin\Controller;
use Think\Controller;
class SystemsController extends CommonController {
    public function index(){
        $this->display('Systems/systems');
    }
}