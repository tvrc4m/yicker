<?php

class WechatGroup extends Medium{

	public function run($action,$data){
	
		switch ($action) {
	
			case 'get':return $this->get($data['group_id']);break;

			case 'all':return $this->all();break;

			case 'update':return $this->update($data);break;

			case 'add':return $this->add($data['name']);break;

			case 'has':return $this->has($data['name']);break;

		}
	}
	
	/**
	 * 根据group_id获取群组信息
	 * @param  integer $group_id
	 * @return array group表信息
	 */
	private function get($group_id){

		return $this->wechat_group->one(array('id'=>$group_id));
	}

	/**
	 * 获取所有群组
	 * @param  array $data 过滤数据 
	 * @return array groups
	 */
	private function all(){

		$results=$this->wechat_group->select();

		return $results;
	}

	private function update($data){

		$groups=$data['groups'];

		$exists=array();

		foreach ($groups as $group) {
			
			intval($group['id']) && $exists[]=$group['id'];
		}

		!empty($exists) && D('wechat/group')->delGroupsNotIn($exists);

		foreach ($groups as $group) {
			
			if (intval($group['id'])) {
				
				$this->wechat_group->update(array('name'=>$group['name']),array('id'=>$group['id']));
			}else{

				$this->add($group['name']);
			}
		}
	}

	/**
	 * 添加分组
	 * @param  integer $name 
	 * @param  integer $user_id    
	 * @return id   
	 */
	private function add($name){

		if ($this->has($name)) return 'exists';

		return $this->wechat_group->insert(array('name'=>$name,'create_date'=>time()));
	}

	/**
	 * 判断此分组是否存在
	 * @param  integer $group_id 
	 * @param  integer $user_id    
	 * @return boolean   true--已存在  false--不存在
	 */
	private function has($name){

		if(empty($name)) return true;

		$group =$this->wechat_group->one(array('name'=>$name));

		return !empty($group);
	}
}