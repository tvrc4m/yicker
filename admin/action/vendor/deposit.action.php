<?php

class DepositAction extends AdminAction {

	protected $lang="vendor/deposit";
	
	public function index() {

		$this->title=L('heading_title');

		$page=$_GET['page'];

        empty($limit) && $limit=30;

    	$filter_name=$this->filter('filter_name');
    	$filter_phone=$this->filter('filter_phone');
    	$filter_start=$this->filter('filter_start');
    	$filter_end=$this->filter('filter_end');
  		
  		$data = array(
    		'filter_name'	  => $filter_name,
    		'filter_phone'	  => $filter_phone,
    		'filter_start'	  => $filter_start,
    		'filter_end'	  => $filter_end,
    		'sort'            => $sort,
    		'order'           => $order,
    		'start'           => ($page - 1) * $limit,
    		'limit'           => $limit
    	);

    	$deposits=M('vendor/deposit','list',$data);
    	$total=M('vendor/deposit','count',$data);

    	foreach ($vendors as $k => $vendor) {
    			
    		$vendors[$k]['action'][]=array();
    	}

    	$data['deposits']=$deposits;

    	$data['urlpage']=page($total,$page,$limit);
    		
    	$this->assign($data);

    	$this->display('vendor/deposit_list');
	}

	public function topup(){

		$amount=$_GET['amount'];

		$vendor_id=$_GET['vendor_id'];

		if($amount==0) exit(json_encode(array('ret'=>-1,'errors'=>array('amount'=>'请输入不等于0的值'))));

		if(empty($vendor_id)) exit(json_encode(array('ret'=>-1,'errors'=>array('amount'=>'请刷新后再试'))));

		$success=M('vendor/deposit','top.up',$_GET);

		if($success){

			$vendor=M('vendor/vendor','get',$vendor_id);

			exit(json_encode(array('ret'=>1,'amount'=>$vendor['amount'],'content'=>'充值成功!')));
		} 

	 	exit(json_encode(array('ret'=>-1,'errors'=>array('amount'=>'充值失败!'))));		
	}
}