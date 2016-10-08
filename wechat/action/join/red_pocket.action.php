<?php

/**
 * 发送红包
 */
class Red_pocketAction extends VKWeddingAction
{

	protected $lang='join/join';
    
    public function index(){

    	if(ispost() && $this->validate()){


    	}

    	$this->flushform($this->post,array(),array('amount','content'));

    	$this->title='发红包, 送祝福';
    	
    	$this->display('join/red_pocket');
    }

    protected function validate(){

    	$amount=$this->post['amount'];
    	$content=$this->post['content'];

    	if(empty($amount)){
    		$this->error['amount']=L('empty_red_pocket_amount');
    	}else if(intval($amount)<0){
    		$this->error['amount']=L('negative_red_pocket_amount');
    	}

    	return !$this->error;
    }
}