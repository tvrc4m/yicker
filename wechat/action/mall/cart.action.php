<?php

class CartAction extends VKMallAction{

	protected $lang="checkout/cart";

  	public function index() {

      $this->title="婚礼商城 - 购物车";

      $this->navbar['right_navbar']['second']=array('href'=>'javascript:void(0);','icon'=>'fa-shopping-cart','sup'=>'<sup>4</sup>');

  		// list($carts,$count,$totals,$total)=M('checkout/cart','get');

  		// $text_cart=sprintf(L('text_items'),$count,'￥'.$total);

  		// $data=array('text_cart'=>$text_cart,'carts'=>$carts,'totals'=>$totals,'cart'=>vendor_url('cart'),'checkout'=>vendor_url('checkout'));

  		$this->assign($data);

  		$this->display('mall/cart');
  	}

    public function info(){

      list($carts,$count,$totals,$total)=M('checkout/cart','get');

      $text_cart=sprintf(L('text_items'),(int)$count,'￥'.(float)$total);

      $data=array('text_cart'=>$text_cart,'carts'=>$carts,'totals'=>$totals,'cart'=>vendor_url('cart'),'checkout'=>vendor_url('checkout'));

      $this->assign($data);

      echo $this->fetch('common/cart');
    }

  	public function add(){

      $item=$_POST['items'][0];

  		$item_id=$item['item_id'];
  		$options=$item['options'];
  		$quantity=$item['quantity'];

      $status=-1;

      if(ispost() && $this->validate($item)){

        $status=M('checkout/cart','add',array('item_id'=>$item_id,'options'=>$options,'quantity'=>$quantity));
      }

      exit(json_encode(array('ret'=>$status,'errors'=>$this->error)));
  	}

  	public function delete(){

  		$item_id=$_POST['item_id'];
		  $options=$_POST['options'];

		  if(!empty($item_id)){

			   $status=M('checkout/cart','delete',array('item_id'=>$item_id,'options'=>$options));
		  }

      exit(json_encode(array('ret'=>(int)$status)));
  	}

    public function checkout(){

      list($carts)=M('checkout/cart','get');

      $items=array();

      foreach ($carts as $cart) {

        $items[]=array('item_id'=>$cart['item_id'],'options'=>$cart['item_option'],'quantity'=>$cart['quantity']);
      }

      $result=M('checkout/checkout','buy',array('items'=>$items,'cart'=>1));

      $key=$result['key'];

      redirect(vendor_url('checkout',array('sid'=>$key)));
    }

    private function validate($item){

      empty($item['item_id']) && $this->error['item']='未传产品id';

      (empty($item['quantity']) || $item['quantity']<1) && $this->error['quantity']=L('error_quantity');

      // $check=M('checkout/cart','check',$item);

      // !$check && $this->error['options']=L('error_option');

      if($this->error){

        $this->error['warning']=L('error_warning');

        return false;
      }

      return true;
    }
}