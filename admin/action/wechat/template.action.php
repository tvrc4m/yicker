  <?php

class TemplateAction extends AdminAction {
	
  	 public function index() {

        $this->title='微信模板列表';

    		$page=$_GET['page'];

        empty($limit) && $limit=30;

    		$filter_id=$this->filter('filter_id');
        $filter_name=$this->filter('filter_name');
    		$filter_cat=$this->filter('filter_cat');
    		$filter_create_date=$this->filter('filter_create_date');
    		$filter_status=$this->filter('filter_status');
  		
  		  $data = array(
    			'filter_id'	  => $filter_id,
          'filter_name'   => $filter_name,
          'filter_cat'   => $filter_cat,
    			'filter_create_date'	  => $filter_create_date,
    			'filter_status'   => $filter_status,
    			'sort'            => $sort,
    			'order'           => $order,
    			'start'           => ($page - 1) * $limit,
    			'limit'           => $limit
    		);

    		// $templates=M('wechat/template','list',$data);
    		// $total=M('wechat/template','count',$data);

        // $cats=M('wechat/cat','all');

    		foreach ($templates as $k => $template) {
    			
    			$templates[$k]['action'][]=array('href'=>admin_url('wechat/template/update/'.$template['template_id']),'text'=>L('text_edit'));
    		}
    		
        $data['templates']=$templates;
        $data['cats']=$cats;
        $data['insert']=admin_url('wechat/template/insert');
        $data['delete']=admin_url('wechat/template/delete');
    		
    		$urlpage=page($total,$page,$limit);

    		$this->assign(array('urlpage'=>$urlpage));

    		$this->assign($data);

    		$this->display('wechat/template_list');
  	}

    public function insert(){

      $this->title='添加微信模板';

      if (ispost() && $this->validateForm()) {

        $status=M('wechat/template','add',$_POST);

        $status && redirect(admin_url('wechat/template_form'));
      }

      $this->getForm();
    }

    public function update(){

      $this->title='修改微信模板';

      if (ispost() && $this->validateForm()) {

        M('wechat/template','edit',array('template_id'=>$_GET['id'],'data'=>$_POST));

        redirect(admin_url('wechat/template_form'));
      }

      $this->getForm();
    }

    public function delete(){

      if (!empty($_POST['selected'])) {

        foreach ($_POST['selected'] as $template_id) {
         
          D('wechat/template')->updateTemplate($template_id,array('deleted'=>1));
        }
      }
      redirect(admin_url('wechat/template'));
    }

    public function autocomplete(){

      $json = array();

      if(!empty($_GET['filter_name']) || !empty($_GET['filter_model'])){

        $filter_name=$this->filter('filter_name');
        $filter_model=$this->filter('filter_model');
      
        $data = array(
          'filter_name'   => $filter_name,
          'filter_model'   => $filter_model,
          'sort'            => $sort,
          'order'           => $order,
          'start'           => 0,
          'limit'           => 10
        );

        $templates=M('wechat/template','list',$data);

        foreach ($templates as $template) {
          $json[] = array(
            'template_id'    => $template['template_id'],
            'title'      => strip_tags(html_entity_decode($template['title'], ENT_QUOTES, 'UTF-8')),
            // 'model'      => $template['model'],
            // 'option'     => $option_data,
            'price'      => $template['price']
          );
        }
      }

      header('Content-Type: application/json');

      exit(json_encode($json));
    }

    public function getForm(){

      if(!empty($_GET['id'])){

        $template_id=$_GET['id'];

        // $template=M('wechat/template','get',array('template_id'=>$template_id));

        $action=admin_url('wechat/template/update/'.$template_id);

        // $attrs=M('wechat/attr','template',$template_id);

        // $options=M('wechat/option','template',$template_id);

        // $images=M('wechat/image','template',$template_id);

      }else{

        $action=admin_url('wechat/template/insert');
      }

      // $attr_group=M('wechat/attr.group','select');

      // $cats=M('wechat/cat','all');

      // print_r($_POST);exit;
      if(isset($_POST['attrs'])) $attrs=$_POST['attrs'];
      if(isset($_POST['options'])) $options=$_POST['options'];
      if(isset($_POST['images'])) $images=$_POST['images'];

      $form=array('title','price','discount','quantity','cat_id','image','short_desc','description','status','sort','sku');

      $this->flushform($_POST,$template,$form);

      $data=array('action'=>$action,'attr_group'=>$attr_group,'cats'=>$cats,'attrs'=>$attrs,'options'=>$options,'images'=>$images);

      $this->assign($data);

      $this->display('wechat/template_form');
    }

    public function option(){

      $template_id=$_GET['id'];

      $options=M('wechat/option','template',$template_id);

      $json=array();

      foreach ($options as $option) {
        
        $json[$option['template_option_id']]=array('name'=>$option['name'],'price'=>$option['price']);
      }

      exit(json_encode($json));
    }

    public function validateForm(){

      $template_id=$_GET['id'];

      empty($_POST['title']) && $this->error['title']=L('error_title');
      empty($_POST['short_desc']) && $this->error['short_desc']=L('error_short_desc');

      empty($_POST['price']) && $this->error['price']=L('error_price');
      empty($_POST['quantity']) && $this->error['quantity']=L('error_quantity');
      empty($_POST['image']) && $this->error['image']=L('error_image');
      // 
      foreach ($_POST['attrs'] as $k=>$attr) {
    
        empty($attr['attr_group_id']) && $this->error['attrs'][$k]['group']=L('error_attr_group');
        empty($attr['attr_name']) && $this->error['attrs'][$k]['name']=L('error_attr_name');
      }

      foreach ($_POST['options'] as $k=>$option) {
      
        empty($option['name']) && $this->error['options'][$k]['name']=L('error_option_name');
        (empty($option['price']) || !is_numeric($option['price'])) && $this->error['options'][$k]['price']=L('error_option_price');
      }
      // print_r($this->error);exit;
      if($this->error){

        $this->error['warning']=L('error_warning');

        return false;
      }

      return true;
    }
}