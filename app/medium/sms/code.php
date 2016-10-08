<?php

class SmsCode extends Medium{

	public function send($phone,$code,$type){
		// 发送短信验证码
		if($this->send_real($phone,$code)){

			S(sprintf('%s_sms_phone',$type),$phone);
			S(sprintf('%s_sms_code',$type),$code);

			$params=array('phone'=>$phone,'code'=>$code,'type'=>$type,'create_date'=>time(),'status'=>0);

			$this->sms_code->insert($params);

			return true;
		}

		return '验证码发送失败';
	}

	private function send_real($phone,$code){

		return true;
	}
}