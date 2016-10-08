<?php

class SettingStoreModel extends BaseModel{

	public function getAllStores(){

		$sql="SELECT * FROM ".DB_PREFIX."store;";

		return $this->find($sql);
	}
}