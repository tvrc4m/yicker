<?php

class WechatUser extends Medium{

	/**
	 * 根据user_id获取微信用户信息
	 * @param  integer $user_id
	 * @return array user表信息
	 */
	private function get($user_id){

		return $this->wechat_user->one(array('user_id'=>$user_id));
	}

	/**
	 * 获取所有群组
	 * @param  array $data 过滤数据 
	 * @return array users
	 */
	private function get_by_openid($open_id){

		return $this->wechat_user->one(array('open_id'=>$open_id));
	}

	public function list_users($data){

		return D('wechat/user')->listUsers($data);
	}

	public function count($data){

		return D('wechat/user')->countUsers($data);
	}
}