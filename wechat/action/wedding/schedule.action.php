<?php

/**
 * 日程计划表
 */
class ScheduleAction extends VKWeddingAction
{
    
    public function index(){
    	
    	$this->title='日程安排';

        $this->is_owner && $this->navbar['right_navbar']=array('second'=>array('href'=>'/wedding/schedule/insert','icon'=>'fa-plus'));

        $this->navbar['right_navbar']['first']=array('href'=>'javascript:void(0);','icon'=>'fa-share');
        // print_r($this->navbar['right_navbar']);exit;
        $schedules=M('wedding/schedule','get_wedding_all_schedule',array($this->selected_wedding_id));

        $this->assign(array('schedules'=>$schedules));

    	$this->display('wedding/schedule');
    }

    public function insert(){

    	$this->title='增加计划任务';

    	$this->display('wedding/schedule_form');
    }
}