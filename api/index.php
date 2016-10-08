<?php

/**
 * api.yicker.cn/user/action?version=v1&appid=?&signature=?&parames=?
 */

header('Content-type:application/json;charset=utf-8');

// error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

date_default_timezone_set('Asia/Shanghai');

define('ROOT',dirname(dirname(__FILE__)));
define('HOME',ROOT.'/api');

$className=$_GET['app'];
$methodName=$_GET['act'];
$version=$_REQUEST['version'];

empty($version) && $version='v1';

define('API_ACTION',sprintf('%s/%s/',HOME,$version));

include_once(ROOT.'/app/config/config.php');
include_once(ROOT.'/library/core/config.php');
include_once(CORE.'function.php');
include_once(CORE.'common.php');
include_once(CORE.'db.class.php');
include_once(CORE.'model.class.php');
include_once(CORE.'medium.class.php');
include_once(CORE.'api.class.php');
include_once(CORE.'plugin.class.php');

class_alias('Medium','M',true);
class_alias('MysqlModel','SQL',true);

$classPath=API_ACTION.strtolower($className).'.api.php';

if(!file_exists($classPath)){
	exit(json_encode(array('errmsg'=>'访问地址错误','status'=>1100)));
}

include_once $classPath;

$classFullName=$className.'Api';

$appInstance=new $classFullName($app);

if(!method_exists($appInstance, $methodName)){
	exit(json_encode(array('errmsg'=>'访问地址错误','status'=>1100)));
}

$appInstance->$methodName();

