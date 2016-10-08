<?php

class ExtensionRecommend extends Medium{

	public function run($action,$data){
	
		switch ($action) {
	
			case 'add':return $this->add($data);break;

			case 'get':return $this->get($data);break;

			case 'detail':return $this->detail($data);break;

			case 'edit':return $this->edit($data['recommend_id'],$data['data']);break;

			case 'list':return $this->listall($data);break;
		}
	}

	private function add($data){

		$params=array('name'=>$data['name'],'title'=>$data['title'],'items'=>implode(',',$data['items']));

		$recommend_id=D('extension/recommend')->addRecommend($params);

		return $recommend_id;
	}

	private function get($recommend_id){

		return D('extension/recommend')->getRecommend($recommend_id);
	}

	private function detail($recommend_id){

		$recommend=$this->get($recommend_id);
		
		$items=array_filter(explode(',',$recommend['items']));

		$products=array();

		!empty($items) && $products=D('product/item')->getItemsByIDs($items);

		$recommend['items']=$products;

		return $recommend;
	}

	private function edit($recommend_id,$data){

		$params=array('name'=>$data['name'],'title'=>$data['title'],'items'=>implode(',',$data['items']));

		return D('extension/recommend')->updateRecommend($recommend_id,$params);
	}

	private function listall($data){

		return D('extension/recommend')->selectRecommend();
	}
}