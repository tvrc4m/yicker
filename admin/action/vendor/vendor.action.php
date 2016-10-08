<?php

class VendorAction extends AdminAction {

	protected $lang="vendor/vendor";
	
	public function index() {

		$this->title='代理商列表';

		$page=$_GET['page'];

        empty($limit) && $limit=30;

    	$filter_id=$this->filter('filter_id');
    	$filter_name=$this->filter('filter_name');
    	$filter_nick=$this->filter('filter_nick');
    	$filter_email=$this->filter('filter_email');
    	$filter_phone=$this->filter('filter_phone');
    	$filter_status=$this->filter('filter_status');
    	$filter_create_date=$this->filter('filter_create_date');
  		
  		$data = array(
    		'filter_id'	  => $filter_id,
    		'filter_name'	  => $filter_name,
    		'filter_nick'	  => $filter_nick,
    		'filter_phone'	  => $filter_phone,
    		'filter_email'	  => $filter_email,
    		'filter_status'	  => $filter_status,
    		'filter_create_date'	  => $filter_create_date,
    		'sort'            => $sort,
    		'order'           => $order,
    		'start'           => ($page - 1) * $limit,
    		'limit'           => $limit
    	);

    	$vendors=M('vendor/vendor','list',$data);
    	$total=M('vendor/vendor','count',$data);

    	foreach ($vendors as $k => $vendor) {
    			
    		$vendors[$k]['action'][]=array();
    	}
		// print_r($vendors);exit;
    	$data['vendors']=$vendors;
    	$data['insert']=admin_url('vendor/vendor/insert');
    	$data['urlpage']=page($total,$page,$limit);
    		
    	$this->assign($data);

    	$this->display('vendor/vendor_list');
	}

	public function info(){

		$vendor_id=$_GET['id'];

		$vendor=M('vendor/vendor','get',$vendor_id);

		$this->assign($vendor);

		$this->display('vendor/vendor_info');
	}

	public function insert(){

		$this->title=L('insert_title');

		if (ispost() && $this->validateForm()) {

			M('vendor/vendor','add',$_POST);

			redirect(admin_url('vendor/vendor'));
		}

		$this->assign(array('form_heading_title'=>L('insert_title')));

		$this->getForm();
	}

	public function update(){

		$this->title=L('update_title');

		if (ispost() && $this->validateForm()) {

			$vendor_id=$_GET['id'];

			M('vendor/vendor','edit',array('vendor_id'=>$vendor_id,'data'=>$_POST));

			redirect(admin_url('vendor/vendor'));
		}

		$this->assign(array('form_heading_title'=>L('update_title')));
		
		$this->getForm();
	}

	public function detail(){

		$vendor_id=$_GET['id'];

		if(empty($vendor_id)) exit('');

		$vendor=M('vendor/vendor','get',$vendor_id);

		exit(json_encode(array('phone'=>$vendor['phone'],'idcard'=>$vendor['idcard'])));
	}

	public function getForm(){

		if(!empty($_GET['id'])){

			$vendor=M('vendor/vendor','get',$_GET['id']);
			// print_r($vendor);exit;
			$vendor['password']='';

			$action=admin_url('vendor/vendor/update/'.$_GET['id']);
		}else{

			$action=admin_url('vendor/vendor/insert');
		}

		$form=array('vendor_id','name','nick','email','phone','idcard','password','repassword','status');

		$this->flushform($_POST,$vendor,$form);

		$data=array('action'=>$action);

		$this->assign($data);

		$this->display('vendor/vendor_form');
	}

	public function validateForm(){

		$vendor_id=$_GET['id'];

		if(empty($_POST['name'])){

			$this->error['name']=L('error_name');
		}
		if(empty($_POST['nick'])){

			$this->error['nick']=L('error_nick');
		}else{
			$vendors=M('vendor/vendor','get.by.nick',$_POST['nick']);

			if(empty($vendor_id)){

				!empty($vendors) && $this->error['nick']=L('error_exist_nick');
			}else{

				count($vendors)>1 && $this->error['nick']=L('error_exist_nick');
			}
		}
		if(empty($_POST['email']) || preg_match('/\w+@\w+\.\w+/',$_POST['email'])!=1){

			$this->error['email']=L('error_email');
		}else{

			$vendors=M('vendor/vendor','get.by.email',$_POST['email']);

			if(empty($vendor_id)){

				!empty($vendors) && $this->error['email']=L('error_exist_email');
			}else{

				count($vendors)>1 && $this->error['email']=L('error_exist_email');
			}
		}


		if(empty($_POST['phone']) || preg_match('/^\d{6,11}$/',$_POST['phone'])!==1){

			$this->error['phone']=L('error_phone');
		}

		(empty($_POST['idcard']) || strlen($_POST['idcard'])<15) && $this->error['card']=L('error_card');

		if(empty($vendor_id)){
			
			if(empty($_POST['password']) || strlen($_POST['password'])<6){

				$this->error['password']=L('error_password');
			}
			if(empty($_POST['repassword']) || $_POST['password']!=$_POST['repassword']){

				$this->error['repassword']=L('error_repassword');
			}
		}else{
			
			if(!empty($_POST['password']) && strlen($_POST['password'])<6){

				$this->error['password']=L('error_password');
			}
			if(!empty($_POST['repassword']) && $_POST['password']!=$_POST['repassword']){

				$this->error['repassword']=L('error_repassword');
			}
		}

		return !$this->error;
	}
}