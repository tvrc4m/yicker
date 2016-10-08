<?php

class ProductOptionAttrModel extends BaseModel{

	protected $table='option_attr';

	public function addOptionAttr($data){

		return $this->insert($data);
	}

	public function getOptionAttrs($option_id){

		return $this->select(array('option_id'=>$option_id));
	}

	public function updateOptionAttr($option_attr_id,$data){

		return $this->select($data,array('option_attr_id'=>$option_attr_id));
	}
}