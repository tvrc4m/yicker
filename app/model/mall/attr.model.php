<?php

class MallAttrModel extends BaseModel{

	protected $table='mall_item_attr';

	public function listAttrs($data){

		$sql="SELECT a.*,g.name as group_name FROM ".DB_PREFIX.$this->table." a,".DB_PREFIX."attr_group g WHERE a.attr_group_id=g.attr_group_id AND a.deleted=0 ";

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

	public function countAttrs($data){

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
