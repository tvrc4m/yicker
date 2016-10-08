<?php

class PaymentAction extends AdminAction {

	protected $lang='extension/payment';

	public function index() {
				
		$payments=M::extension('extension','installed',array('type'=>'payment'));

		$this->assign(array('payments'=>$payments));

		$this->display('extension/payment');
	}
	
	public function install() {
		
		$code=$_GET['code'];

		if(empty($code)) return false;

		M::extension('extension','install',array('type'=>'payment','code'=>$code));

		go(admin_url('extension/payment'));
	}
	
	public function uninstall() {

		$code=$_GET['code'];

		if(empty($code)) return false;

		M::extension('extension','uninstall',array('code'=>$code));

		go(admin_url('extension/payment'));
	}
}