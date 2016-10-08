<?php

/**
 * 退出 
 */
class LogoutAction extends Action
{
    
    public function index(){

    	session_destroy();

    	go('/');
    }
}