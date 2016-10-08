<?php

class SettingSettingModel extends BaseModel{

	protected $table='setting';

	public function addSetting($group,$key,$value){

		$serialized=0;

		if(is_array($value)){

			$value=serialize($value);

			$serialized=1;
		}

		$params=array('group'=>$group,'key'=>$key,'value'=>$value,'serialized'=>$serialized);

		return $this->insert($params);
	}

	public function delSetting($group){

		$params=array('group'=>$group);

		return $this->delete($params);
	}

	public function getAllSetting(){

		return $this->select();
	}

	public function getGroupSetting($group){
		
		return $this->select(array('where'=>array('group'=>$group)));
	}
}