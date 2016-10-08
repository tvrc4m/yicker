<?php

class SwitchAction extends AjaxAuthAction {

    protected $lang='wedding/wedding';
    
    public function index(){

        if (ispost() && $this->valid()) {

            $verified=false;

            $wedding_id=$this->post['id'];

            if ($this->post['type']==1) {
                // 切换到自己的婚礼
                $has=M('wedding/wedding','has',array($wedding_id,$this->user_id));

                $has && $verified=true;

            }else if ($this->post['type']==2) {

                $joined=M('wedding/user','joined',array($wedding_id,$this->user_id));

                $joined && $verified=true;
            }

            if($verified){

                M('user/user','update',array($this->user_id,array('selected_wedding_id'=>$wedding_id)));

                $user=M('user/user','get',array($this->user_id));

                update_user_session($user);

                exit(json_encode(array('status'=>200,'errmsg'=>'切换成功,正在跳转...','redirect'=>'/wedding')));
            }

            exit(json_encode(array('status'=>500,'errmsg'=>'请求错误,正在刷新...')));
        }

    	$this->error();	
    }

    
    private function valid(){

        $wedding_id=$this->post['id'];
        $type=$this->post['type'];

        empty($wedding_id) && $this->error['wedding']=L('wedding_empty');
        empty($type) && $this->error['date']=L('参数错误');

        return !$this->error;
    }
}