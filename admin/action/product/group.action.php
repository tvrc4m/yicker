<?php

class GroupAction extends AdminAction {
  
     protected $lang="product/group";

     public function index() {

        $this->title='产品类别';

        $page=$_GET['page'];

        $limit=V('config_group_page');

        empty($limit) && $limit=30;

        $filter_group_id=$this->filter('filter_group_id');
        $filter_name=$this->filter('filter_name');
        $filter_create_date=$this->filter('filter_create_date');
        $filter_status=$this->filter('filter_group_status');
      
        $data = array(
          'filter_group_id'   => $filter_group_id,
          'filter_name'   => $filter_name,
          'filter_create_date'    => $filter_create_date,
          'filter_status'   => $filter_status,
          'sort'            => $sort,
          'group'           => $group,
          'start'           => ($page - 1) * $limit,
          'limit'           => $limit
        );

        $groups=M('product/attr.group','list',$data);
        $total=M('product/attr.group','count',$data);

        foreach ($groups as $k => $group) {
          
          $groups[$k]['action'][]=array('text'=>L('text_edit'),'href'=>admin_url('product/group/update/'.$group['attr_group_id']));
          // $groups[$k]['action'][]=array('text'=>L('text_edit'),'href'=>admin_url('product/group/update'));
        }
        
        $data['attr_groups']=$groups;
        $data['insert']=admin_url('product/attr/group/insert');
        $data['delete']=admin_url('product/attr/group/delete');
        
        $urlpage=page($total,$page,$limit);

        $this->assign(array('urlpage'=>$urlpage));

        $this->assign($data);

        $this->display('product/attr_group_list');
    }

  public function insert(){

      $this->title=L('insert_title');

      if (ispost() && $this->validateForm()) {

        $group_id=M('product/attrGroup','add',$_POST);

        if($group_id){

          redirect(admin_url('product/attr/group'));
        }
      }

      $this->assign(array('form_heading_title'=>L('insert_title')));

      $this->getForm();
  }

  public function delete(){

      $selected=$_POST['selected'];

      if (!empty($selected)) {
         
          M('product/attr.group','del',$selected);
      }
  }

  public function update(){

    $this->title=L('update_title');

    if (ispost() && $this->validateForm()) {

        $attr_group_id=$_GET['id'];

        M('product/attr.group','edit',array('attr_group_id'=>$attr_group_id,'data'=>$_POST));

        redirect(admin_url('product/attr/group'));
    }

    $this->assign(array('form_heading_title'=>L('update_title')));
    
    $this->getForm();
  }

  public function getForm(){

    if(!empty($_GET['id'])){

      $group=M('product/attr.group','get',array('attr_group_id'=>$_GET['id']));

      $action=admin_url('product/group/update/'.$_GET['id']);

      $this->assign(array('heading_title'=>L('update_title')));

    }else{

      $action=admin_url('product/group/insert');

      $this->assign(array('heading_title'=>L('insert_title')));
    }

    $form=array('name','status','sort');

    $this->flushform($_POST,$group,$form);

    $data=array('action'=>$action);

    $this->assign($data);

    $this->display('product/attr_group_form');
  }

  public function validateForm(){

    $group_id=$_GET['id'];

    empty($_POST['name']) && $this->error['name']=L('error_name');

    return !$this->error;
  }
}