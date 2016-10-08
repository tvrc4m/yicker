<?php

class AttrAction extends AdminAction {
  
     protected $lang="product/attr";

     public function index() {

        $this->title='产品类别';

        $page=$_GET['page'];

        $limit=V('config_attr_page');

        empty($limit) && $limit=30;

        $filter_attr_id=$this->filter('filter_attr_id');
        $filter_name=$this->filter('filter_name');
        $filter_create_date=$this->filter('filter_create_date');
        $filter_status=$this->filter('filter_attr_status');
      
        $data = array(
          'filter_attr_id'   => $filter_attr_id,
          'filter_name'   => $filter_name,
          'filter_create_date'    => $filter_create_date,
          'filter_status'   => $filter_status,
          'sort'            => $sort,
          'attr'           => $attr,
          'start'           => ($page - 1) * $limit,
          'limit'           => $limit
        );

        $attrs=M('product/attr','list',$data);
        $total=M('product/attr','count',$data);

        foreach ($attrs as $k => $attr) {
          
          $attrs[$k]['action'][]=array('text'=>L('text_edit'),'href'=>admin_url('product/attr/update/'.$attr['attr_id']));
          // $attrs[$k]['action'][]=array('text'=>L('text_edit'),'href'=>admin_url('product/attr/update'));
        }
        
        $data['attrs']=$attrs;
        $data['insert']=admin_url('product/attr/insert');
        $data['delete']=admin_url('product/attr/delete');
        
        $urlpage=page($total,$page,$limit);

        $this->assign(array('urlpage'=>$urlpage));

        $this->assign($data);

        $this->display('product/attr_list');
    }

  public function insert(){

      $this->title=L('insert_title');

      if (ispost() && $this->validateForm()) {

        $attr_id=M('product/attr','add',$_POST);

        if($attr_id){

          redirect(admin_url('product/attr'));
        }
      }

      $this->assign(array('form_heading_title'=>L('insert_title')));

      $this->getForm();
  }

  public function delete(){

      $selected=$_POST['selected'];

      if (!empty($selected)) {
         
          M('product/attr','del',$selected);
      }
  }

  public function update(){

    $this->title=L('update_title');

    if (ispost() && $this->validateForm()) {

        $cid=$_GET['id'];

        M('product/attr','edit',array('cid'=>$cid,'data'=>$_POST));

        redirect(admin_url('product/attr'));
    }

    $this->assign(array('form_heading_title'=>L('update_title')));
    
    $this->getForm();
  }

  public function getForm(){

    if(!empty($_GET['id'])){

      $attr=M('product/attr','get',array('attr_id'=>$_GET['id']));

      $action=admin_url('product/attr/update/'.$_GET['id']);

      $this->assign(array('heading_title'=>L('update_title')));

    }else{

      $action=admin_url('product/attr/insert');

      $this->assign(array('heading_title'=>L('insert_title')));
    }

    $form=array('name','attr_group_id','status','sort');
    // print_r($_POST);exit;
    $this->flushform($_POST,$attr,$form);

    $groups=M('product/attr.group','select');

    $data=array('attr_groups'=>$groups,'action'=>$action);

    $this->assign($data);

    $this->display('product/attr_form');
  }

  public function validateForm(){

    $attr_id=$_GET['id'];

    empty($_POST['name']) && $this->error['name']=L('error_name');
    empty($_POST['attr_group_id']) && $this->error['group']=L('error_group');

    return !$this->error;
  }
}