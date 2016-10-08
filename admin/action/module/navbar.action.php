<?php

class NavbarAction extends AdminAction {

	protected $lang='module/navbar';

	public function index() {

		if (ispost() && $this->validate()) {
			
			M('setting/setting','add',array('group'=>'navbar'));

			go(admin_url('extension/module'));
		}
		
		$this->title='设置导航';

		$navbars=isset($_POST['navbars'])?$_POST['navbars']:V('navbars');

		$combine=array();

		foreach ($navbars as $k=>$nav) {
			
			if($nav['parent']) $combine[$nav['parent']]['children'][]=$nav;
			else $combine[$nav['name']]['parent']=$nav;
		}

		$result=array();

		foreach ($combine as $res) {
			
			$result[]=$res['parent'];
			!empty($res['children']) && $result=array_merge($result,$res['children']);
		}

		$this->flushform(array(),array());
		
		$data=array('action'=>admin_url('module/navbar'),'navbars'=>$result,'parents'=>$parents);

		$this->assign($data);

		$this->display('module/navbar');
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
