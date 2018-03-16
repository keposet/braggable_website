<?php
// set error reporting on for debugging
error_reporting(E_ALL);
ini_set('display_errors','1');

/* note: connection for cloud9 */
$ip = getenv('IP');
$port = '3306';
$dbname ='travel';

// db connection string
define('DBCONNECTION', "mysql:host=$ip;port=$port;dbname=$dbname;charset=utf8mb4;");
define('DBUSER', getenv('C9_USER'));
define('DBPASS', '');

// auto load all classes to reduce includes
spl_autoload_register(function ($class) {
 $file = 'lib/' .$class. '.class.php';
 if (file_exists($file))
 include $file;
});

// connect to the database
// Once included this variable can be passed to data gateways to query the DB
$connection = DatabaseHelper::createConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));

?>