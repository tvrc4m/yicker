<?php

/**
*视图层
*/
class View{
	
	public static $_instance=null;
	
	protected $view=null;

	protected $children=array();

	protected $lang;

	protected $title;

	protected $keyword;

	protected $description;

	protected $js;

	protected $css;
	
	public function __construct(){
		$this->init();
		$this->init_REQUEST();
		$this->lang($this->lang);
	}
	
	/**
	*	单例模式
	*/
	public static function Instance(){
		if(self::$_instance==null){
			$c=get_called_class();
			self::$_instance=new $c;
			self::$_instance->init();
		}
		return self::$_instance;
	}
	/**
	*	初始化smarty类
	*/
	private function init(){
		include_once(SMARTY.'/Smarty.class.php');
		$this->view=new Smarty;
		$this->view->setTemplateDir(VIEW);
		$this->view->setCacheDir(CACHE_DIR);
		$this->view->setCompileDir(COMPILE_DIR);
		$this->view->caching=HTML_CACHE;
	}

	private function init_REQUEST(){

		// P('SecurityFilter');

		$page=isset($_GET['page'])?$_GET['page']:1;

		$page< 1 && $page=1;
		$page>100 && $page=100;

		$_GET['page']=$page;
	}

	/**
	*	安全性过滤
	*/
	private function stripslashes_array(&$array) {
		while(list($key,$var) = each($array)) {
			if ($key != 'argc' && $key != 'argv' && (strtoupper($key) != $key || ''.intval($key) == "$key")) {
				is_string($var) && $array[$key] = stripslashes($var);
				is_array($var) && $array[$key] = stripslashes_array($var);
			}
		}
		return $array;
	}

	private function lang($lang=''){
		global $langs;
		if(!empty($lang)){
			if(is_string($lang)) 
				L::load($lang);
			else if(is_array($lang)) 
				foreach ($lang as $l)  $this->lang($l);
		}
		$this->assign($langs);
	}
	/**
	*	子Action调用 
	*/
	protected function fetch_children($children){
		foreach ($children as $key=>$child) {
			if(is_array($child)){
				$this->view->assign($key,A::run($child[0],$child[1]));
			}else{
				$this->view->assign($key,A::run($child,array()));
			}
		}
	}

	protected function get_pjax_children(){
		return array();
	}

	/**
	**	向页面赋值
	*/
	protected function assign($array){
		foreach($array as $k=>$v){
			$this->view->assign($k,$v);
		}
	}

	/**
	*	显示页面
	*/
	protected function display($tpl,$cache_id=null,$compile_id=null,$suffix='.tpl'){
		$this->display_before();
		if(PAJX_ENABLE && ispjax() && empty($this->js) && empty($this->css)){
			$this->fetch_children($this->get_pjax_children());
			exit($this->view->fetch($tpl.$suffix,$cache_id,$compile_id));
		}else{
			$this->fetch_children($this->get_children());
			$this->view->display($tpl.$suffix,$cache_id,$compile_id);
		}
	}

	/**
	*	获取页面内容
	*/

	protected function fetch($tpl,$cache_id=null,$compile_id=null,$suffix='.tpl'){
		$this->fetch_children($this->get_children());
		return $this->view->fetch($tpl.$suffix,$cache_id,$compile_id);
	}

	/**
	 * 获取子页面内容
	 * @param  string $tpl        模板相对路径
	 * @param  string $cache_id   缓存id
	 * @param  string $compile_id 编译文件id
	 * @param  string $suffix     文件后缀名
	 * @return string             文件内容
	 */
	protected function fetch_v2($tpl,$cache_id=null,$compile_id=null,$suffix='.tpl'){
		return $this->view->fetch($tpl.$suffix,$cache_id,$compile_id);
	}

	protected function tpl_exists($tpl,$suffix='.tpl'){
		return file_exists(VIEW.$tpl.$suffix);
	}

	protected function display_before(){

	}
}