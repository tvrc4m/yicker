<?php

/**
 * 首页
 */
class SettingAction extends VKMyAction{
    
    public function index(){
    	
    	$this->title='设置';

    	$this->display('setting/setting');
    }
}