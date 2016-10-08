<?php

class WeddingRedpocket extends Medium{

	public function send($wedding_id,$amount,$bless){

		$this->wedding_red_pocket->insert(array('wedding_id'=>$wedding_id,'amount'=>$amount,'bless'=>$bless,'status'=>1,'create_date'=>time()));
	}

	/**
	 * 根据wedding_id获取结婚红包
	 * @param  integer $wedding_id
	 * @return array 红包列表
	 */
	public function wedding($wedding_id){

		if (empty($wedding_id)) return array();

		return $this->wedding_red_pocket->select(array('wedding_id'=>$wedding_id));
	}

	/**
	 * 获取用户在某个婚礼上送出的红包
	 * @param  string $wedding_code 婚礼邀请码
	 * @return array wedding表信息
	 */
	public function user_wedding($wedding_id,$user_id){

		if (empty($wedding_id) || empty($user_id))	return array();

		return $this->wedding_red_pocket->select(array('wedding_id'=>$wedding_id,'user_id'=>$user_id));
	}

	/**
	 * 获取用户送出的红包
	 * @param  string $wedding_code 婚礼邀请码
	 * @return array wedding表信息
	 */
	public function user($wedding_id,$user_id){

		if (empty($user_id)) return array();

		return $this->wedding_red_pocket->select(array('user_id'=>$user_id));
	}
}