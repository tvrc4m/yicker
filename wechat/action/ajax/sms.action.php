<?php

class SmsAction extends AjaxAction {

    protected $lang='user/account';

    public function code(){

        if (ispost() && $this->valid_code()) {
            
            $code=mt_rand(1000,9999);

            $status=M('sms/code','send',array($this->post['phone'],$code,$this->post['type']));

            if($status===true){

                exit(json_encode(array('status'=>200,'errmsg'=>'发送成功,请注意查收')));
            }

            exit(json_encode(array('status'=>400,'errmsg'=>$status)));            
        }

        exit(json_encode(array('status'=>400,'errmsg'=>$this->error['phone'])));
    }

    private function valid_code(){

        $phone=$this->post['phone'];
        $type=strtolower($this->post['type']);

        if(empty($phone))

            $this->error['phone']=L('phone_empty');
        else{

            $user=M('user/user','one',array(array('phone'=>$phone)));
            
            if($type=='register'){

                !empty($user) && $this->error['phone']=L('phone_exist'); 
            }else{
                
                empty($user) && $this->error['phone']=L('user_not_exists');
            }
        }

        if (empty($type)) {
            exit(json_encode(array('status'=>500,'errmsg'=>'缺少参数,正在刷新...')));
        }

        return !$this->error;
    }
}