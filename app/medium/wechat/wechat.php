<?php

use WeChat\Auth as wechat_auth;

class WechatWechat extends Medium {
	
	public function __construct(){

		include_once(EXTENSION."wechat/wechat.class.php");
	}	

	public function get_access_token(){

		$wechat_auth=new wechat_auth();

		$access_token=$wechat_auth->get_access_token();

		return $access_token;
	}

	public function get_js_sign(){

		$wechat_auth=new wechat_auth();

		$signPackage=$wechat_auth->get_js_sign(BASEURL);

		return $signPackage;
	}

	
}