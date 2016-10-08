<?php
  
class IndexAction extends AdminAction {

	protected $lang="common/index";

	public function index() {

		$this->title=V('config_name');

		$this->display('common/home');
  	}
}