<?php

class SettingStore extends Medium{

	public function run($action,$data){
	
		switch ($action) {
	
			case 'all':return $this->all($data);break;
	
		}
	}
	
	private function all($data){
		
		$stores=SQL::setting('store','getAllStores',array());

		empty($stores) && $stores[]=array('store_id'=>0,'name'=>'Default','url'=>'http://'.$_SERVER['HTTP_HOST']);

		return $stores;
	}
}