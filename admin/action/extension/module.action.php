<?php

class ModuleAction extends AdminAction {

	protected $lang='extension/module';

	public function index() {

		$this->title='安装模块';

		$modules=M('extension/extension','installed',array('type'=>'module'));

		$this->assign(array('modules'=>$modules));
		
		$this->display('extension/module');
	}
	
	public function install() {
		
		$code=$_GET['code'];

		if(empty($code)) return false;

		M('extension/extension','install',array('type'=>'module','code'=>$code));

		go(admin_url('extension/module'));
	}
	
	public function uninstall() {

		$code=$_GET['code'];

		if(empty($code)) return false;

		M('extension/extension','uninstall',array('code'=>$code));

		go(admin_url('extension/module'));
	}
}