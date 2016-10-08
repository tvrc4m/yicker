<?php

/**
 * 首页
 */
class IndexAction extends VKDiscoverAction {
    
    public function index(){

    	$this->title='发现';

    	$this->navbar['right_navbar']=array('first'=>array('href'=>'javascript:void(0);','icon'=>'fa-share'));
    	$this->navbar['left_navbar']=array();
    	
    	$this->display('discover/index');
    }
}