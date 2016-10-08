<?php

/**
 * 注册
 */
class RegisterAction extends AjaxAction{

    protected $lang='user/account';
    
    public function index(){

    	if (ispost() && $this->valid_sms()) {
    		
    		$status=M('common/register','phone',array('phone'=>$this->post['phone'],'password'=>$this->post['password']));

    		if($status===true){

                exit(json_encode(array('status'=>200,'errmsg'=>'注册成功,正在跳转...','redirect'=>$this->post['back']?$this->post['back']:'/')));  
            }
    	}

        $this->error();
    }

    public function sms(){
        
        if (ispost() && $this->valid_sms()) {
            
            $status=M('common/register','phone',array('phone'=>$this->post['phone'],'password'=>$this->post['password']));

            if($status===true){

                exit(json_encode(array('status'=>200,'errmsg'=>'注册成功,正在跳转...','redirect'=>$this->post['back']?$this->post['back']:'/')));  
            }
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
        }else{

            $user=M('user/user','one',array(array('phone'=>$phone)));

            !empty($user) && $this->error['user']=L('phone_exist');
        }

        if (empty($password)) {
            $this->error['password']=L('password_empty');
        }else if(strlen($password)<6 || strlen($password)>20){
            $this->error['password']=L('password_length_error');
        }

        return !$this->error;
    }

    private function valid_sms(){

        $phone=$this->post['phone'];
        $code=trim($this->post['code']);
        $sms_phone=S('register_sms_phone');
        $sms_code=S('register_sms_code');

        if (empty($phone)) {
            $this->error['phone']=L('phone_empty');
        }elseif (!preg_match('/^\d{11}$/', $phone)) {
            $this->error['phone']=L('phone_format_error');
        }else if($sms_phone!=$phone){
            $this->error['phone']=L('phone_not_send');
        }else{

            $user=M('user/user','one',array(array('phone'=>$phone)));

            !empty($user) && $this->error['user']=L('phone_exist');
        }

        if (empty($code)) {
            $this->error['code']=L('code_empty');
        }else if(!preg_match('/^\d{4}$/', $code)){
            $this->error['code']=L('code_length_error');
        }else if($code!=$sms_code){
            $this->error['code']=L('code_error');
        }

        return !$this->error;
    }
}