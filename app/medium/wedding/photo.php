<?php

class WeddingPhoto extends Medium{

	public function wedding($wedding_id,$user_id,$page_no){

		$photos =$this->wedding_photo->selectByParams(array('wedding_id'=>$wedding_id),array('create_date DESC'));
		
		include_once EXTENSION.'aliyun/oss/OssClient.php';

        $client=new OssClient('oss-cn-qingdao.aliyuncs.com');

		foreach ($photos as &$photo) {
			
			$object=$client->getObjectMeta('yicker-avatar',$photo['photo']);

            $photo['url']=$object['oss-request-url'];
		}
		return $photos;
	}

	public function add($wedding_id,$photo,$desc){

		if (empty($wedding_id) || empty($photo)) {
			return false;
		}

		return $this->wedding_photo->insert(array('wedding_id'=>$wedding_id,'photo'=>$photo,'content'=>$desc,'status'=>1,'deleted'=>0,'create_date'=>time()));
	}

	public function delete($wedding_id,$photo_id){

		
	}
}