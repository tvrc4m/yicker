<?php

class MallCat extends Medium{

	public function all(){
		
		return $this->mall_cat->select();
	}

	public function get_by_alias($alias){

		return $this->mall_cat->one(array('alias'=>$alias));
	}
}