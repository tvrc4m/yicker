<?php

class AccountAction extends AjaxAuthAction {

    protected $lang='user/account';
    
    public function nick(){

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

    public function changepwd(){

        if (ispost() && $this->valid_changepwd()) {

            $has_set=empty($this->user['password'])?0:1;

            $newpwd=sha1($this->user['salt'].$this->post['newpwd']);
            
            M('user/user','update',array($this->user_id,array('password'=>$newpwd)));

            $user=M('user/user','get',array($this->user_id));

            update_user_session($user);

            if ($user['password']==$newpwd) {
                
                update_user_session($user);

                exit(json_encode(array('status'=>200,'errmsg'=>$has_set?'修改成功,正在跳转...':'设置成功,正在跳转...','redirect'=>"/setting/account")));
            }

            $this->error['nick']='修改失败';
        }

        $this->error(); 
    }

    
    private function valid_nick(){

        empty($this->post['nick']) && $this->error['nick']=L('nick_empty');
        
        return !$this->error;
    }

    private function valid_changepwd(){

        $oldpwd=$this->post['oldpwd'];
        $newpwd=$this->post['newpwd'];
        $repwd=$this->post['repwd'];

        if (empty($oldpwd)) {
            $this->error['oldpwd']=L('oldpwd_empty');
        }else if($this->user['password']!==sha1($this->user['salt'].$oldpwd)){
            $this->error['oldpwd']=L('oldpwd_error');
        }
        if (empty($newpwd)) {
            $this->error['newpwd']=L('newpwd_empty');
        }else if(preg_match('/\w_{6,16}/', $oldpwd)){
            $this->error['newpwd']=L('newpwd_error');
        }
        if (empty($repwd) || $repwd!==$newpwd) $this->error['repwd']=L('newpwd_diff');
        // print_r($this->error);exit;
        return !$this->error;
    }
}