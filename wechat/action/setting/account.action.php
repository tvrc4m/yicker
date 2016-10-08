<?php

/**
 * 我的帐户
 */
class AccountAction extends VKMyAction{

    protected $lang='user/account';
    
    public function index(){

        $this->title='个人信息设置';
        // print_r($this->user);exit;
        $this->assign(array('user'=>$this->user));

    	$this->display('setting/account');
    }

    /**
     * 修改手机号
     * @return 
     */
    public function phone(){

    	$this->title='修改手机号';

    	$this->display('setting/account/phone');
    }

    /**
     * 设置或修改帐户昵称 
     * @return 
     */
    public function nick(){

    	$this->title='修改昵称';

        $this->flushform($this->post,array('nick'=>$this->user['nick']),array('nick'));

    	$this->display('setting/account/nick');
    }

    /**
     * 设置或修改帐户密码
     * @return 
     */
    public function password(){

        $this->flushform($this->post,array(),array('oldpwd','newpwd','repwd'));

        $this->title='修改密码';

        $this->display('setting/account/password');
    }

    /**
     * 设置或修改个人头像
     * @return
     */
    public function avatar(){

        if (ispost() && $this->valid_avatar()) {
            
            M('user/user','update',array($this->user_id,array('avatar'=>$this->post['avatar'])));

            $user=M('user/user','get',array($this->user_id));

            update_user_session($user);

            go('/setting/account');
        }

        $this->title='修改头像';

        $this->js=array('aliyun'=>'/static/js/aliyun/aliyun-oss-4.3.min.js','arttemplate'=>'/static/js/template.js');

        if (ispost()) {
            
            $avatar=$this->post['avatar'];

            if(!empty($avatar)){

                include_once EXTENSION.'aliyun/oss/OssClient.php';

                $client=new OssClient('oss-cn-qingdao.aliyuncs.com');

                $object=$client->getObjectMeta('yicker-avatar',$avatar);

                $avatar_url=$object['oss-request-url'];
            }
        }else{

            $avatar=$this->user['avatar'];

            $avatar_url=$this->user['avatar_url'];
        }

        $this->assign(array('avatar'=>$avatar,'avatar_url'=>$avatar_url));

        $this->display('setting/account/avatar');
    }

    private function valid_avatar(){

        empty($this->post['avatar']) && $this->error['avatar']=L('avatar_empty');
        
        return !$this->error;
    }
}