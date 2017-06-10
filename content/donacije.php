				<?php
				$tip=$_GET['tip'];
				$project_id=$_GET['projekat_id'];
				if($tip=="donacija" && $project_id){
					include 'content/donacije_opcije.php';
				}
				else{
				if ($_COOKIE["slova"]=="cirilica") {
					echo'<h1>Донације</h1>
					<p class="tekst"> Сваки наш пројекат је јединствен и за љубитеље света науке занимљив.
					Уколико сте Ви један од оних којима се наши пројекти свиђају и уколико желите да донирате новац за неки 
					од текућих пројеката или оних што имамо у плану да реализујемо, можете то учинити на овој страни. 
					Донирајте новац за Друштво или за пројекат који се Вама допада.
					</p><br/>';
				}
				else{
					echo'<h1>Donacije</h1>
					<p class="tekst"> Svaki naš projekat je jedinstven i za ljubitelje sveta nauke zanimljiv.
					Ukoliko ste Vi jedan od onih kojima se naši projekti sviđaju i ukoliko želite da donirate novac za neki 
					od tekućih projekata ili onih što imamo u planu da realizujemo, možete to učiniti na ovoj strani. 
					Donirajte novac za Društvo ili za projekat koji se Vama dopada.
					</p><br/>';
				}
				echo'<form method="get">';
				
				//ispis projekata za koje može da se donira novac
				echo "<input type=\"radio\" checked=\"checked\" value=\"drustvo\" name=\"projekat_id\"/>&nbsp";
				if ($_COOKIE["slova"]=="cirilica") {
					echo "<a class=\"lista\" href=\"#\" >За Друштво Никола Тесла</a>";
					echo '<p class="naslov"> Пројекти:</p>';
				}
				else{
					echo "<a class=\"lista\" href=\"#\" >Za Društvo Nikola Tesla</a>";
					echo '<p class="naslov"> Projekti:</p>';
				}
				
				$today= date ("Y-m-d");
				$upit = "SELECT * FROM projekti  WHERE kraj_datum >= '$today' 
				ORDER BY start_datum DESC";
				$rezultat = mysql_query($upit)
				or die(mysql_error());
				while ($zapis = mysql_fetch_assoc($rezultat)) {
					$project_id = $zapis['pod_ID'];
					
					echo "<input type=\"radio\" value=\"".$project_id."\" name=\"projekat_id\"/>&nbsp";
					$naziv=$zapis['naslov'];
					$naslov = str_replace(' ','-',$naziv);
					echo "<a class=\"lista\" href=\"projekti/$project_id/$naslov\" >".$naziv."</a>";
					echo "<br/>";
					}
				
				echo "<br/><br/><p><input type=\"hidden\" name =\"tip\" value=\"donacija\"/>";
				if ($_COOKIE["slova"]=="cirilica") { echo"<input type=\"submit\"  class=\"dugme\" value=\"Донирај\"/></p>";}
				else{echo"<input type=\"submit\" name =\"donacija\" class=\"dugme\" value=\"Doniraj\"/></p>";}
				echo"</form><br/>"; 
			}
			?>	
