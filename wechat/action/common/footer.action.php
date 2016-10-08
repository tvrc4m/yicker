<?php

class FooterAction extends AppAction {

	protected $lang="";

	protected function index($data) {
		
		$this->assign($data);

		return $this->fetch('common/footer');
  	}

  	protected function get_children(){

  		return array();
	}
}
