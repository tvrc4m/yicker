<?php

class MenuAction extends AdminAction {

	public function index() {

		if (ispost() && $this->validate()) {
			
			M('setting/setting','add',array('group'=>'navbar'));

			go(admin_url('extension/module'));
		}
		
		$this->title='微信菜单管理';

		$this->js=array('/static/admin/js/baiduTemplate.js');

		$menus=isset($_POST['menus'])?$_POST['menus']:V('menus');

		$combine=array();

		foreach ($menus as $k=>$menu) {
			
			if($menu['parent']) $combine[$menu['parent']]['children'][]=$menu;
			else $combine[$menu['name']]['parent']=$menu;
		}

		$result=array();

		foreach ($combine as $res) {
			
			$result[]=$res['parent'];
			!empty($res['children']) && $result=array_merge($result,$res['children']);
		}

		$this->flushform(array(),array());
		
		$data=array('action'=>admin_url('wechat/menu'),'menus'=>json_encode($result),'parents'=>$parents);

		$this->assign($data);

		$this->display('wechat/menu');
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
