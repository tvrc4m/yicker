<?php

/**
 * 忘记密码
 */
class ForgotAction extends AppAction {

    protected $lang='user/account';
    
    public function index(){

        $this->is_login && go('/');

        $back=$this->get['back'];

    	$this->title='找回密码';

        $this->navbar['left_navbar']=array();
        $this->navbar['right_navbar']=array(array('icon'=>'fa-sign-in','name'=>'','href'=>'/register'));
        $this->tabbar['hide_tabbar']=1;

        $this->assign(array('back'=>$back));

        $this->flushform($_POST,array(),array('phone'));
    	
    	$this->display('account/forgot');
    }
}