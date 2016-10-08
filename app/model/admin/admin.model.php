<?php

class AdminAdminModel extends BaseModel{

	protected $table='admin';

	public function getAdmin($nick){

		return $this->one(array('nick'=>$nick,'status'=>1));
	}

	public function getAdminByID($uid){

		return $this->one(array('uid'=>$uid));
	}
}