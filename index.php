<?php

header('Content-type:text/html;charset=utf-8');

// error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);
// ini_set('display_errors', 'Off');

date_default_timezone_set('Asia/Shanghai');

define('ROOT',dirname(__FILE__));
define('HOME',ROOT.'/wechat');

$folder=isset($_REQUEST['f'])?strtolower($_REQUEST['f']).'/':'home/';

include_once(ROOT.'/app/config/config.php');
include_once(ROOT.'/app/config/env.php');
include_once(ROOT.'/library/core/config.php');
include_once(CORE.'startup.class.php');
include_once(ROOT.'/app/core/base.action.php');
include_once(ROOT.'/app/core/base.model.php');

// ini_set('session.cookie_domain',COOKIE_DOMAIN);
session_set_cookie_params(1800, '/');
session_save_path(SESSION);
session_start();

/**
 * 未捕捉异常处理
 * @param  class $exception 
 * @return
 */
function exception_handler($exception) {
   if(DEBUG) echo "Uncaught exception: " , $exception->getMessage(), "\n";exit;
}
// 注册事件处理程序 
set_exception_handler('exception_handler');


// init default language 
$lang=new Lang();

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
