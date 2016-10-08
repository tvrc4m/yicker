<?php

class LogoutAction extends AdminAction{

	public function index(){

		S('AID',null);

		S('ADMIN',null);

		C('ADMINLOGGED',null);

		unset($_SESSION);

		session_destroy();

		go('/admin/index.php?app=login');
	}
}