<?php

class ExtensionBannerImageModel extends BaseModel{

	protected $table='banner_image';

	public function addBannerImage($data){

		return $this->insert($data);
	}

	public function getBannerImages($banner_id){

		return $this->select(array('where'=>array('banner_id'=>$banner_id)));
	}

	public function updateBannerImage($banner_image_id,$data){

		return $this->update($data,array('banner_image_id'=>$banner_image_id));
	}

	public function delBannerImage($banner_id,$banner_images){

		$sql="DELETE FROM ".DB_PREFIX.$this->table." WHERE banner_id=".(int)$banner_id." AND banner_image_id NOT IN (".implode(',',$banner_images).")";

		$this->query($sql);
	}
}