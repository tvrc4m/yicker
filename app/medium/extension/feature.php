<?php

class ExtensionFeature extends Medium{

	public function run($action,$data){
	
		switch ($action) {
	
			case 'add':return $this->add($data);break;

			case 'get':return $this->get($data);break;

			case 'detail':return $this->detail($data);break;

			case 'edit':return $this->edit($data['feature_id'],$data['data']);break;

			case 'list':return $this->listall($data);break;
		}
	}

	private function add($data){

		$params=array('name'=>$data['name'],'title'=>$data['title'],'items'=>implode(',',$data['items']));

		$feature_id=D('extension/feature')->addFeature($params);

		return $feature_id;
	}

	private function get($feature_id){

		return D('extension/feature')->getFeature($feature_id);
	}

	private function detail($feature_id){

		$feature=$this->get($feature_id);
		
		$items=array_filter(explode(',',$feature['items']));

		$products=array();

		!empty($items) && $products=D('product/item')->getItemsByIDs($items);

		$feature['items']=$products;

		return $feature;
	}

	private function edit($feature_id,$data){

		$params=array('name'=>$data['name'],'title'=>$data['title'],'items'=>implode(',',$data['items']));

		return D('extension/feature')->updateFeature($feature_id,$params);
	}

	private function listall($data){

		return D('extension/feature')->selectFeature();
	}
}