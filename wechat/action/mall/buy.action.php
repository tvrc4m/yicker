<?php

class BuyAction extends VKMallAction {

	  protected $lang="checkout/cart";

  	public function index() {

		  if(ispost() && $this->validate()){

			    $result=M('checkout/checkout','buy',$_POST);

	        $key=$result['key'];

	        $url=shop_url('checkout',array('sid'=>$key));

	        exit(json_encode(array('ret'=>1,'url'=>$url)));
		  }

		  exit(json_encode(array('ret'=>-1,'errors'=>$this->error)));
    }

    private function validate(){

      foreach ($_POST['items'] as $k=>$item) {
        
        empty($item['item_id']) && $this->error['items'][$k]['item']='未传产品id';

        (empty($item['quantity']) || $item['quantity']<1) && $this->error['items'][$k]['quantity']=L('error_quantity');

        $check=M('checkout/cart','check',$item);

        !$check && $this->error['items'][$k]['options']=L('error_option');
      }

      if($this->error){

        $this->error['warning']=L('error_warning');

        return false;
      }

      return true;
    }
}
