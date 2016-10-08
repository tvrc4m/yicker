<?php

class ProductItemAttrModel extends BaseModel{

	protected $table='item_attr';

	public function addItemAttr($data){

		return $this->insert($data);
	}

	public function getItemAttrs($item_id){

		return $this->select(array('item_id'=>$item_id,'deleted'=>0));
	}

	public function updateItemAttr($item_attr_id,$data){

		return $this->update($data,array('item_attr_id'=>$item_attr_id));
	}

	public function delItemAttr($item_id,$item_attr=array()){

		if(empty($item_attr)){

			$sql="UPDATE ".DB_PREFIX.$this->table." SET deleted=1 WHERE item_id=".(int)$item_id;
		}else{

			$item_attr=implode(',',$item_attr);

			$sql="UPDATE ".DB_PREFIX.$this->table." SET deleted=1 WHERE item_id=".(int)$item_id." AND item_attr_id NOT IN (".$item_attr.")";
		}

		return $this->query($sql);
	}
}