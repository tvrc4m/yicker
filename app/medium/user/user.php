<?php

class UserUser extends Medium{

	public function get($user_id){

		$user = $this->user_user->one(array('id'=>$user_id));

		if ($user['avatar']) {
			
			include_once EXTENSION.'aliyun/oss/OssClient.php';

	        $client=new OssClient('oss-cn-qingdao.aliyuncs.com');

	        $object=$client->getObjectMeta('yicker-avatar',$user['avatar']);

	        $user['avatar_url']=$object['oss-request-url'];
		}

        return $user;
	}

	public function one($params){

		return $this->user_user->one($params);
	}

	public function update($user_id,$params){

		return $this->user_user->update($params,array('id'=>$user_id));
	}
}