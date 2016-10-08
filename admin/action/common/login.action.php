<?php  

class LoginAction extends Action {

	protected $lang='common/login';

	public function index() {

		S('AID') && go('/admin/');

		if (($_SERVER['REQUEST_METHOD'] == 'POST')) {

			$status=M('common/login','local.admin',array('uname'=>$_POST['username'],'password'=>$_POST['password']));
			
			// echo admin_url('common','index');exit();
			$status==1 && go(admin_url('common/index'));

			$this->error['warning']=$status;
		}

		$this->flushform($_POST,array(),array('username','password'));

		$this->display('common/login');
  	}
}