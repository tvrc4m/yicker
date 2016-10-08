<?php

/**
 * 切换身份
 */
class SwitchAction extends VKWeddingAction
{
    
    public function index(){

    	$joined_wedding=M('user/wedding','get_joined_wedding',array($this->user_id));

    	if ($this->have_wedding) {
    		
    		$have_wedding=M('wedding/wedding','get_user_weddings',array($this->user_id));
    	}

    	$this->assign(array('joined_wedding'=>$joined_wedding,'have_wedding'=>$have_wedding,'selected_wedding_id'=>$this->selected_wedding_id));

    	$this->title='切换婚礼';

    	$this->display('wedding/switch');
    }

    public function change(){

    	$id=$this->get['id'];

    	$type=$this->get['type'];

    	$verified=false;

    	if ($type==1) {
    		// 切换到自己的婚礼
    		$has=M('wedding/wedding','has',array($id,$this->user_id));

    		$has && $verified=true;

    	}else if ($type==2) {

    		$joined=M('wedding/user','joined',array($id,$this->user_id));

    		$joined && $verified=true;
    	}

    	if($verified){

    		M('user/user','update',array($this->user_id,array('selected_wedding_id'=>$id)));

    		$user=M('user/user','get',array($this->user_id));

    		update_user_session($user);

    		redirect('/wedding');
    	} 
    }
}