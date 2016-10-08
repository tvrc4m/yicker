<?php

/**
 * 红包列表
 */
class Red_pocketAction extends VKWeddingAction
{

	protected $lang='wedding/wedding';
    
    public function index(){

    	if(ispost() && $this->validate()){


    	}

    	$this->flushform($this->post,array(),array('amount','content'));

    	$this->title='朋友的红包和祝福';
    	
    	$this->display('wedding/red_pocket_list');
    }
}