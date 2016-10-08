<?php

/**
 * 首页
 */
class IndexAction extends VKHomeAction {
    
    public function index(){

        // $access_token=M('wechat/wechat','check_auth');exit;
        // $get_js_sign=M('wechat/wechat','get_js_sign');
        // $access_token=M('wechat/wechat','get_access_token');
        // print_r($access_token);
        // print_r($get_js_sign);
        // exit;
        // // 
        // include EXTENSION.'aliyun/dayu/dayu.php';

        // $dayu=new Dayu();

        // $dayu->sms_code();exit;

    	$this->title='婚礼进行时';

        $wedding=M('wedding/wedding','get',array($this->selected_wedding_id));

        $modules=M('wedding/module','get_wedding_modules',array($this->selected_wedding_id,$this->is_groom || $this->is_bride));

        $this->assign(array('wedding'=>$wedding,'modules'=>$modules));

    	$this->navbar['right_navbar']=array('first'=>array('href'=>'javascript:void(0);','icon'=>'fa-share'));
    	$this->navbar['left_navbar']=array();
    	
    	$this->display('home/index');
    }
}