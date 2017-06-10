<?php
	session_start();
	error_reporting(0);
		
	include 'content/upisivanjeKomentara.php';
	include 'includes/head.php';
	?>
	<body>
		<div class="wrapper">
			<div class="login">
				<?php
					include 'includes/login.php';
				?>
			</div>
			<div class="header">
				<?php
					include 'includes/header.php';
				?>
			</div>
			<div class="main">
				<div class="pics">
					<?php
						include 'includes/pics.php';
					?>
				</div>
				<div id="news">
					<?php
						include 'includes/vesti.php';
					?>
				</div>
			</div>
			<div class="sadrzaj">
			<div class="left">
				<?php
					include 'includes/leftMenu.php';
					include 'includes/right.php';
				?>
			</div>
			<div class="middle">
				<div class="content">
					<?php
					$id=$_GET['id'];
					if ($id){
					$q = "SELECT * FROM podaci WHERE pod_ID = '$id' ";
					$req = mysql_query($q)
						or die(mysql_error());
					$z = mysql_fetch_assoc($req);
					$tip=$z['tip_unosa'];
					switch ($tip){
						case "vesti":	$link= "vesti.php?id="; $baza="vesti"; break;											
						case "prilog": $link= "prilozi.php?id="; $baza="prilozi"; break;				
						case "dogadjaj": $link= "dogadjaji.php?id="; $baza="vesti"; break;
						case "knjiga": $link= "knjige.php?id=";  $baza="knjige";break;								
						case "nagrada": $link= "nagradaNikolaTesla.php?tip=nagradjeni&id="; $baza="nagrade"; break;
						case "izjava": $link= "poznati.php?id="; $baza="izjave"; break;
						case "patent": $link= "patenti.php?id="; $baza="patenti"; break;
						case "konkurs": $link= "nagradaNikolaTesla.php?tip=konkursi&id="; $baza="nagrade"; break;
						case "projekat": $link= "projekti.php?id="; $baza="projekti"; break;
					}
					$q1 = "SELECT * FROM ".$baza." , podaci WHERE  podaci.pod_ID = '$id' AND ".$baza.".pod_ID = '$id' ";
					
					$rez = mysql_query($q1)
					or die(mysql_error());
					
					echo '<br/>';
					$z = mysql_fetch_assoc($rez);
					
					
					echo "<h1><a class=\"kom_naslov\" href=\"".$link."".$id."\">".$z['naslov']."</a></h1>";
					include 'content/slika_abstrakt.php';
					
						/*if($tip=="prilog"){									
							$query = "SELECT * FROM prilozi WHERE pod_ID = '$id' ";
							$request = mysql_query($query)
								or die(mysql_error());
							$response = mysql_fetch_assoc($request);
							$naslov=$response['naslov'];
							$abstrakt=$response['abstrakt'];
							echo '<h1><a class="kom_naslov" href="prilozi.php?id='.$id.'">'.$naslov.'</a></h1>';
						}			
						if($tip=="vesti"){	
							$query = "SELECT * FROM vesti WHERE pod_ID = '$id' ";
							$request = mysql_query($query)
								or die(mysql_error());
							$response = mysql_fetch_assoc($request);	
							$naslov=$response['naslov'];
							$abstrakt=$response['abstrakt'];
							echo '<h1><a class="kom_naslov" href="vesti.php?id='.$id.'">'.$naslov.'</a></h1>';
						}
						if($tip=="dogadjaj"){
							$query = "SELECT * FROM dogadjaji WHERE pod_ID = '$id' ";
							$request = mysql_query($query)
								or die(mysql_error());
							$response = mysql_fetch_assoc($request);
							$naslov=$response['naslov'];
							$abstrakt=$response['abstrakt'];
							echo '<h1><a class="kom_naslov" href="dogadjaji.php?id='.$id.'">'.$naslov.'</a></h1>';
						}
						
						if($tip=="patent"){
							$query = "SELECT * FROM patenti WHERE pod_ID = '$id' ";
							$request = mysql_query($query)
								or die(mysql_error());
							$response = mysql_fetch_assoc($request);	
							$naslov=$response['naslov'];
							$abstrakt=$response['abstrakt'];
							echo '<h1><a class="kom_naslov" href="patenti.php?id='.$id.'">'.$naslov.'</a></h1>';
						}
						if($tip=="knjiga"){
							$query = "SELECT * FROM knjige WHERE pod_ID = '$id' ";
							$request = mysql_query($query)
								or die(mysql_error());
							$response = mysql_fetch_assoc($request);
							$naslov=$response['naslov'];
							$abstrakt=$response['abstrakt'];
							echo '<h1><a class="kom_naslov" href="knjige.php?id='.$id.'">'.$naslov.'</a></h1>';
						}
						if($tip=="izjava"){
							$query = "SELECT * FROM izjave WHERE pod_ID = '$id' ";
							$request = mysql_query($query)
								or die(mysql_error());
							$response = mysql_fetch_assoc($request);
							$naslov=$response['naslov'];
							$abstrakt=$response['abstrakt'];
							echo '<h1><a class="kom_naslov" href="poznati.php?id='.$id.'">'.$naslov.'</a></h1>';
						}
						if($tip=="nagrada" || $tip=="konkurs"){
							$query = "SELECT * FROM nagrade WHERE pod_ID = '$id' ";
							$request = mysql_query($query)
								or die(mysql_error());
							$response = mysql_fetch_assoc($request);
							$naslov=$response['naslov'];
							$abstrakt=$response['abstrakt'];
							if($tip=="nagrada"){$t="nagradjeni";}
							else if($tip=="konkurs"){$t="konkursi";}
							echo '<h1><a class="kom_naslov" href="nagradaNikolaTesla.php?tip='.$t.'&id='.$id.'">'.$naslov.'</a></h1>';
						}
						if($tip=="projekat"){
							$query = "SELECT * FROM projekti WHERE pod_ID = '$id' ";
							$request = mysql_query($query)
								or die(mysql_error());
							$response = mysql_fetch_assoc($request);
							$naslov=$response['naslov'];
							$abstrakt=$response['abstrakt'];
							echo '<h1><a class="kom_naslov" href="projekti.php?id='.$id.'">'.$naslov.'</a></h1>';
							
						}
						
						
						
						include 'content/datum-autor.php';

						echo "<div class=\"izlistano\"><img style='float:left' class='gl_slikaMenu' src='slike/".$id."_1.jpg' alt='slika'/>";
						echo "<p class='absMenu'>".$abstrakt."</p>";
						
						echo "<div class='clear'></div></div>";

						echo "<hr/>";*/
						

						if ($_COOKIE["slova"]=="cirilica") {
							echo'<span id="pointo" class="naslov">Ваш коментар</span>';
						}
						else{
							echo'<span id="pointo" class="naslov">Vaš komentar</span>';
						}
						if(isset($_SESSION['valid_user'])){
						echo '<form  action="'.$link.'&kom=1" method="post" >';
						$komentarID=$_GET['komentarID'];
						if($komentarID){
							$query = "SELECT * FROM komentari WHERE kom_id = '$komentarID' ";
							$request = mysql_query($query)
								or die(mysql_error());
							$response = mysql_fetch_assoc($request);
							$text=$response['tekst'];
						}
						echo'<p>
							<span id="upozor" style="color:#C11B17;"></span>
							<p><textarea style="width:60%;" rows="7" id="komentar" name="komentar" >'.$text.'</textarea></p><br/>';
							if($komentarID){
								if ($_COOKIE["slova"]=="cirilica") {
									echo'<input type="submit" class="dugme" name="promena_komentara" value="Сачувај измене" onclick="return provera_komentar()"/>  ';
									echo'<input type="button" class="dugme" value="Одустани" onclick="Mojikomentari()">
									<input type="hidden" value="'.$komentarID.'" name="komentar_id" />';
								}
								else{
									echo'<input type="submit" class="dugme" name="promena_komentara" value="Sačuvaj izmene" onclick="return provera_komentar()"/>  ';
									echo'<input type="button" class="dugme" value="Odustani" onclick="Mojikomentari()">
									<input type="hidden" value="'.$komentarID.'" name="komentar_id"  />';
								}
							}
							else{
								if ($_COOKIE["slova"]=="cirilica") {
									echo'<input type="submit" class="dugme" name="poslat_komentar" value="Пошаљи коментар" onclick="return provera_komentar()"/>';
								}
								else{
									echo'<input type="submit" class="dugme" name="poslat_komentar" value="Pošalji komentar" onclick="return provera_komentar()"/>';
								}
							}
							
							//<input type="hidden" value="'.$id.'" name="id" />
							echo'			
							</p><br/>			
							</form>';
						}
						else{ 		
							include 'content/logovanje.php';
						}
							//include 'content/komentari.php';
						}
						function getUrl() {
						  $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
						  $url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
						  $url .= $_SERVER["REQUEST_URI"];
						  return $url;
						}
						$url= getUrl();
						
					?>
				</div>
			</div>
			</div>
	

			
			<div class="footer">
				<?php
					include 'includes/footer.php';
				?>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
		<?php
			if(!isset($_SESSION['valid_user'])) echo '<script type="text/javascript" src="javascript/login.js"></script>';
		?>
		<script type="text/javascript" src="javascript/submenu.js"></script>
		<script type="text/javascript" src="javascript/slideShow.js"></script>
		<script type="text/javascript" src="javascript/scrool.js"></script>
		<script type="text/javascript" src="javascript/verticalmenu.js"></script>
		<script type="text/javascript" src="javascript/komentari.js"></script>
		<script type="text/javascript">
			
			skrol();
			
			function Mojikomentari(){
				window.location="mojikomentari.php";
			}
		</script>

		<script type="text/javascript">			
		    		//scroll to the specific div, assuming each div is named "div_(number)"
			function scrollToID(ele) 
			{
				//document.getElementById("pointo").scrollIntoView();
				 $(window).scrollTop(ele.offset().top).scrollLeft(ele.offset().left);
			}
		 
			//var id = getUrlVars()["id"];	
			window.onload=scrollToID($('#pointo'));
		</script>

	</body>
</html>
