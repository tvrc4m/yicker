<?php

class CheckoutAction extends VKMallAction {

  	protected $lang=array("checkout/cart","checkout/checkout");

  	public function index() {

        $key=$_GET['sid'];

        if(ispost() && $this->validate($key)){

            $status=M('checkout/checkout','confirm',$_POST);

            if($status==0){

              $this->error['warning']=L('error_failure');
            }else if($status==-1){
              
              $this->error['warning']=L('error_balance');
            }

            redirect(shop_url('checkout/success'));
        }

        $result=S($key);
        $items=$result['items'];
        $total=$result['total'];

        if(empty($items)) redirect(shop_url());

        $this->title=L('heading_title');

    		$text_cart=sprintf(L('text_items'),$count,'￥'.$total);

    		$data=array(
    			'text_cart'=>$text_cart,
    			'items'=>$result['items'],
    			'totals'=>$result['totals'],
          'key'=>$key,
    			'cart'=>shop_url('cart'),
    			'checkout'=>shop_url('checkout'),
    			'confirm'=>shop_url('checkout',array('sid'=>$key)),
          'disable'=>(int)$disable,
    		);
        
    		$this->assign($data);

        $this->flushform($_POST,$user,array('name','phone','shipping_method'));
        // print_r($this->error);exit;
        $this->display('checkout/checkout');
  	}

    private function validate($key){

      empty($key) && $key=$_POST['key'];

      $result=S($key);

      $items=$result['items'];
      $total=$result['total'];

      if(empty($items)) redirect(shop_url());

      $user=M('user/user','get',S('LOGGED'));

      if(empty($user)) redirect('logout');

      if($_POST['shipping_method']=='balance' && $user['amount']<$total){

          $this->error['warning']=L('error_balance');

          return false;
      }

      empty($_POST['name']) && $this->error['name']=L('error_name');

      (empty($_POST['phone']) || !preg_match('/^\d{6,11}$/',$_POST['phone'])) && $this->error['phone']=L('error_phone');

      if($this->error){

        $this->error['warning']=L('error_waring');

        return false;
      }

      return true;
    }
}