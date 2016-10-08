<?php

/**
 * 婚礼信息表
 */

class WeddingWeddingModel extends BaseModel{

	protected $table='wedding';

	public function get_by_uid($user_id){

		$sql="SELECT * FROM tt_wedding WHERE groom_id=".(int)$user_id." OR bride_id=".(int)$user_id;

		return $this->find($sql);
	}

	public function get_by_id_and_uid($wedding_id,$user_id){

		$sql="SELECT * FROM tt_wedding WHERE id=".(int)$wedding_id." AND (groom_id=".(int)$user_id." OR bride_id=".(int)$user_id.")";

		return $this->get($sql);
	}
}