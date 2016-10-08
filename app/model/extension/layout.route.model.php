<?php

class ExtensionLayoutRouteModel extends BaseModel{

	protected $table='layout_route';

	public function addLayoutRoute($data){

		return $this->insert($data);
	}

	public function delLayoutRoute($layout_id){

		return $this->delete(array('layout_id'=>$layout_id));
	}

	public function getLayoutRoute($layout_id){

		return $this->select(array('where'=>array('layout_id'=>$layout_id)));
	}

	public function getAllRoutes(){

		return $this->select();
	}
}