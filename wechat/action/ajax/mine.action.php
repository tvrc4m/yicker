<?php

class MineAction extends AjaxAuthAction {

    protected $lang='wedding/wedding';
    
    public function have(){

        if (ispost() && $this->valid_have()) {

            $wedding=M('wedding/wedding','get',array($this->wedding_id));
            
            $wedding_date=strtotime(sprintf('%s %s',$this->post['wedding_date'],$this->post['wedding_time']));

            $params=array('wedding_date'=>$wedding_date,'wedding_address'=>$this->post['wedding_address'],'groom'=>$this->post['groom'],'bride'=>$this->post['bride']);

            try{

                M('wedding/wedding','update_wedding',array($wedding['id'],$params));

                exit(json_encode(array('status'=>200,'errmsg'=>'修改成功,正在跳转...','redirect'=>'/setting/wedding')));

            }catch(VKException $e){

                $this->error['system']=L('system_error');
            }
        }

    	$this->error();	
    }

    public function title(){

        if (ispost() && $this->valid_title()) {
            
            try{

                M('wedding/wedding','update_wedding',array($this->wedding_id,array('title'=>$this->post['title'],'sub_title'=>$this->post['sub_title'])));

                exit(json_encode(array('status'=>200,'errmsg'=>'修改成功,正在跳转...','redirect'=>'/setting/wedding')));
            }catch(VKException $e){

                $this->error['system']=L('system_error');
            }
        }

        $this->error(); 
    }

     public function module(){

        if (ispost() && $this->valid_module()) {

            $modules=$this->post['modules'];

            foreach ($modules as $name => $module) {
                    
               
            }

            M('wedding/module','setting_wedding_module',array($this->wedding_id,$modules));

            exit(json_encode(array('status'=>200,'errmsg'=>'修改成功,正在跳转...','redirect'=>$this->post['from']=='wedding'?'/wedding':'/setting/wedding')));
        }

        $this->error();
    }


    private function valid_have(){

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

    private function valid_title(){

        $title=$this->post['title'];
        $sub_title=$this->post['sub_title'];

        $has=M('wedding/wedding','has',array($this->wedding_id,$this->user_id));

        !$has && $this->error['role']=L('no_role');

        empty($title) && $this->error['title']=L('wedding_title_empty');

        return !$this->error;
    }

    private function valid_module(){

        return !$this->error;
    }
}