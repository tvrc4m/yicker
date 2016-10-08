<?php

/**
 * 婚礼使用的模块
 */
class WeddingModuleModel extends BaseModel{

	protected $table='wedding_module';

	/**
	 * 获取婚礼所有模块
	 * @return array   二维数组
	 */
	public function getWeddingModules($wedding_id){

		$sql="SELECT m.* FROM tt_wedding_module wm INNER JOIN tt_module m ON wm.module_id=m.id WHERE wm.status=1 AND wm.wedding_id=".(int)$wedding_id;

		return $this->find($sql);
	}
}