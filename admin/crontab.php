<?php

date_default_timezone_set('Asia/Shanghai');

error_reporting(E_ALL & ~E_NOTICE);

define("ROOT",dirname(dirname(__FILE__)));
define("HOME",dirname(__FILE__));
define('IS_ADMIN',true);

include_once(ROOT.'/library/core/config.php');

global $lock;

$lock = LOG.'admin_crontab_'.$argv[1].'.lock';

if(is_file($lock)){
    exit("lock");
}

include_once(CORE.'function.php');
include_once(CORE.'common.php');
include_once(CORE.'code.inc.php');
include_once(CORE.'admin.func.php');
include_once(CORE.'db.class.php');
include_once(CORE.'sphinx.class.php');
include_once(CORE.'model.class.php');
include_once(CORE.'view.class.php');
include_once(CORE.'action.class.php');
include_once(CORE.'medium.class.php');
include_once(CORE.'lang.class.php');
include_once(CORE.'plugin.class.php');
include_once(CORE.'alias.class.php');


set_time_limit(1800);

// init default language 
$lang=new Lang('zh');

$settings=M('setting/setting','all',array());

foreach ($settings as $key => $value) {
    V(strtolower($key),$value);
}

function exception_handler($exception) {
    global $lock;
    @unlink($lock);
    logfile('exception.log','PHP Exception ' .$exception->getMessage()."\n\r". $exception->getCode() . ':  ' . $exception->getTraceAsString() . ' in ' . $exception->getFile() . ' on line ' . $exception->getLine());
    return true;
}

function remove_lock(){
    global $lock;
    @unlink($lock);
}

set_exception_handler('exception_handler');
register_shutdown_function('remove_lock');

class Runing{
    private  $lock;
    public function __construct($lock,$flag){
        file_put_contents($lock,'lock',LOCK_EX);
        $this->lock = $lock;

        switch($flag){

            case "vdian_order_list":M('module/vdian','get.order.list',array());break;    

            case 'ticket.book':M('crontab/ticket','book');break;
        }
    }

    public function __destruct(){
        unlink($this->lock);
    }
}
// new Runing($lock,'ticket.book');
new Runing($lock,$argv[1]);
