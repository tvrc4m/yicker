<?php 

class HeaderAction extends AdminAction {

	protected $lang="common/header";

	public function index($data) {

		$links['logout'] = admin_url('common/logout' );
		
		$links=array(
			array('name'=>'首页','link'=>admin_url()),
			array('name'=>'微信','menus'=>array(
				array('name'=>'菜单','link'=>admin_url('wechat/menu')),
				array('name'=>'模板','link'=>admin_url('wechat/template')),
				array('name'=>'群组','link'=>admin_url('wechat/group')),
				array('name'=>'微信用户','link'=>admin_url('wechat/user')),
			)),
			// array('name'=>'产品','menus'=>array(
			// 	array('name'=>'商品','link'=>admin_url('product/item')),
			// 	array('name'=>'类别','link'=>admin_url('product/cat')),
			// 	array('name'=>'属性组','link'=>admin_url('product/attr/group')),
			// 	array('name'=>'属性','link'=>admin_url('product/attr')),
			// )),
			array('name'=>'扩展','menus'=>array(
				array('name'=>'模块','link'=>admin_url('extension/module')),
				array('name'=>'布局','link'=>admin_url('extension/layout')),
				array('name'=>'banner','link'=>admin_url('extension/banner')),
				array('name'=>'模块','link'=>admin_url('extension/template')),
			)),
			array('name'=>'系统','menus'=>array(
				array('name'=>'设置','link'=>admin_url('setting/setting'))
			))
		);

		$folder=$_GET['f'];
		
		$selected[($folder=='payment' || $folder=='module' || $folder=='extension' || $folder=='shipping')?'extension':$folder]='selected';
		
		$links['selected']=$selected;
		
		$this->assign($data);
		$this->assign(array('links'=>$links));
				
		return $this->fetch('common/header');
	}
}
