<?php

/**
 * 登录页
 */
class LoginAction extends AppAction {

    protected $lang='user/account';
    
    public function index(){

        $this->is_login && go('/');

        $back=$this->get['back'];

    	if (ispost() && $this->valid()) {

    		$status=M('common/login','phone',array('phone'=>$this->post['phone'],'password'=>$this->post['password']));

    		$status===true && ($this->post['back']?go($this->post['back']):go('/'));

            $back=$this->post['back'];

            $this->error['user']=$status;
    	}

    	$this->title='登陆';

        $this->navbar['left_navbar']=array();
        $this->navbar['right_navbar']=array(array('icon'=>'fa-sign-in','name'=>'','href'=>'/register'));
        $this->tabbar['hide_tabbar']=1;

        $this->assign(array('back'=>$back));

        $this->flushform($_POST,array(),array('phone'));
    	
    	$this->display('account/login');
    }

    public function sms(){

        $this->title='短信登录';

        $this->navbar['left_navbar']=array();
        $this->navbar['right_navbar']=array(array('icon'=>'fa-sign-in','name'=>'','href'=>'/register'));

        $this->display('account/login_sms');
    }

    private function valid(){
        print_r($this->post);
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
}