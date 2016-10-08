<?php

class ShippingAction extends AdminAction {

	protected $lang='extension/shipping';

	public function index() {
		
		$shippings=M::extension('extension','installed',array('type'=>'shipping'));

		$this->assign(array('shippings'=>$shippings));

		$this->display('extension/shipping');
	}
	
	public function install() {

		$code=$_GET['code'];

		if(empty($code)) return false;

		M::extension('extension','install',array('type'=>'shipping','code'=>$code));

		go(admin_url('extension/shipping'));
	}
	
	public function uninstall() {

		$code=$_GET['code'];

		if(empty($code)) return false;

		M::extension('extension','uninstall',array('code'=>$code));

		go(admin_url('extension/shipping'));
	}
}
