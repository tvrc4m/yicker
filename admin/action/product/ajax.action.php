<?php

class AjaxAction extends AdminAction {
  
     public function upload() { 

     	$path = '/image/item/'.uniqid('TT').'.jpg';
     	
        $status=moveUploadedImage($_FILES,'image',ROOT.$path,2097152);

        if($status==1){

            exit(json_encode(array('ret'=>$status,'path'=>sprintf('http://%s%s',$_SERVER['HTTP_HOST'],$path),'name'=>$path)));
        }else{
            exit(json_encode(array('ret'=>-1,'error'=>'上传图片失败。')));
        }
     }
 }