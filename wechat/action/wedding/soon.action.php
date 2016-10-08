<?php

/**
 * 婚礼筹备中
 */
class SoonAction extends VKWeddingAction
{

    public function index(){

        $this->title='婚礼倒计时';

        $this->navbar['right_navbar']=array(array('href'=>'javascript:void(0);','icon'=>'fa-share'));

        if ($this->is_login) {
            
            $wedding_id=!empty($this->get['id'])?$this->get['id']:$this->selected_wedding_id;
        }else{

            !empty($this->get['id']) && $wedding_id=$this->get['id'];
        }

        empty($wedding_id) && go($this->error_404);

        $wedding=M('wedding/wedding','get',array($wedding_id));

        empty($wedding) && go($this->error_404);

        $this->is_login && $joined=M('wedding/user','joined',array('wedding_id'=>$wedding_id,'user_id'=>$this->user_id));
        	
        $wedding_date=$wedding['wedding_date'];

        $now=time();

        $is_waiting =true;
        $is_over = false;

        if(($diff=$now-$wedding_date)>0){

            $is_waiting=false;

            $diff%86400>=1 && $is_over=true;
        }

        if ($is_waiting) {
            
            $this->js=array(
                'jquery.plugin'=>'/static/js/jquery/jquery.plugin.min.js',
                'jquery.countdown'=>'/static/js/jquery/jquery.countdown.min.js',
                'jquery.countdown.zh'=>'/static/js/jquery/jquery.countdown-zh-CN.js',
            );

            $day=3600*24;

            $date['day']=($wedding_date-$now)>$day?floor(($wedding_date-$now)/$day):0;
            $date['hour']=($wedding_date-$now%$day)>3600?floor(($wedding_date-$now)%$day/3600):0;
            $date['minute']=($wedding_date-$now%$day*3600)>60?floor(($wedding_date-$now)%($day*3600)/60):0;

            $this->assign(array('date'=>$date));
        }

        

        $this->assign(array('wedding'=>$wedding,'is_waiting'=>$is_waiting,'is_over'=>$is_over,'joined'=>$joined));

    	$this->display('wedding/soon');
    }
}