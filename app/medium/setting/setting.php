<?php

class SettingSetting extends Medium{

	public function run($action,$data){
	
		switch ($action) {
	
			case 'add':return $this->add($data);break;

			case 'all':return $this->all();break;

			case 'group':return $this->group($data['group']);break;
	
		}
	}
	
	private function add($data){

		$group=$data['group'];
		
		$m_setting=D('setting/setting');

		$m_setting->delSetting($group);

		foreach($_POST as $k=>$v){

			$m_setting->addSetting($group,$k,$v);
		}
	}

	private function all(){

		$settings=D('setting/setting')->getAllSetting();

		$result=array();

		foreach ($settings as $k=>$setting) {
			
			$result[strtolower($setting['key'])]=$setting['serialized']?unserialize($setting['value']):$setting['value'];
		}

		return $result;
	}

	private function group($group){

		$settings=D('setting/setting')->getGroupSetting($group);

		$result=array();

		foreach ($settings as $k=>$setting) {
			
			$result[strtolower($setting['key'])]=$setting['serialized']?unserialize($setting['value']):$setting['value'];
		}

		return $result;
	}
}