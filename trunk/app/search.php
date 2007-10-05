<?php 

	$page['title'] = 'Search';

	$q = $_GET['q'];

?>

<div class="entry">
    
	<h3 class="entrytitle">Search</h3>
	<div class="entrybody">

<form method="get" action="<?=$site['url']?>/search" id="searchform" >
<input type="text" value="<?=htmlentities(stripslashes($q))?>" name="q" id="q" />
<input type="submit" id="searchsubmit" value="Search" />
</form>
<br/>
<?php


		if($_GET){   
		   
			$results = $db->prepare("select feed.title as feedtitle, item.title, item.linkurl from item, feed where item.feedid = feed.id and match(item.title, content) against(:query) order by item.pubdate desc limit 20");
			$results->bindValue(':query', $q);
			$results->execute();	
			if($results){
				echo '<ul>' . "\n";
				foreach($results as $row){
				
					echo '<li>' . $row['feedtitle'] . ' - <a href="' . $row['linkurl'] . '">' . $row['title'] . '</a></li>' . "\n";
				
				}
				echo '</ul>';
				
			} else {
				echo '<p>No results found</p>' . "\n";
			}
			
			

		} else {
			echo '<p>Enter a search term above, or refine your search to see more results.</p>';
		}
?>
	</div>
</div>


