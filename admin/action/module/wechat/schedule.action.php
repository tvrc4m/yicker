<?php

class ScheduleAction extends AdminAction {

	protected $lang='module/banner';

	public function index() {

		if (ispost() && $this->validate()) {

			foreach ($_POST['banner_modules'] as $k=>&$module) {

				empty($module['code']) && $module['code']='banner.'.uniqid();
			}
			
			M('setting/setting','add',array('group'=>'banner'));

			go(admin_url('extension/module'));
		}

		$banners=M('extension/banner','list');
		// print_r($banners);exit;
		$this->flushform($_POST,$this->settings,array('banner_modules'));

		$data=array('banners'=>$banners);

		$this->assign($data);

		$this->display('module/banner');
	}

	private function validate(){

		$modules=$_POST['banner_modules'];

		foreach ($modules as $k=>$module) {
			
			empty($module['title']) && $this->error['banner'][$k]['title']=L('error_title');

			empty($module['banner_id']) && $this->error['banner'][$k]['banner']=L('error_banner');
		}

		if($this->error){

			$this->error['waring']=L('error_warning');

			return false;
		}

		return true;
	}
}
