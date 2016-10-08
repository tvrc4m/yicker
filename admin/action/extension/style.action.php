<?php

class StyleAction extends AdminAction {

	protected $lang='extension/style';

	protected $type=array('custom'=>'自定义','product'=>'产品','category'=>'类别');

	public function index() {

		$this->title=L('heading_title');

		$styles=M('extension/style','list');

		$data=array('styles'=>$styles,'types'=>$this->type,'insert'=>admin_url('extension/style/insert'));

		$this->assign($data);

		$this->display('extension/style_list');
	}

	public function insert(){

		if(ispost() && $this->validateForm()){

			M('extension/style','add',$_POST);

			redirect(admin_url('extension/style'));
      	}

		$this->getForm();
	}

	public function update(){

		if(ispost() && $this->validateForm()){

			$style_id=$_GET['id'];
			
			M('extension/style','edit',array('style_id'=>$style_id,'data'=>$_POST));

			redirect(admin_url('extension/style'));
      	}

		$this->getForm();
	}

	private function getForm(){

		$style_id=$_GET['id'];

		if(empty($style_id)){

			$action=admin_url('extension/style/insert');
		}else{

			$style=M('extension/style','detail',$style_id);

			$action=admin_url('extension/style/update/'.$style_id);
		}
		// print_r($style);exit;
		$this->flushform($_POST,$style,array('name','title','type','content'));

		$data=array(
			'action'	=>$action,
			'types'		=>$this->type
		);

		$this->assign($data);

		$this->display('extension/style_form');
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