<?php

class MallOptionModel extends BaseModel{

	protected $table='mall_item_option';

	public function delItemOption($item_id,$item_option=array()){

		if(empty($item_option)){

			$sql="UPDATE ".DB_PREFIX.$this->table." SET deleted=1 WHERE item_id=".(int)$item_id;
		}else{

			$item_option=implode(',',$item_option);

			$sql="UPDATE ".DB_PREFIX.$this->table." SET deleted=1 WHERE item_id=".(int)$item_id." AND item_option_id NOT IN (".$item_option.")";
		}

		return $this->query($sql);
	}
}