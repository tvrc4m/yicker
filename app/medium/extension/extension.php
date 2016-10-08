<?php

class ExtensionExtension extends Medium{

	public function run($action,$data){
	
		switch ($action) {
	
			case 'installed':return $this->installed($data);break;

			case 'install':return $this->install($data);break;

			case 'uninstall':return $this->uninstall($data);break;

			case 'modules':return $this->modules();break;
	
		}
	}
	
	private function installed($data){

		$type=$data['type'];

		$installed=D('extension/extension')->getExtensionByType($type);
		
		// $installed=SQL::extension('extension','getExtensionByType',array($type));

		foreach ($installed as $code) {

			if (!file_exists(ACTION .$type. '/' . $code . '.action.php')) {

				$this->uninstall(array('code'=>$code));

				unset($installed[$code]);
			}
		}
		
		$extensions = array();
		
		foreach (glob(ACTION .$type. '/*.action.php') as $file){

			$extension=basename($file, '.action.php');
			
			$title=L($extension);

			$extensions[]=in_array($extension, $installed)?array('code'=>$extension,'title'=>$title,'installed'=>1):array('code'=>$extension,'title'=>$title,'installed'=>0);
		}

		return $extensions;
	}

	private function install($data){
		
		$type=$data['type'];
		$code=$data['code'];

		D('extension/extension')->addExtension($type,$code);
	}

	private function uninstall($data){
		
		$code=$data['code'];

		D('extension/extension')->delExtension($code);
	}

	private function modules(){

		$installed=$this->installed(array('type'=>'module'));

		foreach ($installed as $k=>$install) {

			$modules=V(sprintf('%s_modules',$install['code']));
			
			if(!empty($modules)){

				$installed[$k]['children']=$modules;
			}
		}

		return $installed;
	}
}