<?php
	header('Content-Type: text/html; charset=UTF-8');
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title><?=$site['title']?> <?if($page['title']){ echo ' - ' . $page['title'];}?></title>
	<link rel="stylesheet" type="text/css" href="<?=$site['url']?>/style.css"/>
	<link rel="shortcut icon" type="image/ico" href="<?=$site['url']?>/favicon.ico" />
	<meta name="viewport" content="width=320; initial-scale=.75" />
</head>

<body>
	<div id="page">
		
	<div id="header">
	    <h1><a href="<?=$site['url']?>"><?=$site['title']?></a></h1>
	    <p><?=$site['description']?></p>
	</div>
	  
	  <div id="navigation">
			<a href="<?=$site['url']?>">Unread</a>&nbsp;&nbsp;
			<a href="<?=$site['url']?>/addfeed">Add Feed</a>&nbsp;&nbsp;
			<a href="<?=$site['url']?>/feeds">Feeds</a>&nbsp;&nbsp;
			<a href="<?=$site['url']?>/folders">Folders</a>&nbsp;&nbsp;
			<a href="<?=$site['url']?>/search">Search</a>&nbsp;&nbsp;
	  </div>
	
	<div id="content">
		<?=$page['content']?>
	</div>

	<div id="footer">
	  <p></p>
	</div>

	</div>

</body>
</html>
