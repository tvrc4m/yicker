<?php

/**
 * 举办婚礼
 */
class HaveAction extends VKWeddingAction{
    
    protected $lang='wedding/wedding';

    protected $data=array();

    public function index(){

    	if(ispost() && $this->valid()){

            $params=array(
                'groom_id'=>$this->user_id,
                'groom'=>$this->post['groom'],
                'bride'=>$this->post['bride'],
                'wedding_date'=>strtotime(sprintf('%s %s',$this->post['wedding_date'],$this->post['wedding_time'])),
                'wedding_address'=>$this->post['wedding_address']
            );

    		$wedding_id=M('wedding/wedding','have',array($this->user_id,$params));

            !empty($wedding_id) && go('/setting/wedding');
    	}

        $this->title='举办婚礼';

        $this->js=array('switch'=>'/static/js/jquery/jquery.switch.js');

        $this->flushform($this->post,array(),array('groom','bride','wedding_date','wedding_time','wedding_address'));

    	$this->assign(array('fields'=>$this->data));
    	
    	$this->display('wedding/have');
    }


    private function valid(){

        $groom=$this->post['groom'];
        $bride=$this->post['bride'];
        $wedding_date=$this->post['wedding_date'];
        $wedding_time=$this->post['wedding_time'];
        $wedding_address=$this->post['wedding_address'];

        empty($groom) && $this->error['groom']=L('groom_empty');
        empty($bride) && $this->error['bride']=L('bride_empty');
        empty($wedding_date) && $this->error['wedding_date']=L('wedding_date_empty');
        empty($wedding_time) && $this->error['wedding_time']=L('wedding_time_empty');
        empty($wedding_address) && $this->error['wedding_address']=L('wedding_address_empty');

        return !$this->error;
    }
}