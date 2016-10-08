<?php

define("ROOT",dirname(dirname(__FILE__)));
define("HOME",dirname(__FILE__));

include_once(ROOT.'/library/core/config.php');

$db=new mysqli(MYSQL_H, MYSQL_U, MYSQL_P, MYSQL_DB);

if(!$db){
	echo 'can not connect mysql'.PHP_EOL;
	exit;
}

mysqli_set_charset($db,'UTF8');

$result=mysqli_query($db,"SELECT * FROM ".DB_PREFIX."migration");

if(!$result){

	$sql="CREATE TABLE `".DB_PREFIX."migration`(`id` INT AUTO_INCREMENT PRIMARY KEY,filename varchar(64) NOT NULL,`version` varchar(64) NOT NULL,`run_time` TIMESTMP DEFAULT CURRENT_TIMESTMP) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

	$status=mysqli_query($db,$sql);

	$result=mysqli_query($db,"SELECT * FROM ".DB_PREFIX."migration");
}

mysqli_autocommit($db,FALSE);

$migrations=array();

while ($row=mysqli_fetch_assoc($result)) {
	
	$migrations[$row['version']]=$row;
}

$versions=array_keys($migrations);

echo 'MIGRATION START'.PHP_EOL;

$php_files = glob(HOME. '/migration/*.php');

foreach ($php_files as $file_path) {

	if (preg_match('/([_a-zA-Z0-9\-]*).php/', basename($file_path),$matches)) {
		
		$filename=$matches[1];
		$mcrypt=sha1($matches[1]);

		if(!in_array($mcrypt,$versions)){

			$trans=mysqli_query($db,"START TRANSACTION");

			if(!$trans){

				echo "dont support transaction".PHP_EOL;
			}

			global $sql;

			$sql=array();

			include $file_path;

			$success=true;

			foreach ($sql as $k => $v) {

				if(mysqli_query($db,$v,MYSQLI_USE_RESULT)===FALSE){

					echo "SQL ERROR：".$v.PHP_EOL;

					$success=false;

					mysqli_rollback($db);

					break;
				}
			}

			if(!$success) continue;

			if(mysqli_query($db,"INSERT INTO ".DB_PREFIX."migration SET filename='".$filename."',version='".$mcrypt."'",MYSQLI_USE_RESULT)===FALSE){

				echo "update migration error".PHP_EOL;

				mysqli_rollback($db);

				continue;
			}

			mysqli_commit($db);
		}
	}
}

echo 'MIGRATION END'.PHP_EOL;

