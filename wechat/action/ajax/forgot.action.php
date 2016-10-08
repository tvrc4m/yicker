<?php

/**
 * 忘记密码
 */
class ForgotAction extends AjaxAction {

    protected $lang='user/account';
    
    public function index(){

    	if (ispost() && $this->valid()) {

    		$user=M('user/user','one',array(array('phone'=>$this->post['phone'])));

            try{

                M('user/user','update',array($user['id'],array('password'=>sha1($user['salt'].$this->post['password']))));

                exit(json_encode(array('status'=>200,'errmsg'=>'重置成功,正在跳转...','redirect'=>"/login")));

            }catch(VKException $e){

                exit(json_encode(array('status'=>500,'errmsg'=>'程序错误,正在刷新...')));
            }
    	}
    	
    	$this->error();
    }

    private function valid(){
        
        $phone=$this->post['phone'];
        $code=$this->post['code'];
        $password=trim($this->post['password']);
        $sms_phone=S('forgot_sms_phone');
        $sms_code=S('forgot_sms_code');

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

        if (empty($password)) {
            $this->error['password']=L('password_empty');
        }else if(strlen($password)<6 || strlen($password)>20){
            $this->error['password']=L('password_error');
        }

        return !$this->error;
    }
}