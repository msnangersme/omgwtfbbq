<?

// ------------------------------------------------------
// items


function markreadAction(){

	global $db, $site;

	$items = $_POST['items'];
	
	$update = $db->prepare('update item set unread = 0 where id in (' . $items . ')');
	
	$update->execute();
	
	header('Location: ' . $site['url']);
	exit();
	

}

// ------------------------------------------------------
// feeds

function editfeedAction(){
	
	global $db, $site, $page;	
	
	$id = $_GET['id'];
	
	$results = $db->prepare("select * from feed where id = :id");
	$results->bindParam(':id', $id);
	$results->execute();

	$page['feed'] = $results->fetch();
	$page['title'] = 'Edit Feed';

	$page['name']= 'feedform';

}

function addfeedAction(){
	
	global $site, $page;	
	
	$newfeed = array();
	$newfeed['id'] = 'new';
	
	$feedurl = $_GET['url'];
	
	if($feedurl){
		
		$feed = new SimplePie();
		$feed->set_feed_url($feedurl);
		$feed->enable_cache(false);
		$feed->init();
		
		$newfeed['title'] = $feed->get_title();
		$newfeed['description'] = $feed->get_description();
		$newfeed['iconurl'] = $feed->get_favicon();
		$newfeed['siteurl'] = $feed->get_permalink();
		$newfeed['feedurl'] = $feedurl;
		
	}
	
	$page['feed'] = $newfeed;
	$page['title'] = 'Add Feed';

	$page['name']= 'feedform';
	
	
}

function deletefeedAction(){
	
	global $db, $site;	
	
	//need to confirm here then delete
	
	$id = $_GET['id'];
	
	$delete = $db->prepare('delete from feed where id = :id');
	$delete->bindValue(':id',$id);
	$delete->execute();
	
	$delete = $db->prepare('delete from item where feedid = :id');
	$delete->bindValue(':id',$id);
	$delete->execute();
	
	header('Location: ' . $site['url'] . '/feeds');
	exit();
	
	
}

function savefeedAction(){
	
	global $db, $site, $page;	
	
	$id = $_POST['id'];
	$title = $_POST['title'];
	$feedurl = $_POST['feedurl'];
	$siteurl = $_POST['siteurl'];
	$iconurl = $_POST['iconurl'];
	$description = $_POST['description'];
	$position = $_POST['position'];
	$private = isset($_POST['private']);
	$active = isset($_POST['active']);
	$folderid = $_POST['folderid'];
	$created = $_POST['created'];
	$lastupdate = $_POST['lastupdate'];
	
	// validation would probably be good here
	
	if($id == 'new'){
	
		$results = $db->prepare("insert into feed values(null, :title, :feedurl, :siteurl, :iconurl, :description,  now(), null, :position, :private, :active, :folderid)");
		$results->bindValue(':title', $title);
		$results->bindValue(':feedurl', $feedurl);
		$results->bindValue(':siteurl', $siteurl);
		$results->bindValue(':iconurl', $iconurl);
		$results->bindValue(':description', $description);
		$results->bindValue(':position', $position);
		$results->bindValue(':private', $private);
		$results->bindValue(':active', $active);
		$results->bindValue(':folderid', $folderid);	
		$results->execute();
	
		header('Location: ' . $site['url'] . '/feeds');
		exit();		
	
	
	} else {
	
		$results = $db->prepare("update feed set title=:title, feedurl=:feedurl, siteurl=:siteurl, iconurl=:iconurl, description=:description, position=:position, private=:private, active=:active, folderid=:folderid where id=:id");
		$results->bindValue(':title', $title);
		$results->bindValue(':feedurl', $feedurl);
		$results->bindValue(':siteurl', $siteurl);
		$results->bindValue(':iconurl', $iconurl);
		$results->bindValue(':description', $description);
		$results->bindValue(':position', $position);
		$results->bindValue(':private', $private);
		$results->bindValue(':active', $active);
		$results->bindValue(':folderid', $folderid);
		$results->bindValue(':id', $id);
		$results->execute();
		
		header('Location: ' . $site['url'] . '/feeds');
		exit();		
	
	}
	
}

// ------------------------------------------------------
// folders

function editfolderAction(){
	
	global $db, $site, $page;	
	
	$id = $_GET['id'];
	
	$results = $db->prepare("select * from folder where id = :id");
	$results->bindParam(':id', $id);
	$results->execute();

	$page['folder'] = $results->fetch();
	$page['title'] = 'Edit Folder';

	$page['name']= 'folderform';

}

function addfolderAction(){
	
	global $site, $page;	
	
	$newfolder = array();
	$newfolder['id'] = 'new';
	
	$page['folder'] = $newfolder;
	$page['title'] = 'Add Folder';

	$page['name']= 'folderform';
	
	
}

function deletefolderAction(){
	
	global $db, $site;	
	
	//need to confirm here then delete
	
	$id = $_GET['id'];
	
	$delete = $db->prepare('delete from folder where id = :id');
	$delete->bindValue(':id',$id);
	$delete->execute();
	
	header('Location: ' . $site['url'] . '/folders');
	exit();
	
	
}

function savefolderAction(){
	
	global $db, $site, $page;	
	
	$id = $_POST['id'];
	$name = $_POST['name'];
	$position = $_POST['position'];
	
	if($id == 'new'){
	
		$results = $db->prepare("insert into folder values(null, :name, :position)");
		$results->bindValue(':name', $name);
		$results->bindValue(':position', $position);
		$results->execute();
	
		header('Location: ' . $site['url'] . '/folders');
		exit();		
	
	
	} else {
	
		$results = $db->prepare("update folder set name=:name, position=:position where id=:id");
		$results->bindValue(':name', $name);
		$results->bindValue(':position', $position);
		$results->bindValue(':id', $id);
		$results->execute();
		
		header('Location: ' . $site['url'] . '/folders');
		exit();		
	
	}
	
}



?>
