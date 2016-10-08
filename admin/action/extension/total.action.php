<?php

class TotalAction extends AdminAction {

	protected $lang='extension/total';

	public function index() {

		$totals=M::extension('extension','installed',array('type'=>'total'));

		$this->assign(array('totals'=>$totals));

		$this->display('extension/total');
	}
	
	public function install() {
		
		$code=$_GET['code'];

		if(empty($code)) return false;

		M::extension('extension','install',array('type'=>'total','code'=>$code));

		go(admin_url('extension/total'));
	}
	
	public function uninstall() {
		
		$code=$_GET['code'];
		
		if(empty($code)) return false;

		M::extension('extension','uninstall',array('code'=>$code));

		go(admin_url('extension/total'));
	}
}