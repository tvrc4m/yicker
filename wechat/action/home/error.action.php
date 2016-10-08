<?php

class ErrorAction extends AppAction {

	protected $lang="";

	public function index() {

    	$this->footer=array('hide_tabbar'=>1);

		$this->display('common/error');
  	}

  	public function error_404(){

  		$this->title='404页面';

		$this->display('common/404');
  	}
}
