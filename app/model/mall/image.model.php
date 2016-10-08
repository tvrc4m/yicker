<?php

class MallImageModel extends BaseModel{

	protected $table='mall_item_image';

	public function delItemImage($item_id,$item_image=array()){

		if(empty($item_image)) return;

		$item_image=implode(',',$item_image);

		$sql="UPDATE ".DB_PREFIX.$this->table." SET deleted=1 WHERE item_id=".(int)$item_id." AND item_image_id NOT IN (".$item_image.")";

		return $this->query($sql);
	}
}