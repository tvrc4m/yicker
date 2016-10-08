<?php

/**
 * 底部tabbar
 */
class TabbarAction extends AppAction{

    public function index($data){

    	$bar_items=array(
    		array('name'=>'首页','icon'=>'home','link'=>'/','selected'=>$data['tabbar_home']),
    		array('name'=>'婚礼','icon'=>'wedding','link'=>'/wedding','selected'=>$data['tabbar_wedding']),
    		array('name'=>'发现','icon'=>'discover','link'=>'/discover','selected'=>$data['tabbar_discover']),
    		array('name'=>'我的','icon'=>'me','link'=>'/me','selected'=>$data['tabbar_mine']),
    	);

		$this->assign($data);
		$this->assign(array('bar_items'=>$bar_items));

        return $this->fetch('common/tabbar');
    }

    protected function get_children(){
		
		return array();
	}
}