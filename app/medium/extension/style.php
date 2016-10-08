<?php

class ExtensionStyle extends Medium{

	public function run($action,$data){
	
		switch ($action) {
	
			case 'add':return $this->add($data);break;

			case 'get':return $this->get($data);break;

			case 'detail':return $this->detail($data);break;

			case 'edit':return $this->edit($data['style_id'],$data['data']);break;

			case 'type.all':return $this->allByType($data);break;

			case 'list':return $this->listall($data);break;
		}
	}

	private function add($data){

		$params=array('name'=>$data['name'],'type'=>$data['type'],'content'=>$data['content']);

		$style_id=D('extension/style')->addStyle($params);

		return $style_id;
	}

	private function get($style_id){

		return D('extension/style')->getStyle($style_id);
	}

	private function detail($style_id){

		$style=$this->get($style_id);
		
		$items=array_filter(explode(',',$style['items']));

		$products=array();

		!empty($items) && $products=D('product/item')->getItemsByIDs($items);

		$style['items']=$products;

		return $style;
	}

	private function edit($style_id,$data){

		$params=array('name'=>$data['name'],'type'=>$data['type'],'content'=>$data['content']);

		return D('extension/style')->updateStyle($style_id,$params);
	}

	private function allByType($type){

		return D('extension/style')->selectStyle(array('where'=>array('type'=>$type)));
	}

	private function listall($data){

		return D('extension/style')->selectStyle();
	}
}