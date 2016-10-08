<?php

class WeddingSchedule extends Medium{

	public function get_wedding_all_schedule($wedding_id){

		$schedules=$this->wedding_schedule->get_wedding_all_schedule($wedding_id);

		foreach ($schedules as &$schedule) {
			
			$schedule['schedule_date']=date('m-d H:i',$schedule['schedule_date']);
			$schedule['checked']=$schedule['status']?'reminder-check-square-selected':'';
			$schedule['action']=$schedule['status']?"/schedule/unfinish.ajax":"/schedule/finish.ajax";
		}

		return $schedules;
	}

	public function add_wedding_schedule($wedding_id,$title,$schedule_date){

		$params['wedding_id']=$wedding_id;

		return $this->wedding_schedule->insert(array('wedding_id'=>$wedding_id,'title'=>$title,'schedule_date'=>$schedule_date,'status'=>0,'deleted'=>0,'create_date'=>time()));
	}

	public function get($wedding_id,$schedule_id){

		return $this->wedding_schedule->one(array('wedding_id'=>$wedding_id,'id'=>$schedule_id));
	}

	public function finish($wedding_id,$schedule_id){

		return $this->wedding_schedule->update(array('status'=>1),array('id'=>$schedule_id,'wedding_id'=>$wedding_id));
	}

	public function unfinish($wedding_id,$schedule_id){

		return $this->wedding_schedule->update(array('status'=>0),array('id'=>$schedule_id,'wedding_id'=>$wedding_id));
	}
}