<?php

class ScheduleAction extends AjaxAuthAction {

    protected $lang='wedding/wedding';
    
    public function add(){

        if (ispost() && $this->valid_add()) {

            $schedule_date=strtotime(sprintf('%s %s',$this->post['date'],$this->post['time']));
            
            $status=M('wedding/schedule','add_wedding_schedule',array($this->selected_wedding_id,'title'=>$this->post['title'],'schedule_date'=>$schedule_date));

           	if($status)
           		exit(json_encode(array('status'=>200,'errmsg'=>'添加成功,正在跳转...','redirect'=>"/wedding/schedule")));
           	else
           		exit(json_encode(array('status'=>500,'errmsg'=>'程序异常,正在刷新...')));
        }

    	$this->error();	
    }

    public function finish(){

    	if(ispost() && $this->valid_finish()){

    		$status=M('wedding/schedule','finish',array($this->selected_wedding_id,$this->post['id']));

    		exit(json_encode(array('status'=>200,'errmsg'=>'done')));
    	}

    	$this->error();
    }

    public function unfinish(){

    	if(ispost() && $this->valid_finish()){

    		$status=M('wedding/schedule','unfinish',array($this->selected_wedding_id,$this->post['id']));

    		exit(json_encode(array('status'=>200,'errmsg'=>'done')));
    	}

    	$this->error();
    }

    private function valid_add(){

        $title=$this->post['title'];
        $date=$this->post['date'];
        $time=$this->post['time'];

        empty($title) && $this->error['title']=L('schedule_title_empty');
        empty($date) && $this->error['date']=L('schedule_date_empty');
        empty($time) && $this->error['time']=L('schedule_time_empty');
        $schedule_date=strtotime(sprintf('%s %s',$this->post['date'],$this->post['time']));
        empty($schedule_date) && $this->error['date']='格式错误';
        return !$this->error;
    }

    private function valid_finish(){

    	$schedule_id=$this->post['id'];

    	!$this->is_owner && $this->error['wedding']=L('wedding_no_role');

    	if (empty($schedule_id)) {
    		$this->error['schedule']=L('id_empty');
    	}else{

    		$schedule=M('wedding/schedule','get',array($this->selected_wedding_id,$schedule_id));

    		empty($schedule) && $this->error['schedule']=L('id_no_exists');
    	}

    	return !$this->error;
    }
}