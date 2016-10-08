<?php

class SettingAction extends AdminAction {

	protected $lang='setting/setting';
	 
	public function index() {

		$this->title='设置';

		if ($_SERVER['REQUEST_METHOD'] == 'POST' && $this->validate()) {
			
			M('setting/setting','add',array('group'=>'config'));

			$this->assign(array('success_message'=>L('success')));
		}

		$data=array(
			'update'=>admin_url('setting/setting'),
			'order_status'=>$order_status,
			'sms_params'=>'订单号{$order_id} 数量{$num} 分销商{$vendor} 顾客姓名{$name} 顾客电话{$phone} 门票{$title} 游玩时间{$plantime} 订购时间{$create_date}',
		);

		$this->assign($data);

		$form=array('config_order_page','config_error_display','config_name','config_phone','config_notice','config_power','config_smtp_host','config_smtp_username','config_smtp_password','config_smtp_port','config_smtp_timeout','config_order_success_message','config_order_unpay_status','config_order_success_status','config_order_refund_status','config_order_complete_status','config_order_close_status','config_sms_phone','config_sms_send','config_sms_content');

		$this->flushform($_POST,$this->settings,$form);
		
		$this->display('setting/setting');
	}

	private function validate(){

		// general
		empty($_POST['config_name']) && $this->error['name']='error_name';
		

		// email
		// empty($_POST['entry_smtp_host']) && $this->error['smtp_host']='error_smtp_host';
		// empty($_POST['entry_smtp_username']) && $this->error['smtp_username']='error_smtp_username';
		// empty($_POST['entry_smtp_password']) && $this->error['smtp_password']='error_smtp_password';
		// empty($_POST['entry_smtp_port']) && $this->error['smtp_port']='error_smtp_port';
		

		if(!empty($_POST['config_order_page']) && !is_numeric($_POST['config_order_page'])){

			$this->error['order_page']='error_order_page';
		}

		if(empty($_POST['config_order_success_status'])) $this->error['order_success_status']=L('error_order_success_status');
		if(empty($_POST['config_order_refund_status'])) $this->error['order_refund_status']=L('error_order_refund_status');

		if($this->error){

			$this->error['warning']=L('error_warning');

			return false;
		}

		return true;
	}
}
