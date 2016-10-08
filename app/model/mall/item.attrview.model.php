<?php

class ProductItemAttrviewModel extends BaseModel{

	protected $table='item_attr_view';

	public function getItemAttrs($item_id){

		return $this->select(array('where'=>array('item_id'=>$item_id,'deleted'=>0)));
	}
}