<?php

class ExtensionTemplate extends Medium{

	public function run($action,$data){
	
		switch ($action) {
	
			case 'add':return $this->add($data);break;

			case 'get':return $this->get($data);break;

			case 'detail':return $this->detail($data);break;

			case 'edit':return $this->edit($data['template_id'],$data['data']);break;

			case 'type.all':return $this->allByType($data);break;

			case 'list':return $this->listall($data);break;
		}
	}

	private function add($data){

		$params=array('name'=>$data['name'],'title'=>$data['title'],'type'=>$data['type'],'content'=>$data['content']);

		$template_id=D('extension/template')->addTemplate($params);

		return $template_id;
	}

	private function get($template_id){

		return D('extension/template')->getTemplate($template_id);
	}

	private function detail($template_id){

		$template=$this->get($template_id);
		
		$items=array_filter(explode(',',$template['items']));

		$products=array();

		!empty($items) && $products=D('product/item')->getItemsByIDs($items);

		$template['items']=$products;

		return $template;
	}

	private function edit($template_id,$data){

		$params=array('name'=>$data['name'],'title'=>$data['title'],'type'=>$data['type'],'content'=>$data['content']);

		return D('extension/template')->updateTemplate($template_id,$params);
	}

	private function allByType($type){

		return D('extension/template')->selectTemplate(array('where'=>array('type'=>$type)));
	}

	private function listall($data){

		return D('extension/template')->selectTemplate();
	}
}