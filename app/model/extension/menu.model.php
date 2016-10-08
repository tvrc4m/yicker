<?php

class ExtensionMenuModel extends BaseModel{

	protected $table='menu';

	public function addMenu($data){

		return $this->insert($data);
	}

	public function getMenu($menu_id){

		return $this->one(array('menu_id'=>$menu_id));
	}

	public function selectMenu($params){

		return $this->select($params);
	}

	public function updateMenu($menu_id,$data){

		return $this->update($data,array('menu_id'=>$menu_id));
	}
}