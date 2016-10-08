<?php

class IndexAction extends VKMallAction{

	public function index(){

        $this->title="婚礼商城";

       
		$this->display('mall/index');
	}
}