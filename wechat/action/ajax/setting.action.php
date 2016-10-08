<?php

class SettingAction extends AjaxAuthAction {

    protected $lang='wedding/wedding';
    
    public function have(){

        if (ispost() && $this->valid_nick()) {
            
            M('user/user','update',array($this->user_id,array('nick'=>$this->post['nick'])));

            $has_set=$this->user['nick']?1:0;

            $user=M('user/user','get',array($this->user_id));

            if ($user['nick']==$this->post['nick']) {
                
                update_user_session($user);

                exit(json_encode(array('status'=>200,'errmsg'=>$has_set?'修改成功,正在跳转...':'设置成功,正在跳转...','redirect'=>"/setting/account")));
            }

            $this->error['nick']='修改失败';
        }

    	$this->error();	
    }
}