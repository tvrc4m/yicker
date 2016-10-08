<?php

/**
 * 我的
 */
class IndexAction extends VKMyAction{

	public function index(){

		$this->title='我的';

    	$this->navbar['left_navbar']=array();

    	$this->display('account/mine');
    }
}
