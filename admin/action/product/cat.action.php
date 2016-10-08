<?php

class CatAction extends AdminAction {
	
	   protected $lang="product/cat";

  	 public function index() {

        $this->title='产品类别';

    		$page=$_GET['page'];

    		$limit=V('config_cat_page');

        empty($limit) && $limit=30;

    		$filter_name=$this->filter('filter_name');
    		$filter_status=$this->filter('filter_status');
  		
  		  $data = array(
    			'filter_name'	  => $filter_name,
    			'filter_status'   => $filter_status,
    			'sort'            => $sort,
    			'cat'           => $cat,
    			'start'           => ($page - 1) * $limit,
    			'limit'           => $limit
    		);

    		$cats=M('product/cat','list',$data);
    		$total=M('product/cat','count',$data);

    		foreach ($cats as $k => $cat) {
    			
          $cats[$k]['action'][]=array('text'=>L('text_edit'),'href'=>admin_url('product/cat/update/'.$cat['cat_id']));
    			// $cats[$k]['action'][]=array('text'=>L('text_edit'),'href'=>admin_url('product/cat/update'));
    		}
    		
    		$data['cats']=$cats;
        $data['insert']=admin_url('product/cat/insert');
        $data['delete']=admin_url('product/cat/delete');
    		
    		$urlpage=page($total,$page,$limit);

    		$this->assign(array('urlpage'=>$urlpage));

    		$this->assign($data);

    		$this->display('product/cat_list');
  	}

  public function insert(){

      $this->title=L('insert_title');

      if (ispost() && $this->validateForm()) {

        $cat_id=M('product/cat','add',$_POST);

        if($cat_id){

          redirect(admin_url('product/cat'));
        }
      }

      $this->assign(array('form_heading_title'=>L('insert_title')));

      $this->getForm();
  }

  public function delete(){

      $selected=$_POST['selected'];

      if (!empty($selected)) {
         
          M('product/cat','del',$selected);
      }

      redirect(admin_url('product/cat'));
  }

  public function update(){

    $this->title=L('update_title');

    if (ispost() && $this->validateForm()) {

        $cid=$_GET['id'];

        M('product/cat','edit',array('cid'=>$cid,'data'=>$_POST));

        redirect(admin_url('product/cat'));
    }

    $this->assign(array('form_heading_title'=>L('update_title')));
    
    $this->getForm();
  }

  public function getForm(){

    if(!empty($_GET['id'])){

      $cat=M('product/cat','get',$_GET['id']);

      $action=admin_url('product/cat/update/'.$_GET['id']);

      $this->assign(array('heading_title'=>L('update_title')));

    }else{

      $action=admin_url('product/cat/insert');

      $this->assign(array('heading_title'=>L('insert_title')));
    }

    $form=array('cat_id','name','status','sort','parent_id');

    $this->flushform($_POST,$cat,$form);

    $parents=M('product/cat','parent');

    $data=array('action'=>$action,'parents'=>$parents);

    $this->assign($data);

    $this->display('product/cat_form');
  }

  public function validateForm(){

    $cat_id=$_GET['id'];

    empty($_POST['name']) && $this->error['name']=L('error_name');

    return !$this->error;
  }
}