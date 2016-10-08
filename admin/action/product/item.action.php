  <?php

class ItemAction extends AdminAction {
	
	  protected $lang="product/item";

  	 public function index() {

        $this->title='产品列表';

    		$page=$_GET['page'];

    		$limit=V('config_item_page');

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

    		$items=M('product/item','list',$data);
    		$total=M('product/item','count',$data);

        $cats=M('product/cat','all');

    		foreach ($items as $k => $item) {
    			
    			$items[$k]['action'][]=array('href'=>admin_url('product/item/update/'.$item['item_id']),'text'=>L('text_edit'));
    		}
    		
        $data['items']=$items;
    		$data['cats']=$cats;
        $data['insert']=admin_url('product/item/insert');
        $data['delete']=admin_url('product/item/delete');
    		
    		$urlpage=page($total,$page,$limit);

    		$this->assign(array('urlpage'=>$urlpage));

    		$this->assign($data);

    		$this->display('product/item_list');
  	}

    public function insert(){

      $this->title=L('insert_title');

      if (ispost() && $this->validateForm()) {

        $status=M('product/item','add',$_POST);

        $status && redirect(admin_url('product/item'));
      }

      $this->assign(array('heading_title'=>L('insert_title')));

      $this->getForm();
    }

    public function update(){

      $this->title=L('update_title');

      if (ispost() && $this->validateForm()) {

        M('product/item','edit',array('item_id'=>$_GET['id'],'data'=>$_POST));

        redirect(admin_url('product/item'));
      }

      $this->assign(array('heading_title'=>L('update_title')));
      
      $this->getForm();
    }

    public function delete(){

      if (!empty($_POST['selected'])) {

        foreach ($_POST['selected'] as $item_id) {
         
          D('product/item')->updateItem($item_id,array('deleted'=>1));
        }
      }
      redirect(admin_url('product/item'));
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

        $items=M('product/item','list',$data);

        foreach ($items as $item) {
          $json[] = array(
            'item_id'    => $item['item_id'],
            'title'      => strip_tags(html_entity_decode($item['title'], ENT_QUOTES, 'UTF-8')),
            // 'model'      => $item['model'],
            // 'option'     => $option_data,
            'price'      => $item['price']
          );
        }
      }

      header('Content-Type: application/json');

      exit(json_encode($json));
    }

    public function getForm(){

      if(!empty($_GET['id'])){

        $item_id=$_GET['id'];

        $item=M('product/item','get',array('item_id'=>$item_id));

        $action=admin_url('product/item/update/'.$item_id);

        $attrs=M('product/attr','item',$item_id);

        $options=M('product/option','item',$item_id);

        $images=M('product/image','item',$item_id);

      }else{

        $action=admin_url('product/item/insert');
      }

      $attr_group=M('product/attr.group','select');

      $cats=M('product/cat','all');

      // print_r($_POST);exit;
      if(isset($_POST['attrs'])) $attrs=$_POST['attrs'];
      if(isset($_POST['options'])) $options=$_POST['options'];
      if(isset($_POST['images'])) $images=$_POST['images'];

      $form=array('title','price','discount','quantity','cat_id','image','short_desc','description','status','sort','sku');

      $this->flushform($_POST,$item,$form);

      $data=array('action'=>$action,'attr_group'=>$attr_group,'cats'=>$cats,'attrs'=>$attrs,'options'=>$options,'images'=>$images);

      $this->assign($data);

      $this->display('product/item_form');
    }

    public function option(){

      $item_id=$_GET['id'];

      $options=M('product/option','item',$item_id);

      $json=array();

      foreach ($options as $option) {
        
        $json[$option['item_option_id']]=array('name'=>$option['name'],'price'=>$option['price']);
      }

      exit(json_encode($json));
    }

    public function validateForm(){

      $item_id=$_GET['id'];

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