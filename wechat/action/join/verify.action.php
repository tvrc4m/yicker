<?php

class VerifyAction extends VKWeddingAction{

	protected $valid_wedding;

	protected $lang='wedding/wedding';

	public function index(){

		if (ispost() && $this->valid()) {

    		go(sprintf("/join/%s",$this->post['code']));
		}

		$this->title='婚礼邀请码';

		$this->flushform($this->post,array(),array('code'));

		$this->display('join/code');
	}

	private function valid(){

		$wedding_code=$this->post['code'];

		if(empty($wedding_code)) 

			$this->error['code']=L('wedding_code_empty');
		else{

			$this->valid_wedding=M('wedding/wedding','get_by_code',array('wedding_code'=>$wedding_code));

			if(empty($this->valid_wedding)) 

				$this->error['code']=L('wedding_code_not_exists');
		}

		return !$this->error;
	}
}