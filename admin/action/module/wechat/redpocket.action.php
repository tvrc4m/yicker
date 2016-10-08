<?php

class RedpocketAction extends AdminAction {

	protected $lang='extension/module';

	public function index() {

		if (ispost() && $this->validate()) {
			
			M('setting/setting','add',array('group'=>'navbar'));

			go(admin_url('extension/module'));
		}
		
		$this->title=L('redpocket');

		$this->flushform(array(),array());
		
		$data=array('action'=>admin_url('module/navbar'),'navbars'=>$result,'parents'=>$parents);

		$this->assign($data);

		$this->display('module/redpocket');
	}

	private function validate(){

		foreach ($_POST['navbars'] as $k=>$bar) {
			
			empty($bar['name']) && $this->error[$bar['row']]['name']=L('error_name');

			empty($bar['link']) && $this->error[$bar['row']]['link']=L('error_link');
		}
		
		if($this->error){

			$this->error['warning']=L('error_warning');
			// print_r($this->error);exit;
			return false;
		}

		return true;
	}
}
