<?php

/**
 * 商城search页
 */
class SearchAction extends AppAction{

    public function index($data){

		$this->assign($data);

        return $this->fetch('mall/search');
    }

    protected function get_children(){
		
		return array();
	}
}