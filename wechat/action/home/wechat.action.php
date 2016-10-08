<?php

/**
 * 微信
 */
class WechatAction extends Action
{
    
    public function valid(){

    	$str = M('wechat/wechat','check_signature',$_GET);
    	
    	exit($str);
    }

    public function redirect_wechat(){
    	M('wechat/wechat','get_oauth_redirect',array(BASEURL.'home/wechat/get_access_token'));
    }

    public function get_access_token(){
    	M('wechat/wechat','get_oauth_access_token',array('code'=>$this->get['code']));
    }
}