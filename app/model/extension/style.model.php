<?php

class ExtensionStyleModel extends BaseModel{

	protected $table='style';

	public function addStyle($data){

		return $this->insert($data);
	}

	public function getStyle($style_id){

		return $this->one(array('style_id'=>$style_id));
	}

	public function selectStyle($params){

		return $this->select($params);
	}

	public function updateStyle($style_id,$data){

		return $this->update($data,array('style_id'=>$style_id));
	}
}