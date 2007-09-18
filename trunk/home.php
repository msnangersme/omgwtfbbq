<?php
	
	$results = $db->query("SELECT item.id, item.title as itemtitle, linkurl, feed.siteurl, feed.title as feedtitle, item.author, item.pubdate, item.content, item.enclosureurl from item, feed, folder where item.feedid = feed.id and feed.folderid = folder.id and item.unread = 1 ORDER BY folder.position, feed.position, item.pubdate desc limit 25");
	
	$folders = $db->query("select folder.name, count(item.id) as unread from item, feed, folder where unread=1 and item.feedid = feed.id and feed.folderid = folder.id group by folder.name order by folder.position");
	
?>
<div class="unread">
Unread: 
<? foreach($folders as $folder){ ?>
<?=$folder['name']?> (<?=$folder['unread']?>)&nbsp;
<? } ?>
</div>
<? 
	
	$itemid = array();

	$oldname = '';

	foreach($results as $row){ 
	
		$name = $row['feedtitle'];
		
		if($name != $oldname){
			
			echo '<h2 class="feedtitle">' . $name . '</h2>' . "\n";
			
			$oldname = $name;
			
		}	
	
	$itemid[] = $row['id'];
	
?>
  <div class="entry">
    <h3 class="entrytitle"> <a href="<?=$row['linkurl']?>" rel="bookmark">
      <?=$row['itemtitle']?>
      </a> </h3>
 
    <div class="entrymeta"> 
    <a href="<?=$row['siteurl']?>"><?=$row['feedtitle']?></a> - Posted <?=date('F j, Y g:i a', strtotime($row['pubdate'])) ?> 
    <? if($row['author']){ echo 'by ' . $row['author']; } ?>
    </div>

<?if($row['enclosureurl']){ ?>
    <div class="entrybody"> 
	Enclosure: <a href="<?=$row['enclosureurl']?>"><?=$row['enclosureurl']?></a>
	</div>
<? } ?>
    
    <div class="entrybody">
      <?=formatContent($row['content'])?>
    </div>

  </div>

<?	
	}
?>

<? 
	if($itemid){
?>
  <p id="bottomnav">
  	<form method="post" action="<?=$site['url']?>/markread" id="markreadform">
  	<input type="hidden" name="items" value="<?=join(',', $itemid)?>"/>
  	<input type="submit" name="submit" value="Mark Page Read" id="markreadbutton"/>
	</form>
  </p>
<? } else { ?><div class="entry">
<h3 class="entrytitle">No new feeds</h3>
</div>


<? } ?>

