<?php

class ExtensionFeatureModel extends BaseModel{

	protected $table='feature';

	public function addFeature($data){

		return $this->insert($data);
	}

	public function getFeature($feature_id){

		return $this->one(array('feature_id'=>$feature_id));
	}

	public function selectFeature($params){

		return $this->select($params);
	}

	public function updateFeature($feature_id,$data){

		return $this->update($data,array('feature_id'=>$feature_id));
	}
}