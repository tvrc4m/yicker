<?php

class ProductAttrGroupModel extends BaseModel{

	protected $table='attr_group';

	public function addAttrGroup($data){

		return $this->insert($data);
	}

	public function updateAttrGroup($attr_group_id,$data){

		return $this->update($data,array('attr_group_id'=>$attr_group_id));
	}

	public function getAttrGroup($attr_group_id){

		return $this->one(array('attr_group_id'=>$attr_group_id));
	}

	public function listAttrGroups($data){

		$sql="SELECT * FROM ".DB_PREFIX.$this->table." WHERE deleted=0 ";

	    if (!empty($data['filter_name'])) {
	    	$sql .= " AND name LIKE '%" . $this->escape($data['filter_name']) . "%'";
	    }
	    
	    if ($data['filter_status']!==null) {
	        $sql .= " AND status=" . (int)$data['filter_status'];
	    }
	    
	    if (!empty($data['filter_create_date'])) {
	        $sql .= " AND DATE_FORMAT(created_date,'%Y-%m-%d')='" . $data['filter_create_date']."'";
	    }
	    // echo $sql;exit;
	    $sql.=" ORDER BY created_date DESC";

	    if (isset($data['start']) || isset($data['limit'])) {

	        $data['start'] < 0 && $data['start'] = 0;
	        $data['limit'] < 1 && $data['limit'] = 20;

	        $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
	    }
	    
	    return $this->find($sql);
	}

	public function countAttrGroups($data){

		$sql="SELECT count(*) as count FROM ".DB_PREFIX.$this->table." WHERE 1 ";

	    if (!empty($data['filter_name'])) {
	    	$sql .= " AND name LIKE '%" . $this->escape($data['filter_name']) . "%'";
	    }
	    if ($data['filter_status']!==null) {
	        $sql .= " AND status=" . (int)$data['filter_status'];
	    }
	    if (!empty($data['filter_create_date'])) {
	        $sql .= " AND DATE_FORMAT(created_date,'%Y-%m-%d')='" . $data['filter_create_date']."'";
	    }

	    return $this->count($sql);
	}
}
