<?php

/**
* App页面
*/
class AppAction extends Action {

	/**
	 * 用来判断浏览器的实例对象
	 * @var object
	 */
	protected $browser;

	/**
	 * 导航栏
	 * @var array
	 */
	protected $navbar;

	/**
	 * 底部tabbar
	 * @var array
	 */
	protected $tabbar;

	/**
	 * 记录回退按钮需要回退的步数,默认为-1
	 * @var integer
	 */
	protected $history_back=-1;
	/**
	 * 标识用户是否已登录
	 * @var boolean
	 */
	protected $is_login;

	/**
	 * 当前登录用户id
	 * @var int
	 */
	protected $user_id=0;

	/**
	 * 默认的page主页
	 * @var string
	 */
	protected $page_main="common/page";

	/**
	 * pjax页加载的module
	 * @var string
	 */
	protected $page_pjax="common/pjax";

	/**
	 * 404错误页面
	 * @var string
	 */
	protected $error_404='/error/404';

	function __construct(){
		parent::__construct();
		$this->browser_history();
		$this->browser_detected();
		$this->is_login=(S(SESSION_USER_ID) && S(SESSION_USER));
		$this->is_login && $this->user_id= S(SESSION_USER_ID);
		$this->assign(array(
			'is_weixin'=>$this->browser->weixin,
			'is_ios'=>$this->browser->ios,
			'is_andriod'=>$this->browser->andriod,
			'is_login'=>$this->is_login,
		));
		$this->navbar=array(
			'left_navbar'=>array('href'=>sprintf("javascript:goBack(%d);",(int)$this->history_back),'icon'=>'fa-chevron-left'),
			'show_navbar'=>1
		);
		$this->tabbar=array(
			'hide_tabbar'=>0
		);
	}

	/**
	 * 记录每次post请求，后退的步数递减
	 * 默认后退步数为-1
	 * !import 表单提交中需要传递history_back回来
	 * !TODO 如何更好的在表单中写入history_back
	 * @return
	 */
	protected function browser_history(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$this->history_back=(int)$this->post['history_back'];
			$this->history_back--;
		}
		$this->assign(array('history_back'=>$this->history_back));
	}

	protected function browser_detected(){
		include_once CORE."browser.class.php";
		$this->browser=new Browser();
	}

	protected function display_before(){
		$this->navbar['title']=$this->title;
	}

	protected function display($tpl,$cache_id=null,$compile_id=null,$suffix='.tpl'){
		$this->display_before();
		if(PAJX_ENABLE && ispjax() && empty($this->js) && empty($this->css)){
			$this->fetch_children($this->get_pjax_children());
			$page=$this->page_pjax;
		}else{
			$this->fetch_children($this->get_children());
			$page=$this->page_main;
		}
		$content=$this->view->fetch($tpl.$suffix,$cache_id,$compile_id);
		$this->assign(array('page'=>$content));
		$this->view->display($page.$suffix);
	}

	/**
	 * 获取基础class类的组合子类
	 * @return array 子类的相对路径+传递的参数数组
	 */
	protected function get_children(){
		return array(
			'header'=>array('common/header',array('pTitle'=>$this->title,'pKeyword'=>$this->keyword,'pDesc'=>$this->description,'pCss'=>$this->css,'pJs'=>$this->js,'header'=>$this->header)),
			'footer'=>array('common/footer',array('footer'=>$this->footer,'tabbar'=>$this->tabbar)),
			'navbar'=>array('common/navbar',$this->navbar),
			'tabbar'=>array('common/tabbar',$this->tabbar)
		);
	}

	protected function get_pjax_children(){
		return array(
			'navbar'=>array('common/navbar',$this->navbar),
			'tabbar'=>array('common/tabbar',$this->tabbar)
		);
	}
}

class AppAuthAction extends AppAction{

	/**
	 * 用户对象实例
	 * @var object=array
	 */	
	protected $user=array();

	/**
	 * 婚礼wedding对象
	 * @var object=array
	 */
	protected $wedding=array();

	/**
	 * 是否举办过婚礼
	 * @var boolean
	 */
	protected $have_wedding;

	/**
	 * 当前用户切换的wedding_id
	 * @var int
	 */
	protected $selected_wedding_id;

	/**
	 * 当前用户自己的婚礼id
	 * @var int
	 */
	protected $wedding_id;

	/**
	 * 当前登录用户切换的wedding是否是新郎
	 * @var boolean
	 */
	protected $is_groom=false;

	/**
	 * 当前登录用户切换的wedding是否是新娘
	 * @var boolean
	 */
	protected $is_bride=false;

	/**
	 * 当前登录用户切换的wedding是否是新娘或者新郎
	 * @var boolean
	 */
	protected $is_owner=false;

