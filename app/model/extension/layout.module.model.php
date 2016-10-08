<?php

class ExtensionLayoutModuleModel extends BaseModel{

	protected $table='layout_module';

	public function addLayoutModule($data){

		return $this->insert($data);
	}

	public function delLayoutModule($layout_id){

		return $this->delete(array('layout_id'=>$layout_id));
	}

	public function getLayoutModule($layout_id){

		return $this->select(array('where'=>array('layout_id'=>$layout_id)));
	}

	public function getLayoutModuleByPosition($layout_id,$position){

		return $this->select(array('where'=>array('layout_id'=>$layout_id,'position'=>$position),'sort'=>array('sort DESC')));
	}
}