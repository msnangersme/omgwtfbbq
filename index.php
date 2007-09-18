<?php

	require './inc/config.php';
	
	$page['template'] = 'template.php';
	$page['title'] = '';
	
	$uri = substr($_SERVER['REQUEST_URI'], strlen($site['base'])+1);

	$page['name'] = str_replace('/','_',substr($uri, 0, (strpos($uri, '?') ? strpos($uri, '?') : strlen($uri))));

	if($page['name'] == ''){
		$page['name'] = 'home';
	}

	if(function_exists($page['name'] . 'Action')){
		$fn = $page['name']  . 'Action';
		$fn();
	}
	
	if(file_exists(APP_PATH . '/' . $page['name'] . '.php')) {
		$page['filename'] = $page['name'] . '.php';
	}

	ob_start();
	
	include $page['filename'];
	
	$page['content'] = ob_get_clean();

	
	if($page['template']){
	
		include $page['template'];
		
	} else {
		
		echo $page['content'];

	}




?>
