<?php

class WeddingWedding extends Medium{

	/**
	 * 根据wedding_id获取婚礼wedding信息
	 * @param  integer $wedding_id
	 * @return array wedding表信息
	 */
	public function get($wedding_id){

		return $this->wedding_wedding->one(array('id'=>$wedding_id));
	}

	public function get_wedding($wedding_id,$user_id){

		$wedding = $this->wedding_wedding->get_by_id_and_uid($wedding_id,$user_id);
		
		if (!empty($wedding)) {

			$wedding['wedding_date']=date('Y-m-d',$wedding['wedding_date']);
			$wedding['wedding_time']=date('H:i:s',$wedding['wedding_date']);
		}
		
		return $wedding;
	}

	/**
	 * 通过邀请码获取婚礼wedding信息
	 * @param  string $wedding_code 婚礼邀请码
	 * @return array wedding表信息
	 */
	public function get_by_code($wedding_code){

		$results=$this->wedding_wedding->selectByParams(array('wedding_code'=>$wedding_code));

		return $results[0];
	}

	/**
	 * 通过用户id获取婚礼wedding信息
	 * @param  string $wedding_code 婚礼邀请码
	 * @return array wedding表信息
	 */
	public function get_user_weddings($user_id){

		$weddings= $this->wedding_wedding->get_by_uid($user_id);

		foreach ($weddings as &$wedding) {
			
			$wedding['wedding_date']=date('Y-m-d',$wedding['wedding_date']);
			$wedding['wedding_time']=date('H:i:s',$wedding['wedding_date']);
		}

		return $weddings;
	}

	/**
	 * 判断用户举行或参加过的婚礼
	 * @return array
	 */
	public function user_have_and_join_wedding($user_id){

		$user_have_weddings=$this->wedding_wedding->get_by_uid($user_id);

		$user_join_weddings=M('user/wedding','get_joined_wedding',array($user_id));

		if(empty($user_have_weddings) && empty($user_join_weddings)) return array();

		return array('have'=>$user_have_weddings,'join'=>$user_join_weddings);
	}

	/**
	 * 判断此wedding是否是用户一员
	 * @param  int  $wedding_id
	 * @param  int  $user_id    
	 * @return array             
	 */
	public function has($wedding_id,$user_id){

		if(empty($wedding_id) || empty($user_id)) return array();

		return $this->wedding_wedding->get_by_id_and_uid($wedding_id,$user_id);
	}

	/**
	 * 取消参与婚礼
	 * @param  integer $wedding_id 
	 * @param  integer $user_id    
	 * @return boolean  是否成功取消
	 */
	public function leave($wedding_id,$user_id){

		return $this->wedding_user->update(array('status'=>0),array('wedding_id'=>$wedding_id,'user_id'=>$user_id));
	}

	/**
	 * 举行婚礼
	 * @param  array $data wedding信息
	 * @return wedding_id      
	 */
	public function have($user_id,$data){
		
		$data['wedding_code']=uniqid();
		
		try{

			// $this->wedding_wedding->start_trans();

			$wedding_id=$this->wedding_wedding->insert($data);

			if ($wedding_id) {

				$this->user_user->have_wedding_update($user_id,$wedding_id);

				// $this->wedding_wedding->commit();

				return $wedding_id;
			}
			// $this->wedding_wedding->rollback();
		}catch(Exception $e){
			
			// $this->wedding_wedding->rollback();

			return false;
		}
	}

	public function update_wedding($wedding_id,$params){
		
		return $this->wedding_wedding->update($params,array('id'=>$wedding_id));
	}
}