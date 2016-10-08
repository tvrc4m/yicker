<?php

/**
 * 我参加的婚礼
 */
class JoinAction extends VKMyAction
{
    
    public function index(){
    		
    	$this->title='我参加的婚礼';

    	$joined_wedding=M('user/wedding','get_joined_wedding',array($this->user_id));

    	// print_r($joined_wedding);exit;
    	$this->assign(array('joined_wedding'=>$joined_wedding));

    	$this->display('account/join');
    }
}