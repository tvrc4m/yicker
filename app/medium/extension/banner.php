<?php

class ExtensionBanner extends Medium{

	public function run($action,$data){
	
		switch ($action) {
	
			case 'add':return $this->add($data);break;

			case 'get':return $this->get($data);break;

			case 'detail':return $this->detail($data);break;

			case 'edit':return $this->edit($data['banner_id'],$data['data']);break;

			case 'list':return $this->listall($data);break;
		}
	}

	private function add($data){

		$params=array('name'=>$data['name'],'status'=>(int)$data['status']);

		$banner_id=D('extension/banner')->addBanner($params);

		foreach ($data['images'] as $image) {
			
			$params=array('banner_id'=>$banner_id,'title'=>$image['title'],'link'=>$image['link'],'sort'=>(int)$image['sort'],'path'=>$image['path']);

			D('extension/banner.image')->addBannerImage($params);
		}

		return $banner_id;
	}

	private function get($banner_id){

		return D('extension/banner')->getBanner($banner_id);
	}

	private function detail($banner_id){

		$banner=$this->get($banner_id);

		$images=D('extension/banner.image')->getBannerImages($banner_id);

		$banner['images']=$images;

		return $banner;
	}

	private function edit($banner_id,$data){

		$params=array('name'=>$data['name'],'status'=>(int)$data['status']);

		D('extension/banner')->updateBanner($banner_id,$params);

		$exist=array();

		$banner_image=D('extension/banner.image');

		foreach ($data['images'] as $image) {

			$params=array('banner_id'=>$banner_id,'title'=>$image['title'],'link'=>$image['link'],'sort'=>(int)$image['sort'],'path'=>$image['path']);

			if($image['banner_image_id']){

				$exist[]=$image['banner_image_id'];

				$banner_image->updateBannerImage($image['banner_image_id'],$params);
			}else{

				$banner_image_id=$banner_image->addBannerImage($params);

				$exist[]=$banner_image_id;
			}
			
			if(!empty($exist)){

				$banner_image->delBannerImage($banner_id,$exist);
			}
		}

		return $banner_id;
	}

	private function listall($data){

		return D('extension/banner')->selectBanner();
	}
}