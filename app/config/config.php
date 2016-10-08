<?php

// base path
define('APP', ROOT.'/app/');
define('ADMIN', ROOT.'/admin/');
define('STATIC', ROOT.'/static/');
define('IMG', ROOT.'/image/');

define('MEDIUM', APP.'medium/');
define('MODEL', APP.'model/');
define('CONFIG',APP.'config/');
define('CACHE', APP.'cache/');

define('ACTION', HOME.'/action/');
define('VIEW', HOME.'/view/default/');
define('LANG', HOME.'/lang/');

define('BASEURL',sprintf('http://%s/',$_SERVER['HTTP_HOST']));


// mysql
define('MYSQL_H', '127.0.0.1');
define('MYSQL_U', 'wedding');
define('MYSQL_P', 'wedding');
define('MYSQL_DB', 'wedding');
define('MYSQL_CHARSET', 'UTF8');
define('DB_PREFIX', 'tt_');


define('SESSION_USER_ID', 'yicker.uid');
define('SESSION_USER', 'yicker.user');

define('DEBUG', true);

// 是否启用pjax无刷新页面请求
define('PAJX_ENABLE', true);

/**
 * 微信api参数
 */
define('WECHAT_TOKEN', 'tvrc4myicker');
define('WECHAT_APPID', 'wx9d2b5897df388543');
define('WECHAT_ENCODINGAESKEY', '9hIIuoFU85JJD2fNlU15pCWsDZAdqxBgxpa3dtACLlO');
define('WECHAT_APPSECRET', 'b86c0d2e6dae758106f517814d4a9118');
define('WECHAT_DEBUG', '');
define('WECHAT_LOGCALLBACK', '');
define('WECHAT_CACHE', CACHE.'wechat/');

/**
 * 阿里大鱼短信应用
 */
define('ALIYUN_DAYU_APPID', '23384908');
define('ALIYUN_DAYU_APPSECRET', '8b8636354e2a9a49fd3361e2803f2256');


define('ALIYUN_ACCESS_KEY', 'NOmrBGI7S2DPNPGz');
define('ALIYUN_ACCESS_SECRET', 'xiXRXm5istp0PchBfTpMqeit8SOpgS');
define('ALIYUN_ENDPOINT', 'oss-cn-qingdao.aliyuncs.com');