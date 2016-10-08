<?php

/**
 * 参加婚礼的来宾
 */
class WeddingUser extends Medium{

	/**
	 * 参加婚礼
	 * @param  array $data 
	 * @return int       
	 */
	public function join($data){

		$data=array_merge($data,array('status'=>1,'create_date'=>time(),'join_date'=>time()));

		return $this->wedding_user->insert($data);
	}

	/**
	 * 判断用户是否已参与婚礼
	 * @param  integer $wedding_id 
	 * @param  integer $user_id    
	 * @return boolean
	 */
	public function joined($wedding_id,$user_id){

		$wedding = $this->wedding_user->one(array('wedding_id'=>$wedding_id,'user_id'=>$user_id));
		
		return $wedding['status']==1;
	}

	/**
	 * 获取参加某婚礼的用户--只取状态status=1的用户
	 * @param  int $wedding_id 
	 * @return array
	 */
	public function get_wedding_users($wedding_id){

		$users=$this->wedding_user->get_wedding_users($wedding_id);

		return $users;
	}

	/**
	 * 获取参加婚礼某个用户的基本信息
	 * @param  integer $wedding_id 
	 * @param  integer $user_id    
	 * @return array
	 */
	public function get_wedding_user_info($wedding_id,$user_id){

		return $this->wedding_user->one(array('wedding_id'=>$wedding_id,'user_id'=>$user_id));
	}

	/**
	 * 验证邀请码
	 * @param  string $wedding_code 
	 * @param  integer $user_id    
	 * @return int   
	 */
	public function verify($wedding_code,$user_id){

		$wedding=$this->wedding_wedding->one(array('wedding_code'=>$wedding_code));

		if (empty($wedding)) return -1;

		if ($wedding['groom_id']==$user_id || $wedding['bride_id']==$user_id) return -2;

		$wedding_id=$wedding['id'];

		$wedding_user=$this->get_wedding_user_info($wedding_id,$user_id);

		if (empty($wedding_user)) return 1;

		return $wedding_user['status']!=1;
	}
}