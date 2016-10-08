<?php

class ItemAction extends VKMallAction{

	public function index(){

        $this->title="婚礼商城 - 懒人沙发";

		$this->display('mall/item');
	}
}