<?php

class WechatGroupModel extends BaseModel{

	protected $table='wechat_group';

	public function delGroupsNotIn($groups){

		$sql="DELETE FROM ".DB_PREFIX.$this->table." WHERE id NOT IN (".implode(',', $groups).")";

		$this->query($sql);
	}
}