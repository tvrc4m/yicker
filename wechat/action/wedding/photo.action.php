<?php

/**
 * 婚纱照
 */
class PhotoAction extends VKWeddingAction {

    protected $lang='wedding/wedding';
    
    public function index(){

    	$this->title='我的的结婚照';

    	$this->navbar['right_navbar']=array('first'=>array('href'=>'javascript:void(0);','icon'=>'fa-share','class'=>'share'),'second'=>array('href'=>'/wedding/photo/upload','icon'=>'fa-photo'));

        $photos=M('wedding/photo','wedding',array($this->selected_wedding_id));
    	
        $this->assign(array('photos'=>$photos));

    	$this->display('wedding/photo');
    }

    public function upload(){

        if (ispost() && $this->valid_upload()) {

            foreach ($this->post['upload'] as $index => $upload) {
                
                 M('wedding/photo','add',array($this->selected_wedding_id,$upload['photo'],$upload['content']));
            }

            go('/wedding/photo/success');
        }

    	$this->title='上传结婚照';

        $this->js=array('aliyun'=>'/static/js/aliyun/aliyun-oss-4.3.min.js','arttemplate'=>'/static/js/template.js');

        $this->navbar['right_navbar']=array(array('href'=>'javascript:void(0);','icon'=>'fa-cloud-upload','name'=>'','attr'=>array('data-upload'=>true)));

        include_once EXTENSION.'aliyun/oss/OssClient.php';

        $client=new OssClient('oss-cn-qingdao.aliyuncs.com');

        $buckets=$client->listBuckets();

        foreach ($this->post['upload'] as &$upload) {
            
            $object=$client->getObjectMeta('yicker-avatar',$upload['photo']);

            $upload['url']=$object['oss-request-url'];
        }

        $this->flushform($this->post,array(),array('photo','wedding'));

        $upload=json_encode($this->post['upload']);

        $this->assign(array('upload'=>$upload));

    	$this->display('wedding/photo_upload');	
    }



    public function success(){

    	$this->title='上传成功';

    	$this->display('wedding/photo_upload_success');
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