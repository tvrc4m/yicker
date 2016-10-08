<?php

class BaseModel extends MysqlModel{

	public function selectByParams($params,$order=array()){

		return $this->select(array('where'=>$params,'sort'=>$order));
	}
}