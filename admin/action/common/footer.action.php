<?php

class FooterAction extends AdminAction {

	protected $lang="common/footer";

	protected function index() {
		
		return $this->fetch('common/footer');
  	}
}
