<?php

/**
 * 导航栏
 */
class NavbarAction extends AppAction{

    public function index($data){

		$this->assign($data);

        return $this->fetch('common/navbar');
    }

    protected function get_children(){
		
		return array();
	}
}