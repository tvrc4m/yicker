<?php 

class HeaderAction extends AppAction {

	protected $lang=array();

	public function index($data) {

		$data['pCss']=array_filter(array_merge(array(
			'global'=>'/static/flaty/css/flaty.css?v='.VERSION,
			'awesome'=>'/static/third/font-awesome/css/font-awesome.min.css',
			'nprogress'=>'/static/js/nprogress/nprogress.css',
			'fancybox'=>'/static/third/fancyBox/jquery.fancybox.css',
		),(array)$data['pCss']));
		
		$data['pJs']=array_filter(array_merge(array(
			'jquery'=>'/static/js/jquery/jquery-2.2.3.js',
			// 'hammer'=>'/static/flaty/js/hammer.js',
			'pjax'=>'/static/js/jquery/jquery.pjax.js',
			'nprogress'=>'/static/js/nprogress/nprogress.js',
			'global'=>'/static/js/global.js?v='.VERSION,
			'fancybox'=>'/static/third/fancyBox/jquery.fancybox.js',
			'fancybox.pack'=>'/static/third/fancyBox/jquery.fancybox.pack.js',
			// 'custom'=>'/static/js/custom.js',
		),(array)$data['pJs']));

		$this->assign($data);
		
		return $this->fetch('common/header');
	}

	protected function get_children(){

		return array();
	}
}
