<?php

class ExtensionBannerModel extends BaseModel{

	protected $table='banner';

	public function addBanner($data){

		return $this->insert($data);
	}

	public function getBanner($banner_id){

		return $this->one(array('banner_id'=>$banner_id));
	}

	public function selectBanner($params){

		return $this->select($params);
	}

	public function updateBanner($banner_id,$data){

		return $this->update($data,array('banner_id'=>$banner_id));
	}
}