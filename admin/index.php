<?php

define("ROOT",dirname(dirname(__FILE__)));
define("HOME",dirname(__FILE__));

include_once(ROOT.'/app/config/config.php');
include_once(ROOT.'/library/core/config.php');
include_once(ROOT.'/app/config/config.php');
include_once(CORE.'startup.class.php');
include_once(ROOT.'/app/core/base.model.php');

// ini_set('session.cookie_domain',COOKIE_DOMAIN);
session_set_cookie_params(7200);
session_start();


// init default language 
$lang=new Lang('zh');

$folder=isset($_REQUEST['f'])?strtolower($_REQUEST['f']).'/':'common/';

!isset($_REQUEST['app']) && $_REQUEST['app']='index';

$app=$_REQUEST['app'];

$method=isset($_REQUEST['act'])?$_REQUEST['act']:'index';

$appFile=ACTION.$folder.strtolower($app).'.action.php';

!file_exists($appFile) && exit('指定文件不存在');

include_once($appFile);

$className=ucfirst($app).'Action';

$appInstance=new $className;

!method_exists($appInstance,$method) && exit('instance method is not exist');

$appInstance->$method();
