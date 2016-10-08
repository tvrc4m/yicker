<?php

/**
 * 登录页
 */
class LoginAction extends AjaxAction {

    protected $lang='user/account';
    
    public function index(){

    	if (ispost() && $this->valid()) {

    		$status=M('common/login','phone',array($this->post['phone'],$this->post['password']));

    		if($status===true){

    			exit(json_encode(array('status'=>200,'errmsg'=>'登陆成功,正在跳转...','redirect'=>$this->post['back']?$this->post['back']:'/')));
    		}

            $this->error['user']=$status;
    	}

    	$this->error();
    }

    public function sms(){

        if (ispost() && $this->valid_sms()) {

            $status=M('common/login','sms',array($this->post['phone']));

            if($status===true){

                exit(json_encode(array('status'=>200,'errmsg'=>'登陆成功,正在跳转...','redirect'=>$this->post['back']?$this->post['back']:'/')));
            }

            $this->error['user']=$status;
        }

        $this->error();
    }

    private function valid(){

        $phone=$this->post['phone'];
        $password=trim($this->post['password']);

        if (empty($phone)) {
            $this->error['phone']=L('phone_empty');
        }elseif (preg_match('^\d{11}$', $phone)) {
            $this->error['phone']=L('phone_format_error');
        }

        if (empty($password)) {
            $this->error['password']=L('password_empty');
        }else if(strlen($password)<6 || strlen($password)>20){
            $this->error['password']=L('password_error');
        }

        return !$this->error;
    }

    private function valid_sms(){
        
        $phone=$this->post['phone'];
        $code=$this->post['code'];
        $sms_phone=S('login_sms_phone');
        $sms_code=S('login_sms_code');

        if (empty($phone)) {
            $this->error['phone']=L('phone_empty');
        }elseif (!preg_match('/^\d{11}$/', $phone)) {
            $this->error['phone']=L('phone_format_error');
        }else if(!empty($sms_phone) && $sms_phone!=$phone){
            $this->error['phone']=L('phone_not_send');
        }

        if(empty($code)){
            $this->error['code']=L('code_empty');
        }else if(!preg_match('/^\d{4}$/',$code)){
            $this->error['code']=L('code_length_error');
        }else if($sms_code!=$code){
            $this->error['code']=L('code_error');
        }

        return !$this->error;
    }
}