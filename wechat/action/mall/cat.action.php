<?php

class CatAction extends VKMallAction{

	public function index(){

        $alias=$this->get['cat'];

        if(empty($alias)) go('/mall/');

        $cat=M('mall/cat','get_by_alias',array($alias));

		if(empty($alias)) go('/mall/');        

        $this->title="婚礼商城 - ".$cat['name'];

        $this->assign(array('cat'=>$cat));

		$this->display('mall/cat');
	}
}