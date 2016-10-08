<?php

class ExtensionLayout extends Medium{

	public function run($action,$data){
	
		switch ($action) {
	
			case 'get':return $this->get($data);break;

			case 'detail':return $this->detail($data);break;

			case 'add':return $this->add($data);break;

			case 'edit':return $this->edit($data['layout_id'],$data['data']);break;

			case 'del':return $this->del($data);break;			

			case 'list':return $this->listall($data);break;
		}
	}

	private function get($layout_id){

		return D('extension/layout')->getLayout($layout_id);
	}

	private function detail($layout_id){

		$layout=$this->get($layout_id);

		$layout['routes']=D('extension/layout.route')->getLayoutRoute($layout_id);

		$layout['modules']=D('extension/layout.module')->getLayoutModule($layout_id);

		return $layout;
	}

	private function add($data){

		$params=array('name'=>$data['name']);

		$layout_id= D('extension/layout')->addLayout($params);

		if(empty($layout_id)) return 0;

		foreach ($data['routes'] as $route) {
			
			D('extension/layout.route')->addLayoutRoute(array('route'=>$route['route'],'layout_id'=>$layout_id));
		}

		foreach ($data['modules'] as $module) {

			$params=array('layout_id'=>$layout_id,'code'=>$module['code'],'position'=>$module['position'],'sort'=>$module['sort']);
			
			D('extension/layout.module')->addLayoutModule($params);
		}

		return $layout_id;
	}

	private function edit($layout_id,$data){

		$params=array('name'=>$data['name']);

		D('extension/layout')->editLayout($layout_id,$params);

		D('extension/layout.route')->delLayoutRoute($layout_id);

		foreach ($data['routes'] as $route) {
			
			D('extension/layout.route')->addLayoutRoute(array('route'=>$route['route'],'layout_id'=>$layout_id));
		}

		D('extension/layout.module')->delLayoutModule($layout_id);

		foreach ($data['modules'] as $module) {

			$params=array('layout_id'=>$layout_id,'code'=>$module['code'],'position'=>$module['position'],'sort'=>$module['sort']);
			
			D('extension/layout.module')->addLayoutModule($params);
		}

		return 1;
	}

	private function del($layout_id){

		D('extension/layout')->delLayout($layout_id);

		D('extension/layout.route')->delLayoutRoute($layout_id);
		
		D('extension/layout.module')->delLayoutModule($layout_id);
	}

	private function listall($data){

		return D('extension/layout')->listLayout($data);
	}
}
