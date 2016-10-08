<?php

class MallCart extends Medium{

	protected $item_id=0;
	protected $options=array();
	protected $quantity=1;
	protected $cart=array();

	public function run($action,$data){

		$this->cart=S('cart');

		$this->item_id=$data['item_id'];
		$this->options=$data['options'];
		$this->quantity=$data['quantity'];
		switch ($action) {

			case 'get':return $this->get();break;

			case 'add':return $this->add();break;

			case 'delete':return $this->delete();break;

			case 'remove':return $this->remove();break;

			case 'update':return $this->update($data['cart']);break;

			case 'check':return $this->check();break;
		}
	}

	private function get(){

		if(empty($this->cart)) return array();

		$carts=array();
		$totals=array();
		$total=$count=0;

		foreach ($this->cart as $k => $v) {
			
			$item=M('product/item','get',$v['item_id']);

			$options=array();
			$opts=array();

			foreach ($v['options'] as $item_option_id) {

				$option=M('product/option','get',$item_option_id);

				if(!empty($option)){

					$options[]=array('item_option_id'=>$option['item_option_id'],'name'=>$option['name']);
					$opts[]=$option['item_option_id'];
				}
			}

			$carts[]=array(
				'item_id'=>$v['item_id'],
				'quantity'=>$v['quantity'],
				'price'=>$item['price'],
				'total'=>$v['quantity']*$item['price'],
				'title'=>$item['title'],
				'link'=>shop_url(sprintf("item/%d.html",$v['item_id'])),
				'image'=>$item['image'],
				'options'=>$options,
				'item_option'=>implode('_',$opts)
			);

			$total+=$v['quantity']*$item['price'];
			$count+=$v['quantity'];
		}
		// print_r($carts);exit;
		$totals[]=array('title'=>'总价','text'=>$total);

		// print_r($carts);exit;
		return array($carts,$count,$totals,$total);
	}

	private function add(){

		if(empty($this->cart)) 
			$this->cart[]=array('item_id'=>$this->item_id,'options'=>$this->options,'quantity'=>$this->quantity);
		else{
			$match=0;
			foreach ($this->cart as $k => $v) {
				if($v['item_id']==$this->item_id && !array_diff($v['options'],$this->options)){
					$this->cart[$k]['quantity']+=$this->quantity;
					$match=1;
					break;
				}
			}
			if(!$match){
				$this->cart[]=array('item_id'=>$this->item_id,'options'=>$this->options,'quantity'=>$this->quantity);
			}
		}

		$this->update();

		return 1;
	}

	private function delete(){

		$status=0;

		if(empty($this->item_id) || empty($this->cart)) return;

		foreach ($this->cart as $k => $v) {
			if($v['item_id']==$this->item_id && !array_diff($v['options'],$this->options)){
				// $this->cart[$k]['quantity']-=$this->quantity;
				// if($this->cart[$k]['quantity']<=0)
					unset($this->cart[$k]);
					$status=1;
					break;
			}
		}

		$this->update();

		return $status;
	}

	private function remove(){

		if(empty($this->item_id) || empty($this->cart)) return;

		foreach ($this->cart as $k => $v) {
			if($v['item_id']==$this->item_id && $v['options']==$this->options){
				unset($this->cart[$k]);
			}
		}

		$this->update();
	}

	private function update($cart=array()){

		S('cart',$this->cart);

		$user_id=(int)S('LOGGED');

		if($user_id>0){

			$params=array('data'=>serialize($this->cart),'user_id'=>$user_id);

			$cart=D('user/cart')->getCart($user_id);

			if(empty($cart)){

				D('user/cart')->addCartItem($params);
			}else{

				D('user/cart')->updateCart($user_id,$params);
			}
		}
	}

	private function check(){

		$item_option=M('product/option','item',$this->item_id);

		if(empty($item_option)) return true;

		$options=array();

		foreach ($item_option as $io) {
			
			$options[]=$io['item_option_id'];
		}

		return in_array($this->options[0],$options);
	}
}