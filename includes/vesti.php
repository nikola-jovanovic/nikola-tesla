<div id="news">
	<?php
		// ispis vesti u main divu koji skroluje
		$articles = $dbh->getList(array(
			'type' => 'news',
			'published' => true
			));
		echo '<marquee scrollamount="1" direction="up" loop="true" height="260px" onmouseover="this.stop();" onmouseout="this.start();">';
		foreach($articles['news'] as $news ){
			$naslov = str_replace(' ','-',$news->get('title'));
			echo '<p class="naslov"><a class="lista" href="vesti/'.$news->get('id').'/'.$naslov.'">'.$news->get('title').'</a></p>';
			echo '<p class="datum_vesti">'.$news->get('date').'</p><br/>';
			echo "<p>".$news->get('summary')." <a class='vise' href='vesti/".$news->get('id')."/$naslov'>";
			if ($_COOKIE["slova"]=="cirilica") {echo 'Више';} else{'Više';} echo "...</a></p><br/><hr/>";
		}
		echo "</marquee>";	
	?>
</div>