<?php

/**
 * 注册
 */
class RegisterAction extends AppAction{

    protected $lang='user/account';
    
    public function index(){

         $this->is_login && go('/');

         $back=$this->get['back'];

    	if (ispost() && $this->valid()) {
    		
    		$status=M('common/register','phone',array('phone'=>$this->post['phone'],'password'=>$this->post['password']));

    		$status===true && go('/');

            $back=$this->post['back'];
    	}

    	$this->title='注册';

        $this->navbar['left_navbar']=array();
        $this->navbar['right_navbar']=array(array('icon'=>'fa-sign-out','name'=>'','href'=>'/login'));
        $this->tabbar['hide_tabbar']=1;
        
        $this->assign(array('back'=>$back));
        
        $this->flushform($_POST,array(),array());

    	$this->display('account/register');
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
}