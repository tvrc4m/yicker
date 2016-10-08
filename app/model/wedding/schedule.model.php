<?php

/**
 * 计划任务
 */

class WeddingScheduleModel extends BaseModel{

	protected $table='wedding_schedule';

	public function get_wedding_all_schedule($wedding_id){

		$sql="SELECT ws.*,if(DATEDIFF(FROM_UNIXTIME(schedule_date),NOW())>=0,1,0) AS pass FROM tt_wedding_schedule ws WHERE ws.wedding_id=".(int)$wedding_id." AND ws.deleted=0 ORDER BY ws.status ASC,pass DESC,DATEDIFF(schedule_date,NOW()) ASC";

		return $this->find($sql);
	}
}