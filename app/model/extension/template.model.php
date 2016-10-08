<?php

class ExtensionTemplateModel extends BaseModel{

	protected $table='template';

	public function addTemplate($data){

		return $this->insert($data);
	}

	public function getTemplate($template_id){

		return $this->one(array('template_id'=>$template_id));
	}

	public function selectTemplate($params){

		return $this->select($params);
	}

	public function updateTemplate($template_id,$data){

		return $this->update($data,array('template_id'=>$template_id));
	}
}