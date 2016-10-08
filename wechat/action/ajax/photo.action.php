<?php

/**
 * 婚纱照
 */
class PhotoAction extends AjaxAuthAction {

    protected $lang='wedding/wedding';
    
    public function upload(){

        if (ispost() && $this->valid_upload()) {

            foreach ($this->post['upload'] as $index => $upload) {
                
                 M('wedding/photo','add',array($this->selected_wedding_id,$upload['photo'],$upload['content']));
            }

            exit(json_encode(array('status'=>200,'errmsg'=>'上传成功,正在跳转...','redirect'=>"/wedding/photo/success")));
        }

    	$this->display();	
    }

    private function valid_upload(){

        $upload=$this->post['upload'];

        foreach ($upload as $photo) {
            
            empty($photo['photo']) && $this->error['photo']=L('wedding_photo_empty');    
        }

        if(empty($this->selected_wedding_id))
            $this->error['wedding']=L('wedding_empty');
        else{

            $is_owner=M('wedding/wedding','has',array($this->selected_wedding_id,$this->user_id));

            !$is_owner && $this->error['wedding']=L('wedding_no_role');
        }

        return !$this->error;
    }
}