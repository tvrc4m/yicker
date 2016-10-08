<?php

class ExtensionRecommendModel extends BaseModel{

	protected $table='recommend';

	public function addRecommend($data){

		return $this->insert($data);
	}

	public function getRecommend($recommend_id){

		return $this->one(array('recommend_id'=>$recommend_id));
	}

	public function selectRecommend($params){

		return $this->select($params);
	}

	public function updateRecommend($recommend_id,$data){

		return $this->update($data,array('recommend_id'=>$recommend_id));
	}
}