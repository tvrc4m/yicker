<?php

class MallItem extends Medium{

	public function get($iid){
	
		$item=$this->mall_item->one(array('id'=>$iid));

		return $item;
	}
}