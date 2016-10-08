<?php

class ProductItemOptionModel extends BaseModel{

	protected $table='item_option';

	public function getItemOptions($item_id){

		return $this->select(array('item_id'=>$item_id));
	}
}