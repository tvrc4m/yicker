<?php

class SettingToken extends Medium{

	public function run($action,$data){
	
		switch ($action) {
	
			case 'add':return $this->add($data);break;

			case 'get':return $this->get($data['platform']);break;

			case 'del':return $this->del($data['platform']);break;
		}
	}

	public function add($data){

		$setting_token=D('setting/token');

		$token=$setting_token->getToken($data['platform']);

		if(empty($token)){

			$setting_token->addToken(array('platform'=>$data['platform'],'token'=>$data['token'],'expired'=>$data['expired'],'ctime'=>time()));
		}else{

			$setting_token->updateToken($data['platform'],array('token'=>$data['token'],'expired'=>$data['expired'],'ctime'=>time()));
		}
	}

	public function get($platform){

		$setting_token=D('setting/token');

		$token=$setting_token->getToken($platform);

		$now=time();

		if(empty($token) || $token['ctime']+$token['expired']<$now){
			return;
		}

		return $token['token'];
	}

	public function del($platform){

		$setting_token=D('setting/token');

		return $token=$setting_token->delToken($platform);
	}
}