<?php

class LayoutAction extends AdminAction {

	protected $lang='extension/layout';

	protected $position=array('top'=>'顶部','right'=>'右边','left'=>'左边','bottom'=>'底部','middle'=>'中间');
	 
	public function index() {

		$layouts=M('extension/layout','list',array());

		$data=array(
			'insert'=>admin_url('extension/layout/insert'),
			'layouts'	=>$layouts,
		);

		$this->assign($data);

		$this->display('extension/layout_list');
	}

	public function insert(){

		if(ispost() && $this->validateForm()){

			$layout_id=M('extension/layout','add',$_POST);

			redirect(admin_url('extension/layout'));
      	}

		$this->getForm();
	}

	public function update(){

		if(ispost() && $this->validateForm()){

			$layout_id=$_GET['id'];
			
			$layout_id=M('extension/layout','edit',array('layout_id'=>$layout_id,'data'=>$_POST));

			redirect(admin_url('extension/layout'));
      	}

		$this->getForm();
	}

	public function delete(){

		$layout_id=$_GET['id'];
		
		$layout_id=M('extension/layout','del',$layout_id);

		redirect(admin_url('extension/layout'));
	}

	private function getForm(){

		$layout_id=$_GET['id'];

		if(empty($layout_id)){

			$action=admin_url('extension/layout/insert');
		}else{

			$layout=M('extension/layout','detail',$layout_id);

			$action=admin_url('extension/layout/update/'.$layout_id);
		}

		$this->flushform($_POST,$layout,array('name','routes','modules'));

		$installed=M('extension/extension','modules',array('type'=>'module'));

		foreach ($installed as $k => $install) {
			
			if(in_array($install['code'],array('haichang','beizhu','navbar','vdian'))){

				unset($installed[$k]);
			}
		}
		
		$data=array(
			'action'=>$action,
			'position'	=>$this->position,
			'installed'	=>$installed,
		);

		$this->assign($data);

		$this->display('extension/layout_form');
	}

	private function validateForm(){

		empty($_POST['name']) && $this->error['name']=L('error_name');

		if($this->error){

			$this->error['warning']=L('error_warning');

			return false;
		}

		return true;
	}
}