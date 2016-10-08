<?php

class TemplateAction extends AdminAction {

	protected $lang='extension/template';

	protected $type=array('custom'=>'自定义','product'=>'产品','category'=>'类别');

	public function index() {

		$this->title=L('heading_title');

		$templates=M('extension/template','list');

		$data=array('templates'=>$templates,'types'=>$this->type,'insert'=>admin_url('extension/template/insert'));

		$this->assign($data);

		$this->display('extension/template_list');
	}

	public function insert(){

		if(ispost() && $this->validateForm()){

			M('extension/template','add',$_POST);

			redirect(admin_url('extension/template'));
      	}

		$this->getForm();
	}

	public function update(){

		if(ispost() && $this->validateForm()){

			$template_id=$_GET['id'];
			
			M('extension/template','edit',array('template_id'=>$template_id,'data'=>$_POST));

			redirect(admin_url('extension/template'));
      	}

		$this->getForm();
	}

	private function getForm(){

		$template_id=$_GET['id'];

		if(empty($template_id)){

			$action=admin_url('extension/template/insert');
		}else{

			$template=M('extension/template','detail',$template_id);

			$action=admin_url('extension/template/update/'.$template_id);
		}
		// print_r($template);exit;
		$this->flushform($_POST,$template,array('name','title','type','content'));

		$data=array(
			'action'	=>$action,
			'types'		=>$this->type
		);

		$this->assign($data);

		$this->display('extension/template_form');
	}

	private function validateForm(){

		empty($_POST['name']) && $this->error['name']=L('error_name');

		empty($_POST['content']) && $this->error['content']=L('error_content');
		
		empty($_POST['type']) && $this->error['type']=L('error_type');

		if($this->error){

			$this->error['warning']=L('error_warning');

			return false;
		}

		return true;
	}
}