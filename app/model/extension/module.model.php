<?php

/**
 * 模块
 */
class ExtensionModuleModel extends BaseModel{

	protected $table='module';

	/**
	 * 根据婚礼id获取所有的module，其状态来自于wedding
	 * @return array
	 */
	public function getWeddingModules($wedding_id){

		$sql="SELECT m.id,m.name,m.code,wm.status FROM tt_module m LEFT JOIN tt_wedding_module wm on m.id=wm.module_id AND wm.wedding_id=".(int)$wedding_id;

		return $this->find($sql);
	}
}