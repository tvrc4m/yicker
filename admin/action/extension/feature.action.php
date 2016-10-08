<?php

class FeatureAction extends AdminAction {

	protected $lang='extension/feature';

	public function index() {

		$this->title=L('heading_title');

		$features=M('extension/feature','list');

		$data=array('features'=>$features,'insert'=>admin_url('extension/feature/insert'));

		$this->assign($data);

		$this->display('extension/feature_list');
	}

	public function insert(){

		if(ispost() && $this->validateForm()){

			M('extension/feature','add',$_POST);

			redirect(admin_url('extension/feature'));
      	}

		$this->getForm();
	}

	public function update(){

		if(ispost() && $this->validateForm()){

			$feature_id=$_GET['id'];
			
			M('extension/feature','edit',array('feature_id'=>$feature_id,'data'=>$_POST));

			redirect(admin_url('extension/feature'));
      	}

		$this->getForm();
	}

	public function upload() { 

     	$path = '/image/feature/'.uniqid('TB').'.jpg';
     	
        $status=moveUploadedImage($_FILES,'feature',ROOT.$path,2097152);

        if($status==1){

            exit(json_encode(array('ret'=>$status,'path'=>sprintf('http://%s%s',$_SERVER['HTTP_HOST'],$path),'name'=>$path)));
        }else{
            exit(json_encode(array('ret'=>-1,'error'=>'上传主图失败。')));
        }
    }

	private function getForm(){

		$feature_id=$_GET['id'];

		if(empty($feature_id)){

			$action=admin_url('extension/feature/insert');
		}else{

			$feature=M('extension/feature','detail',$feature_id);

			$items=$feature['items'];

			$action=admin_url('extension/feature/update/'.$feature_id);
		}
		// print_r($feature);exit;
		$this->flushform($_POST,$feature,array('name','title','width','height'));

		if(isset($_POST['items'])){

			$items=array();

			if(!empty($_POST['items'])){

				$items=D('product/item')->getItemsByIDs($_POST['items']);
			}
		}

		$data=array(
			'action'	=>$action,
			'position'	=>$this->position,
			'installed'	=>$installed,
			'items'		=>$items,
			'upload'	=>admin_url('extension/feature/upload'),
		);

		$this->assign($data);

		$this->display('extension/feature_form');
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