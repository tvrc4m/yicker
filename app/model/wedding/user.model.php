<?php

class WeddingUserModel extends BaseModel{

	protected $table='wedding_user';

	/**
	 * 获取婚礼列表
	 * @param  array $params 查询条件
	 * @return array
	 */
	public function get_user_joined_wedding($user_id){

		$sql="SELECT wu.wedding_id,w.groom,w.bride,w.wedding_date FROM tt_wedding_user wu INNER JOIN tt_wedding w ON wu.wedding_id=w.id WHERE wu.user_id=".(int)$user_id." GROUP BY wu.wedding_id";

		return $this->find($sql);
	}

	public function get_wedding_users($wedding_id){

		$sql="SELECT u.realname,u.phone,u.avatar FROM tt_wedding_user wu INNER JOIN tt_user u ON wu.user_id=u.id WHERE wu.wedding_id=".(int)$wedding_id." AND wu.status=1 ORDER BY wu.join_date ASC";

		return $this->find($sql);
	}
}