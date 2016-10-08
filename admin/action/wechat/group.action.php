<?php

class GroupAction extends AdminAction {

	public function index() {

		if (ispost() && $this->validate()) {
			
			M('wechat/group','update',$_POST);
		}
		
		$this->title='微信群组管理';

		$this->js=array('/static/admin/js/baiduTemplate.js');

		$exists=M('wechat/group','all');

		$groups=isset($_POST['groups'])?$_POST['groups']:$exists;
		// print_r($groups);exit;
		$this->flushform(array(),array());
		
		$data=array('action'=>admin_url('wechat/group'),'groups'=>json_encode($groups));

		$this->assign($data);

		$this->display('wechat/group');
	}

	private function validate(){

		foreach ($_POST['groups'] as $k=>$group) {
			
			empty($group['name']) && $_POST['groups'][$k]['error']='群组名称不能为空';
		}
		if($this->error){

			$this->error['warning']=L('error_warning');
			// print_r($this->error);exit;
			return false;
		}

		return true;
	}
}
