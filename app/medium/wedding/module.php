<?php

class WeddingModule extends Medium{

	public function get_wedding_modules($wedding_id,$is_owner){

		$modules=$this->wedding_module->getWeddingModules($wedding_id);

		return array_filter($modules,function($module){
			return $module['status']==1;
		});
	}

	public function update_wedding_module($wedding_id,$module_id,$status){

		$wedding_module=$this->wedding_module->one(array('wedding_id'=>$wedding_id,'module_id'=>$module_id));

		if(!empty($wedding_module) && $wedding_module['status']!=$status){

			$this->wedding_module->update(array('status'=>$status),array('id'=>$wedding_module['id']));
		}else{

			$this->wedding_module->insert(array('wedding_id'=>$wedding_id,'module_id'=>$module_id,'status'=>$status,'create_date'=>time()));
		}
	}

	public function setting_wedding_module($wedding_id,$modules){

		try{

			$this->wedding_module->start_trans();

			$this->wedding_module->update(array('status'=>0),array('wedding_id'=>$wedding_id));

			$all_modules=M('extension/module','get_all_modules');

			foreach ($modules as $id => $module) {
			
				$status=$module['status']=='on'?1:0;

				$module_info=$all_modules[$id];

				$this->update_wedding_module($wedding_id,$id,$status);

				M('module/'.$module_info['code'],'setting',array($module));

			}

			$this->wedding_module->commit();
		}catch(Exception $e){

			$this->wedding_module->rollback();
		}
	}
}