<?php

/**
 * 首页
 */
class JourneyAction extends VKWeddingAction
{
    
    public function index(){
    	
    	$this->title='婚礼圈';

    	$this->navbar['right_navbar']=array(array('href'=>'javascript:void(0);','icon'=>'fa-share'));

    	$this->display('wedding/journey');
    }
}