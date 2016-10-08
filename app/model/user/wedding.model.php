<?php

/**
 * 计划任务
 */

class UserWeddingModel extends BaseModel{

	protected $table='schedule';

	/**
	 * 获取用户所有的计划任务
	 * @param  integer $user_id 
	 * @return array   二维数组
	 */
	public function getUserSchedules($user_id){

		return $this->select(array('where'=>array('user_id'=>$user_id,'deleted'=>0)));
	}

	/**
	 * 获取某个计划任务
	 * @param  integer $user_id 
	 * @param  integer $schedule_id    
	 * @return array           
	 */
	public function getSchedule($user_id,$schedule_id){

		return $this->one(array('schedule_id'=>$schedule_id,'user_id'=>$user_id));
	}

	/**
	 * 参加计划任务
	 * @param  array $params    
	 * @return integer   插入的id
	 */
	public function addSchedule($params){

		$params=array_merge($params,array('status'=>0,'deleted'=>0,'create_date'=>time()));

		return $this->insert($params);
	}

	/**
	 * 更新计划任务
	 * @param  integer $schedule_id 
	 * @param  array $params     更改数据
	 * @return
	 */
	public function updateUserWedding($schedule_id,$params){

		return $this->update(array('schedule_id'=>$schedule_id),$params);
	}
}