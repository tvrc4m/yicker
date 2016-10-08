<?php

class MallCheckout extends Medium{

	public function buy($data){

		$items=array();

		$count=0;

		foreach ($data['items'] as $item) {

			$item_id=$item['item_id'];
			$options=$item['options'];
			$quantity=(int)$item['quantity'];

			$detail=M('product/item','get',$item_id);

			if(!empty($detail) && $quantity>0){

				$detail['quantity']=$quantity;

				$detail['link']=shop_url(sprintf("item/%d.html",$item_id));

				$item_options=M('product/option','item',$item_id);

				if(empty($item_options)){

					$total=$quantity*$detail['price'];
					$detail['price']=$detail['price'];
					$detail['total']=$total;
					$count+=$total;
					$items[]=$detail;
				}elseif(in_array($options[0],array_keys($item_options))){

					$total=$quantity*$item_options[$options[0]]['price'];
					$detail['options'][$item_options[$options[0]]['item_option_id']]=$item_options[$options[0]];
					$detail['price']=$item_options[$options[0]]['price'];
					$detail['total']=$total;
					$count+=$total;
					$items[]=$detail;
				}
			}
		}

		if(empty($items)) return 0;

		$totals[]=array('title'=>'总价','text'=>$count);

		$key=uniqid();

		$result=array('items'=>$items,'totals'=>$totals,'total'=>$count,'key'=>$key,'cart'=>(int)$data['cart']);

		S($key,$result);

		return $result;
	}

	public function confirm($data){

		$result=S($data['key']);

		$items=$result['items'];

		$order_items=array();

		foreach ($items as $item) {
			
			$order_items[]=sprintf('%s,%s,%s',$item['item_id'],implode('#',array_keys($item['options'])),$item['quantity']);
		}

		$order_items=implode(';',$order_items);

		$vendor_id=S('LOGGED');
		$vendor=S('VENDOR');

		$params=array($vendor_id,$order_items,$data['name'],$data['phone'],$data['idcard'],$data['plantime'],'@orders','@success');
		
		list($orders,$status)=D('order/order')->addOrder($params);

		if($status==1){

			if(V('config_sms_send') && V('config_sms_content') && V('config_sms_phone')){

				$orders=explode(',',$orders);

				foreach ($items as $index=>$item) {

					$detail=M('product/item','get',$item['item_id']);

					$order_id=$orders[$index];
					
					$content=str_replace(array('{$order_id}','{$vendor}','{$name}','{$phone}','{$title}','{$num}','{$plantime}','{$create_date}'),array($order_id,$vendor['name'],$data['name'],$data['phone'],$detail['title'],$item['quantity'],$data['plantime'],date('m月d号H点i分')), V('config_sms_content'));

					$output=AM('module/sms','send',array('phone'=>V('config_sms_phone'),'content'=>$content,'order_id'=>$order_id,'item_id'=>$item['item_id'],'type'=>'local'));	

					if($output['stat']==100){

						// AD('sale/order')->updateOrderByParams($order_id,array('sms_send'=>1));	
					}
				}
			}

			if($result['cart']){

				foreach ($data['items'] as $item) M('checkout/cart','delete',$item);
			}
			
		}

		S($data['key'],null);

		return $status;
	}
}