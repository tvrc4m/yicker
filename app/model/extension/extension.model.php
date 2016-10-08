<?php

class ExtensionExtensionModel extends BaseModel{

	public function getExtensionByType($type='module'){

		$sql="SELECT code FROM ".DB_PREFIX."extension WHERE type='{$type}'";

		$extensions = $this->find($sql);

		$result=array();

		foreach ($extensions as $extension)  $result[]=$extension['code'];

		return $result;
	}

	public function delExtension($code){

		$sql="DELETE FROM ".DB_PREFIX."extension WHERE code='{$code}'";

		return $this->query($sql);
	}

	public function addExtension($type,$code){

		$sql="INSERT INTO ".DB_PREFIX."extension SET type='{$type}',code='{$code}'";

		return $this->query($sql);
	}
}