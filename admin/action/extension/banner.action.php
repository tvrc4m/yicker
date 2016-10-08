<?php

class BannerAction extends AdminAction {

	protected $lang='extension/banner';

	public function index() {

		$this->title=L('heading_title');

		$banners=M('extension/banner','list');

		$data=array('banners'=>$banners,'insert'=>admin_url('extension/banner/insert'));

		$this->assign($data);

		$this->display('extension/banner_list');
	}

	public function insert(){

		if(ispost() && $this->validateForm()){

			M('extension/banner','add',$_POST);

			redirect(admin_url('extension/banner'));
      	}

		$this->getForm();
	}

	public function update(){

		if(ispost() && $this->validateForm()){

			$banner_id=$_GET['id'];
			
			M('extension/banner','edit',array('banner_id'=>$banner_id,'data'=>$_POST));

			redirect(admin_url('extension/banner'));
      	}

		$this->getForm();
	}

	public function upload() { 

     	$path = '/image/banner/'.uniqid('TB').'.jpg';
     	
        $status=moveUploadedImage($_FILES,'banner',ROOT.$path,2097152);

        if($status==1){

            exit(json_encode(array('ret'=>$status,'path'=>sprintf('http://%s%s',$_SERVER['HTTP_HOST'],$path),'name'=>$path)));
        }else{
            exit(json_encode(array('ret'=>-1,'error'=>'上传主图失败。')));
        }
    }

	private function getForm(){

		$banner_id=$_GET['id'];

		if(empty($banner_id)){

			$action=admin_url('extension/banner/insert');
		}else{

			$banner=M('extension/banner','detail',$banner_id);

			$action=admin_url('extension/banner/update/'.$banner_id);
		}
		// print_r($banner);exit;
		$this->flushform($_POST,$banner,array('name','status','images'));

		$data=array(
			'action'=>$action,
			'position'	=>$this->position,
			'installed'	=>$installed,
			'upload'=>admin_url('extension/banner/upload'),
		);

		$this->assign($data);

		$this->display('extension/banner_form');
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