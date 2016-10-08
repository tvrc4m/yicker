<?php

class ExtensionModule extends Medium{

	public function get_all_modules(){

		$modules=$this->extension_module->select();

		$result=array();

		foreach ($modules as $module) {
			
			$result[$module['id']]=$module;
		}

		return $result;
	}

	public function get_all_modules_in_wedding($wedding_id){

		$modules=$this->extension_module->getWeddingModules($wedding_id);

		$result=array();

		foreach ($modules as $module) {
			
			$result[$module['id']]=$module;
		}
		
		return $result;
	}
}