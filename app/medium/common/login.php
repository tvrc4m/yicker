<?php

class CommonLogin extends Medium{

	/**
	 * 通过手机和密码登录
	 * @param  int $phone    手机号
	 * @param  string $password 密码
	 * @return
	 */
	public function phone($phone,$password){
		
		if(empty($phone) || empty($password)) return '手机或密码不能为空';

		$user=$this->user_user->one(array('phone'=>$phone));

		if(empty($user)) return '用户名错误';

		if($user['password']!=sha1($user['salt'].$password)) return '密码错误';

		if (!empty($user['avatar'])) {
			
			include_once EXTENSION.'aliyun/oss/OssClient.php';

	        $client=new OssClient('oss-cn-qingdao.aliyuncs.com');

	        $object=$client->getObjectMeta('yicker-avatar',$user['avatar']);

	        $user['avatar_url']=$object['oss-request-url'];
		}

		update_user_session($user);

		return true;
	}

	/**
	 * 通过手机验证码登录
	 * @param  int $phone    手机号
	 * @param  string $password 密码
	 * @return
	 */
	public function sms($phone){
		
		$user=$this->user_user->one(array('phone'=>$phone));

		if(empty($user)) return '用户名错误';

		if (!empty($user['avatar'])) {
			
			include_once EXTENSION.'aliyun/oss/OssClient.php';

	        $client=new OssClient('oss-cn-qingdao.aliyuncs.com');

	        $object=$client->getObjectMeta('yicker-avatar',$user['avatar']);

	        $user['avatar_url']=$object['oss-request-url'];
		}

		update_user_session($user);

		return true;
	}

	public function admin($data){
		
		$uname=$data['uname'];
		$password=$data['password'];

		if(empty($uname) || empty($password)) return '用户及密码不能为空';

		$admin=D('admin/admin')->getAdmin($uname);
		
		if(empty($admin)) return 'no this user';

		if($admin['password']!=SHA1($admin['salt'].SHA1($admin['salt'].SHA1($password)))) return '密码错误';
		
		$uid=$admin['uid'];
		
		S('LOGGED',$uid);

		S('ADMIN',$admin);

		$ip=getip();

		$time=time();

		$logged="{$_SERVER['HTTP_HOST']};{$ip};{$uid};{$time}";
		
		C('ADMINLOGGED',encrypt($logged));

		return 1;
	}

	
}