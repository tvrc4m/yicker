<?php

class CommonRegister extends Medium{

	protected $model_user;

	public function run($action,$data){

		$this->model_user=D('user/user');
	
		switch ($action) {
	
			case 'phone':return $this->phone($data['phone'],$data['password']);break;

			case 'wechat':return $this->wechat($data);break;
		}
	}
	
	private function phone($phone,$password){

		$salt=substr(md5(uniqid(rand(), true)), 0, 32);

		if(empty($phone) || empty($password)) return '手机号和密码不能为空';

		$user_exist=$this->model_user->one(array('phone'=>$phone));

		if (!empty($user_exist)) return '手机号已经注册过,点击登录';

		$user=array('phone'=>$phone,'password'=>sha1($salt.$password),'salt'=>$salt,'status'=>1);
		
		$user_id=$this->model_user->insert($user);

		if(!$user_id) return '注册失败,请重试！';

		$user['id']=$user_id;

		$this->login_success($user);

		return true;
	}


	private function login_success($user){

		$uid=$user['id'];

		S('yicker.uid',$uid);

		S('yicker.user',$user);

		$ip=getip();

		$time=time();

		$logged="{$_SERVER['HTTP_HOST']};{$ip};{$uid};{$time}";
		
		C('LOGGED',encrypt($logged));
	}
}