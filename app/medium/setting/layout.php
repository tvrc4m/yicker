<?php

class SettingLayout extends Medium{

	public function run($action,$data){

		switch ($action) {
	
			case 'layout':return $this->layout();break;

			case 'module':return $this->module($data['layout'],$data['position']);break;
		}
	}
	
	private function layout(){
		
		$routes=D('extension/layout.route')->getAllRoutes();

		$request_uri=$_SERVER['REQUEST_URI'];
		
		foreach ($routes as $route) {
			
			if($route['route']=='/' && $_GET['app']=='index' && $_GET['act']=='index'){

				return $route['layout_id'];
			}elseif($route['route'] && $route['route']!='/' && preg_match(sprintf('/%s/',str_replace('/','\/',$route['route'])),$request_uri)==1){
				
				return $route['layout_id'];
			}
		}
		
		return 0;
	}

	private function module($layout_id,$position){

		if(empty($layout_id)) $layout_id=$this->layout();

		if(empty($layout_id)) return array();

		$modules=D('extension/layout.module')->getLayoutModuleByPosition($layout_id,$position);
		
		$result=array();

		foreach ($modules as $module) {

			$code=$module['code'];

			$code=strpos($code,'.')===false?$code:substr($code,0,strpos($code,'.'));

			if(is_file(sprintf('%smodule/%s.action.php',ACTION,strtolower($code)))){

				include_once sprintf('%smodule/%s.action.php',ACTION,strtolower($code));

				$result[$module['code']][]=A::run(sprintf('module/%s',$code),$module);
			}
		}
		// print_r($result);exit;
		return $result;
	}
}