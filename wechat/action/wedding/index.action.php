<?php

/**
 * 婚礼
 */
class IndexAction extends VKWeddingAction {

	public function index(){

    	$this->title='婚礼';

        $is_owner=false;

        $wedding = $modules = array();

        if (empty($this->selected_wedding_id)) {
            
            $weddings=M('wedding/wedding','user_have_and_join_wedding',array($this->user_id));
         
            if(!empty($weddings)){

                if (!empty($weddings['have'])) {
                    
                    $wedding=$weddings['have'][0];
                }else if(!empty($weddings['join'])){

                    $wedding=$weddings['join'][0];
                }

                $is_owner=M('wedding/wedding','has',array($wedding['id'],$this->user_id));
            }
        }else{

            $is_owner=$this->is_owner;

            $wedding=M('wedding/wedding','get',array($this->selected_wedding_id));
        }

        if (!empty($wedding)) {
            
            $modules=M('wedding/module','get_wedding_modules',array($wedding['id'],$is_owner));
        }

        $this->assign(array('wedding'=>$wedding,'modules'=>$modules,'is_owner'=>$is_owner));

    	// $this->navbar['right_navbar']=array('first'=>array('href'=>'javascript:void(0);','icon'=>'fa-share'));

        if ($is_owner) {

            $this->navbar['right_navbar']['second']=array('href'=>'/setting/wedding/module?from=wedding','icon'=>'fa-plus');
        }

    	$this->navbar['left_navbar']=array();
    	
    	$this->display('wedding/index');
    }
}