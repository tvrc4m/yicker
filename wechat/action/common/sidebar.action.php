<?php

/**
 * 侧边栏
 */
class SidebarAction extends AppAction{

    public function left($data){

    	$this->assign($data);

    	$cats=M('mall/cat','all');

    	$this->assign(array('cats'=>$cats));

        return $this->fetch('common/sidebar_left');
    }

    protected function get_children(){
		
		return array();
	}
}