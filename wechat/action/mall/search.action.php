<?php

class SearchAction extends VKMallAction{

	public function index(){

        $this->title="婚礼商城 - 懒人沙发";

		$this->display('mall/list');
	}
}