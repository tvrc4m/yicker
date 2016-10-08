<?php

/**
 * 参加婚礼
 */
class JoinAction extends VKWeddingAction{
    
    protected $lang='wedding/wedding';

    public function index(){

    	$wedding_code=$this->get['wedding_code'];

		if (ispost() && $this->valid()) {

			$wedding_code=$this->post['wedding_code'];

			$wedding=M('wedding/wedding','get_by_code',array($wedding_code));

			try{

				$joined=M('wedding/user','join',array(
					array('user_id'=>$this->user_id,'wedding_id'=>$wedding['id'],'realname'=>$this->post['realname'],'phone'=>$this->post['phone'],'count'=>$this->post['count'],'lodgment'=>$this->post['lodgment'],'deliver'=>$this->post['deliver'])
				));	

	    		if($joined){

	    			M('user/user','update',array($this->user_id,array('selected_wedding_id'=>$wedding['id'])));

		    		$user=M('user/user','get',array($this->user_id));

		    		update_user_session($user);

	    			go('/wedding');
	    		}

			}catch(VEException $e){

				$this->error['system']=L('system_error');
			}	    	
		}

		$this->title='参加婚礼';

		$this->js=array('switch'=>'/static/js/jquery/jquery.switch.js');

		$joined = $owner =false;

		$verified=M('wedding/user','verify',array($wedding_code,$this->user_id));

		switch ($verified) {

			case -1: $this->error['wedding']=L('wedding_code_not_exists'); break;
			
			case -2: $owner=true;break;

			case 0: $joined=true;$wedding=M('wedding/wedding','get_by_code',array($wedding_code));break;

			case 1: break;
		}

		$this->flushform($this->post,$this->user,array('realname','phone','count','lodgment','deliver','wedding_code'));

		$wedding_code=$this->get['wedding_code'];

		$this->assign(array('wedding_code'=>$wedding_code,'wedding_id'=>$wedding['id'],'joined'=>$joined,'owner'=>$owner));

    	$this->display('join/join');
    }

    private function valid(){

    	$realname=$this->post['realname'];
    	$phone=$this->post['phone'];
    	$count=$this->post['count'];
    	$wedding_code=$this->post['wedding_code'];

    	empty($realname) && $this->error['realname']=L('join_realname_empty');
    	if(empty($phone)) $this->error['phone']=L('join_phone_empty');
    	else if(preg_match('^\d{11}$', $phone)) $this->error['phone']=L('phone_format_error');

    	if(empty($wedding_code))
    		$this->error['code']='缺少必要参数,请刷新再试';
    	else{

    		$verified=M('wedding/user','verify',array($wedding_code,$this->user_id));

    		switch ($verified) {
    			case -1:$this->error['wedding_code']=L('wedding_code_not_exists');break;
    			case -2:$this->error['wedding_code']=L('wedding_owner_join_deny');break;
    			case  0:$this->error['wedding_code']=L('wedding_has_join');break;
    		}
    	}

    	return !$this->error;
    }
}