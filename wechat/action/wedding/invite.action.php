<?php

/**
 * 邀请函
 */
class InviteAction extends VKWeddingAction
{
    
    public function index(){
    	
    	$this->header['title']='邀请函';

    	$this->js=array(
    		'ueditor.config'=>'/static/third/ueditor/ueditor.config.js',
    		'ueditor'=>'/static/ueditor/third/ueditor.all.min.js',
    	);

    	$this->display('wedding/invite_letter');
    }
}