	public function __construct(){

		parent::__construct();

		if(!$this->is_login){

			$back= $_SERVER['HTTPS']?'https://':'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

			redirect('/login?back='.urlencode($back));
		}

		$this->user=S(SESSION_USER);

		$this->selected_wedding_id=$this->user['selected_wedding_id'];
		$this->wedding_id=$this->user['wedding_id'];

		if ($this->selected_wedding_id) {
			
			$this->wedding=M('wedding/wedding','get',array($this->selected_wedding_id));
			$this->is_groom=$this->wedding['groom_id']==$this->user_id;
			$this->is_bride=$this->wedding['bride_id']==$this->user_id;
			$this->is_owner=$this->is_groom || $this->is_bride;
		}

		$this->have_wedding=$this->user['have_count'];

		$this->assign(array(
			'have_wedding'=>$this->have_wedding,
			'wedding'=>$this->wedding,
			'selected_wedding_id'=>$this->selected_wedding_id,
			'wedding_id'=>$this->wedding_id,
			'is_groom'=>$this->is_groom,
			'is_bride'=>$this->is_bride,
			'is_owner'=>$this->is_owner,
		));
	}
}

class VKHomeAction extends AppAuthAction{

	public function __construct(){
		parent::__construct();
		$this->tabbar=array('tabbar_home'=>'selected');
	}
}

class VKDiscoverAction extends AppAuthAction{

	public function __construct(){
		parent::__construct();
		$this->tabbar=array('tabbar_discover'=>'selected');
	}
}

class VKWeddingAction extends AppAuthAction{

	public function __construct(){
		parent::__construct();
		$this->tabbar=array('tabbar_wedding'=>'selected');
	}
}

class VKMyAction extends AppAuthAction{

	public function __construct(){
		parent::__construct();
		$this->tabbar=array('tabbar_mine'=>'selected');
	}
}

class VKMallAction extends VKDiscoverAction{

	protected $page_main='mall/main';

	public function __construct(){

		parent::__construct();

		$this->navbar['right_navbar']=array(
            'first'=>array('href'=>'javascript:void(0);','icon'=>'fa-navicon','class'=>'open-left-sidebar'),
            'second'=>array('href'=>'/mall/cart','icon'=>'fa-shopping-cart','sup'=>'<sup>4</sup>'),
            'third'=>array('href'=>'javascript:void(0);','icon'=>'fa-search','class'=>'search-item'),
        );

        $this->css=array('mall'=>'/static/flaty/css/mall.css','owl'=>'/static/third/owlcarousel/owl.carousel.min.css');
        $this->js=array('mall'=>'/static/js/mall.js','owl'=>'/static/third/owlcarousel/owl.carousel.min.js');

	}

	/**
	 * 获取基础class类的组合子类
	 * @return array 子类的相对路径+传递的参数数组
	 */
	protected function get_children(){
		$chidlren=parent::get_children();
		$chidlren['sidebar_left']=array('common/sidebar/left',array());
		$chidlren['search']=array('common/search',array());
		return $chidlren;
	}

	protected function get_pjax_children(){
		$chidlren=parent::get_pjax_children();
		$chidlren['sidebar_left']=array('common/sidebar/left',array());
		return $chidlren;
	}
}

class AjaxAction extends AppAction{

	public function __construct(){

		if (!isajax()) {
			exit(json_encode(array('status'=>400,'errmsg'=>'此方法只支持ajax请求')));
		}

		parent::__construct();
	}

	protected function error($tpl='common/error'){

		$this->assign(array('errors'=>$this->error));

        exit(json_encode(array('status'=>400,'error'=>$this->fetch($tpl))));
	}
}

class AjaxAuthAction extends AppAuthAction{

	public function __construct(){

		if (!isajax()) {
			exit(json_encode(array('status'=>400,'errmsg'=>'此方法只支持ajax请求')));
		}

		if(!(S(SESSION_USER_ID) && S(SESSION_USER))){

			exit(json_encode(array('status'=>300,'errmsg'=>'正在跳转登陆...','redirect'=>'/login')));
		}

		parent::__construct();
	}

	protected function error($tpl='common/error'){

		$this->assign(array('errors'=>$this->error));

        exit(json_encode(array('status'=>400,'error'=>$this->fetch($tpl))));
	}
}


class WebAction extends AppAction{

	public function __construct(){

		parent::__construct();
	}

	/**
	 * 获取基础class类的组合子类
	 * @return array 子类的相对路径+传递的参数数组
	 */
	protected function get_children(){
		return array(
			'header'=>array('common/header',array('pTitle'=>$this->title,'pKeyword'=>$this->keyword,'pDesc'=>$this->description,'pCss'=>$this->css,'pJs'=>$this->js,'header'=>$this->header)),
			'footer'=>array('common/footer',array('footer'=>$this->footer,'tabbar'=>$this->tabbar)),
			'navbar'=>array('common/navbar',$this->navbar),
		);
	}

	protected function get_pjax_children(){
		return array(
			'navbar'=>array('common/navbar',$this->navbar),
			'tabbar'=>array('common/tabbar',$this->tabbar)
		);
	}
}

class WebAuthAction extends WebAction{

	public function __construct(){

		parent::__construct();
	}
}