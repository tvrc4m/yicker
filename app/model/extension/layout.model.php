<?php

class ExtensionLayoutModel extends BaseModel{

	protected $table='layout';

	public function addLayout($data){

		return $this->insert($data);
	}

	public function getLayout($layout_id){

		return $this->one(array('layout_id'=>$layout_id));
	}

	public function editLayout($layout_id,$data){

		return $this->update($data,array('layout_id'=>$layout_id));
	}

	public function delLayout($layout_id){

		$this->delete(array('layout_id'=>$layout_id));
	}

	public function listLayout(){

		$sql="SELECT * FROM ".DB_PREFIX.$this->table." WHERE 1 ";

	    if (isset($data['start']) || isset($data['limit'])) {

	        $data['start'] < 0 && $data['start'] = 0;
	        $data['limit'] < 1 && $data['limit'] = 40;

	        $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
	    }
	    
	    return $this->find($sql);
	}
}