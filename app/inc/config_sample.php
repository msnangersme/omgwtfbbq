<?
// ---------------------------------------------
// global vars

    $site['title'] = 'OMGWTFBBQ Feed Reader';
    $site['url'] = 'http://' . $_SERVER['HTTP_HOST'] . '/myfeeds';
    $site['base'] = '/myfeeds';

	$site['dbuser'] = 'USERNAME';
	$site['dbpass'] = 'PASSWORD';
    $site['dbhost'] = '127.0.0.1';
    $site['dbname'] = 'myfeeds';


	$site['updates'] = false;

// ---------------------------------------------
// error and logging

	error_reporting(E_ALL & ~E_NOTICE);
	ini_set('display_errors', 1);
	//ini_set('error_log', APP_PATH . '/log/error.log');
	ini_set('log_errors',true);

		
// ---------------------------------------------
// definitions and datetime

    date_default_timezone_set('America/Los_Angeles');

// ---------------------------------------------
// database

	$db = new PDO('mysql:host=' . $site['dbhost'] . ';dbname=' . $site['dbname'], $site['dbuser'], $site['dbpass']);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

// ---------------------------------------------
// includes and paths
    	
	set_include_path(APP_PATH . 'inc');
	require APP_PATH . '/inc/simplepie.inc';
    require APP_PATH . '/inc/helper_functions.php';
    require APP_PATH . '/inc/action_functions.php';


