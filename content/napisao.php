<?php
	if($user->get('c_about')){
	 	if ($_COOKIE["slova"]=="cirilica") {
			echo "<br/><br/><hr/><p style='margin-top:15px;' class='text1'><b>";
	 		if($article->get('source')!=""){
				if($user->get('gender') == 'm') echo 'Приложио:';
				else echo 'Приложила:';
			}
			else{
				if($user->get('gender') == 'm') echo 'Написао:';
				else echo 'Написала:';
			}
	 		echo "</b> ".$user->get('about')."</p>";
		}
		else{
			echo "<br/><br/><hr/><p style='margin-top:15px;' class='text1'><b>";
		 	if($article->get('source')!=""){
				if($user->get('gender') == 'm') echo 'Priložio:';
				else echo 'Priložila:';
			}
			else{
				if($user->get('gender') == 'm') echo 'Napisao:';
				else echo 'Napisala:';
			}
	 		echo "</b> ".$user->get('about')."</p>";
		}
 	}

?>