<?php
	session_start();
	error_reporting(0);
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
			<div class="left">
				<?php
					include 'includes/leftMenu.php';
					include 'includes/right.php';
				?>
			</div>
			<div class="middle">
				<div class="content">
						<?php
							$user = $_SESSION['valid_user'];
							if(isset($_GET['sort']))$sort = $_GET['sort'];
							else $sort = 'datum DESC';
							$strana=isset($_REQUEST['strana']) ? $_REQUEST['strana'] : 1;
							$start=($strana-1)*10;
							$end=($strana)*10;
							echo ($_COOKIE["slova"] == "cirilica") ? '<h1>Моји коментари</h1>' : '<h1>Moji komentari</h1>';
							echo '<p style="text-align:right; margin: 0px 10px 20px 0px;">';
							echo ($_COOKIE["slova"] == "cirilica") ? 'Сортирај по:&nbsp' : 'Sortiraj po:&nbsp';
							echo '<select class="sort"><option ';
							if($sort == 'tekst ASC') echo 'selected="selected"';
							echo ($_COOKIE["slova"] == "cirilica") ? 'value="1">Тексту коментара</option>
										    <option ' : 'value="1">Tesktu komentara</option>
										    <option ';
							if($sort == 'datum DESC') echo 'selected="selected"';
							echo ($_COOKIE["slova"] == "cirilica") ? 'value="3">Датуму</option>
										    <option ' : 'value="3">Datumu</option>
										    <option ';
							if($sort == 'plusevi DESC') echo 'selected="selected"';
							echo ($_COOKIE["slova"] == "cirilica") ? 'value="4">Like</option><option ' : 'value="4">Like</option><option ';
							if($sort == 'minusevi DESC') echo 'selected="selected"';
							echo ($_COOKIE["slova"] == "cirilica") ? 'value="5">Unlike</option></select></p>' : 'value="5">Unlike</option></select></p>';
							echo '<div class="kontejner" style="overflow:auto"><form name="form1" onsubmit="return checkRadios(this.box)" action="obrada.php?strana='.$strana.'&page='.$page.'" method="post"><table class="azuriraj"><tr>';
							if ($_COOKIE["slova"]=="cirilica") {
								echo '<th></th><th>Текст коментара</th><th>Наслов материјала</th><th>Датум</th><th><span id="likee_267"></span><input id="like_267" style="width:24px;height:24px" class="like" type="button"></input></th><th><span id="unlikee_267"></span><input id="unlike_267" style="width:24px;height:24px" class="unlike" type="button"></input></th></tr>';
							}
							else{
								echo '<th></th><th>Tekst komentara</th><th>Naslov materijala</th><th>Datum</th><th><span id="likee_267"></span><input id="like_267" style="width:24px;height:24px" class="like" type="button"></input></th><th><span id="unlikee_267"></span><input id="unlike_267" style="width:24px;height:24px" class="unlike" type="button"></input></th></tr>';
							}
							$query = "SELECT COUNT(*) FROM komentari WHERE korisnik = '".$user."'";
							$result = mysql_query($query);
							$ukupno = mysql_result($result, 0, 0);
							if ($ukupno!=0){
								$broj_strana=$ukupno/10;	
								if(!is_int($broj_strana)){
							   		$broj_strana=intval($broj_strana)+1;
								}
							}
							else $broj_strana=0;

							$query = "SELECT * FROM komentari WHERE korisnik = '".$user."' ORDER BY ".$sort." LIMIT $start, 10";
							$result = mysql_query($query);
							$br = 1;
							$ids=array();
							while ($z= mysql_fetch_array($result)){
								$id = $z['pod_ID'];
								$kom_id = $z['kom_id'];
								if ($z['nivo'] != 0) {
									$ids[] = $z['nivo'];
								}
								$query = "SELECT tip_unosa FROM komentari,podaci WHERE komentari.korisnik = '".$user."' AND kom_id = ".$kom_id." AND komentari.pod_ID = podaci.pod_ID";
								$result1 = mysql_query($query);
								$za= mysql_fetch_array($result1);
								$tip_unosa = $za['tip_unosa'];
								switch ($tip_unosa){
									case "vesti":	$link= "vesti.php?id="; $baza="vesti"; break;											
									case "prilog": $link= "prilozi.php?id="; $baza="prilozi"; break;				
									case "dogadjaj": $link= "dogadjaji.php?id="; $baza="dogadjaji"; break;
									case "knjiga": $link= "knjige.php?id=";  $baza="knjige";break;								
									case "nagrada": $link= "nagradaNikolaTesla.php?tip=nagradjeni&id="; $baza="nagrade"; break;
									case "izjava": $link= "poznati.php?id="; $baza="izjave"; break;
									case "patent": $link= "patenti.php?id="; $baza="patenti"; break;
									case "konkurs": $link= "nagradaNikolaTesla.php?tip=konkursi&id="; $baza="nagrade"; break;
									case "projekat": $link= "projekti.php?id="; $baza="projekti"; break; 		
								}
								$query = "SELECT naslov FROM ".$baza.", komentari WHERE komentari.korisnik = '".$user."' AND kom_id = ".$kom_id." AND komentari.pod_ID = ".$baza.".pod_ID";
								$result2 = mysql_query($query);
								$za1= mysql_fetch_array($result2);
								if(($br%2) == 0)echo '<tr class="par">';
								else echo '<tr class="nepar">';
								echo '<td><input type="radio" name="box" value='.$z['kom_id'].' /><span style="display:none">'.$id.'</span></td>';
								echo '<td><a class="profil_link" href="'.$link.$id.'&kom=1">'.$z['tekst'].'</a></td><td><a class="link" href="'.$link.$id.'">'.$za1['naslov'].'</a></td><td >'.$z['datum'].'</td><td style="text-align:center">'.$z['plusevi'].'</td><td style="text-align:center">'.$z['minusevi'].'</td></tr>';
								$br++;
							}
							echo '</table><br/>';
							if ($broj_strana>1){	
								echo '<span style="float:right; font-size:13px;">';
								if ($strana!=1) {
									$a=$strana-1;
									echo "<a href='mojikomentari.php?strana=$a&sort=$sort'><img class=\"strelica\" src=\"images/left_arrow.png\"/></a>";
								}
								else{echo '';}
								for ($p=1; $p<=$broj_strana; $p++){
									if($broj_strana == '1')break;
									echo "<span class='broj_strane";
									if ($strana==$p) echo"_trenutna";
									echo "'><a href='mojikomentari.php?strana=$p&sort=$sort'>".$p;
									if ($limiter==29) {
										echo '<br />';
										$limiter=0;
									}
									$limiter++;
									echo '</a></span>';
								}
								if ($strana!=$broj_strana) {
									$b=$strana+1;
									echo "<a href='mojikomentari.php?strana=$b&sort=$sort'><img class=\"strelica\" src=\"images/right_arrow.png\"/></a>";
								}
								else{echo '';}
								echo '</span><br/><br/>';
							}
							if ($_COOKIE["slova"]=="cirilica") {
									echo '<input type="button" class="dugme" name="azuriraj_kom" value="Ажурирај текст"/>&nbsp
										<input type="button" class="dugme" onclick="OnKlik()" name="obrisi_kom" value="Обриши"/></form></div>';
								}
								else{
									echo '<input type="button" class="dugme" name="azuriraj_kom" value="Ažuriraj tekst"/>&nbsp
										<input type="button" class="dugme" onclick="OnKlik()" name="obrisi_kom" value="Obriši"/></form></div>';
								}
						?>
					<form>
				</div>
			</div>
			<div class="right">
			</div>
			<div class="footer">
				<?php
					include 'includes/footer.php';
				?>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<?php
			if(!isset($_SESSION['valid_user'])) echo '<script type="text/javascript" src="javascript/login.js"></script>';
		?>
		<script type="text/javascript" src="javascript/submenu.js"></script>
		<script type="text/javascript" src="javascript/slideShow.js"></script>
		<script type="text/javascript" src="javascript/scrool.js"></script>
		<script type="text/javascript" src="javascript/verticalmenu.js"></script>
		<script type="text/javascript" src="javascript/responsive.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$(document).on('change','.sort',function(){
				  	var tip = "<?php if ($tip == 'događaj'){$tip = 'dogadjaj';} echo $tip; ?>";
				    if($('.sort').val() == 1)$('.kontejner').load('content/AJAXkomentari.php?type=' + tip + '&sort=tekst+ASC');
				    if($('.sort').val() == 3)$('.kontejner').load('content/AJAXkomentari.php?type=' + tip + '&sort=datum+DESC');
				    if($('.sort').val() == 4)$('.kontejner').load('content/AJAXkomentari.php?type=' + tip + '&sort=plusevi+DESC');
				    if($('.sort').val() == 5)$('.kontejner').load('content/AJAXkomentari.php?type=' + tip + '&sort=minusevi+DESC');
				 });

				$(document).on('click','input[name="azuriraj_kom"]',function(){
					if(!checkRadios(form1.box)) return false;
					<?php
						$js_array = json_encode($ids);
						echo "var ids = ". $js_array . ";";
					?>
					var kom_id;
					var id;
					var radios = document.getElementsByName('box');
					for (var i = 0, length = radios.length; i < length; i++) {
					    if (radios[i].checked){
							if(ids.indexOf(radios[i].value) != -1){  
							   alert('Komentar ima podkomentar. Ne možete ga ažurirati.');
							   return false;
							}
							kom_id = radios[i].value;
							id = radios[i].nextSibling.innerHTML;
					    }
					}
					var string_url = "komentari.php?id="+ id + "&komentarID=" + kom_id;		
					document.form1.action = string_url;
					document.form1.submit();
				});
			});
			function OnKlik(){
				var tip = "<?php if ($tip == 'događaj'){$tip = 'dogadjaj';} echo $tip; ?>";
				var strana = "<?php echo $strana; ?>";
				var page = "<?php echo $fileName; ?>";
				if(!checkRadios(form1.box)) return false;
				<?php
					$js_array = json_encode($ids);
					echo "var ids = ". $js_array . ";";
				?>
				var radios = document.getElementsByName('box');
				for (var i = 0, length = radios.length; i < length; i++) {
				    if (radios[i].checked){
						if(ids.indexOf(radios[i].value) != -1){  
						   alert('Komentar ima podkomentar. Ne možete ga obrisati.');
						   return false;
						}
				    }
				}
				var r = confirm("Da li ste sigurni da želite da obrišete?");
				if (r == true){
  					<?php
						echo 'var string_url = "obrada.php?strana="+ strana + "&obrisi_kom=1&page=" + page;';
						echo'	document.form1.action = string_url;
							document.form1.submit();
						';
					?>	
  				}
				else{
  					return false;
  				}
			}
		</script>
	</body>
</html>