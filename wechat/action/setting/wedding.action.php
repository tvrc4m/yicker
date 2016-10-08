<?php

/**
 * 首页
 */
class WeddingAction extends VKMyAction{

    protected $lang='wedding/wedding';

    public function index(){
    	
    	$this->title='我的婚礼';

        $have_count=$this->user['have_count'];

        if (empty($have_count)) go('/wedding/have');

        $this->js=array('clipboard'=>'/static/js/jquery/jquery.zeroclipboard.min.js');

        $this->navbar['right_navbar']=array('first'=>array('href'=>'javascript:void(0);','icon'=>'fa-share'));

        if ($have_count>1) {

            $this->navbar['right_navbar']['second']=array('href'=>'/setting/wedding/change','icon'=>'fa-exchange','name'=>'');
        }

    	$this->display('setting/wedding');
    }

    public function change(){

        $this->title='选择婚礼';

        $weddings=M('wedding/wedding','get_user_weddings',array($this->user_id));

        $this->assign(array('weddings'=>$weddings));

        $this->display('setting/wedding/switch');
    }

    public function switchto(){

        if ($this->valid_change()) {

            M('user/user','update',array($this->user_id,array('wedding_id'=>$this->get['id'])));

            $user=M('user/user','get',array($this->user_id));

            update_user_session($user);
        }

        go('/setting/wedding');
    }

    public function have(){

        !$this->wedding_id && go('/wedding/have');

        $wedding=M('wedding/wedding','get_wedding',array($this->wedding_id,$this->user_id));
        
        if (empty($wedding)) go('/error/404');

        $this->flushform($this->post,$wedding,array('groom','bride','wedding_date','wedding_time','wedding_address'));
    	
    	$this->title='修改婚礼';

    	$this->display('setting/wedding/have');
    }


    public function title(){

        !$this->wedding_id && go('/wedding/have');

        $wedding=M('wedding/wedding','get',array($this->wedding_id));
        
        $this->flushform($this->post,$wedding,array('title','sub_title'));

        $this->title='设置婚礼标题';

        $this->display('setting/wedding/title');
    }

    public function module(){

    	$this->title='选择模块';

        $this->js=array('switch'=>'/static/js/jquery/jquery.switch.js');

        $this->navbar['right_navbar']=array(
            'first'=>array('href'=>'javascript:void(0);','icon'=>'fa-ok','name'=>'保存','ajax'=>true)
        );

        $modules=M('extension/module','get_all_modules_in_wedding',array($this->wedding_id));

        foreach ($modules as &$module) {

            $tpl=sprintf('module/%s',$module['code']);
            
            $this->tpl_exists($tpl) && $module['setting']=$this->fetch_v2($tpl);
        }

        $from=ispost()?$this->post['from']:$this->get['from'];

        $this->assign(array('modules'=>$modules,'from'=>$from));

    	$this->display('setting/wedding/module');
    }

    public function guest(){

        $this->title='参与来宾';

        !$this->wedding_id && go($this->error_404);

        $users=M('wedding/user','get_wedding_users',array($this->wedding_id));

        $users=array(array('realname'=>'魏合成'),array('realname'=>'鲁玉凇'));

        $this->assign(array('users'=>$users));

        $this->display('setting/wedding/guest');
    }

    public function pocket(){

        $this->title='收到的红包';

        $this->display('setting/wedding/redpocket');
    }

    private function valid_change(){

        $wedding_id=$this->get['id'];

        if(empty($wedding_id)) return false;

        return M('wedding/wedding','has',array($wedding_id,$this->user_id));
    }
}