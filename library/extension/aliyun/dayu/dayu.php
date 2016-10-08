<?php

define('DAYU_DIR', EXTENSION.'aliyun/dayu/');

include DAYU_DIR.'TopClient.php';
include DAYU_DIR.'ResultSet.php';
include DAYU_DIR.'RequestCheckUtil.php';
include DAYU_DIR.'TopLogger.php';

class Dayu {

	protected $client;

	public function __construct(){

		$this->client = new TopClient(ALIYUN_DAYU_APPID,ALIYUN_DAYU_APPSECRET);
	}

	public function sms_code(){

		include_once DAYU_DIR.'request/AlibabaAliqinFcSmsNumSendRequest.php';

		$req = new AlibabaAliqinFcSmsNumSendRequest;
		$req ->setExtend("");
		$req ->setSmsType("normal");
		$req ->setSmsFreeSignName("yicker.cn");
		$req ->setSmsParam(array('code'=>'197343'));
		$req ->setRecNum("15763951212");
		$req ->setSmsTemplateCode("SMS_10650290");
		$resp = $this->client->execute($req);
		print_r($resp);
	}
}