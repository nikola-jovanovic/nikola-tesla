<?php
	session_start();
	error_reporting(0);
	include 'includes/head.php';
	include 'includes/brisanje.php';
?>
<script>
		(function($){
			$(window).load(function(){
				var proba=checkCookie();
				if (proba){
					$('a, p, span:not(:has(a)), li:not(:has(a)), h1, h2, h3, tr, legend').each(function(index) {	
						var text = $(this).html();
						text = latUcir_saLinkovima(text);
						$(this).html(text);
					});
				
				}
												
			});
		})(jQuery);
	</script>
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
						if(isset($_GET['tip'])){// u zavisnosti od tipa, prikazi odgovarajucu formu za unos materijala
							$tip = $_GET['tip'];//id koji oznacava da li je u pitanju vest, prilog...
							$ID = $_GET['id'];//id u bazi podataka
							$IDp=0;
							if( $tip == 'prilog')	$IDp == '1';
							elseif($tip == 'vesti') $IDp == '2';
							elseif($tip == 'dogadjaj' || $tip == 'događaj') $IDp == '3';	
							elseif($tip == 'patent')  $IDp == '6';
							elseif($tip == 'izjava') $IDp == '2';
							elseif($tip == 'knjiga') $IDp == '5';
							elseif($tip == 'nagrada') $IDp == '7';
							elseif($tip == 'projekat') $IDp == '8';
							elseif($tip == 'pravni_akt') $IDp == '9';
							$user = $_SESSION['valid_user'];
							if($user){							
								$query = "SELECT * FROM korisnici WHERE korisnik = '$user'";
								$result = mysql_query($query);
								$br_rezultata = mysql_num_rows($result);
								$red = mysql_fetch_array($result);
								$priv = explode(',', $red['privilegija']);
								$provera=0;
								for($i=0; $i < count($priv); $i++ ){
									if($priv[$i]==$IDp) $provera=1;							
								}
								if($provera==1){
									echo '<form name="form1" action="" method="post" enctype="multipart/form-data" >';
									if ($tip != 'pravni_akt'){
									if( $tip == 'prilog' || $tip == 'vesti' || $tip == 'dogadjaj' || $tip == 'događaj' || $tip == 'patent'  ){// forma za unos vesti, dogadjaja, patenta, pronalaska, izjave i priloga
									if ($tip == 'dogadjaj'){$tip = 'događaj';}
									echo'
										<h1>Unesi 
										'.$tip.'</h1><br/>';					
									if (isset($_GET['id'])){
										if($tip=="vesti"){	
											$query = "SELECT * FROM vesti WHERE pod_ID = '$ID'";
											$result = mysql_query($query);
										}
										if($tip=="događaj"){
											$query = "SELECT * FROM dogadjaji WHERE pod_ID = '$ID'";
											$result = mysql_query($query);
										}
										if($tip=="prilog"){
											$query = "SELECT * FROM prilozi WHERE pod_ID = '$ID'";
											$result = mysql_query($query);
										}
										if($tip=="patent"){
											$query = "SELECT * FROM patenti WHERE pod_ID = '$ID'";
											$result = mysql_query($query);
										}
										$record = mysql_fetch_assoc($result);
										$naslov=$record['naslov'];
										$abstrakt=$record['abstrakt'];
										$projekat=$record['projekat_id'];
										
										$query1 = "SELECT * FROM podaci WHERE pod_ID = '$ID'";
										$result1 = mysql_query($query1);
										$record1 = mysql_fetch_assoc($result1);
										$dupli_unos=$record1['dodatno'];
									}
									echo'<p>Naslov </p>
										
										<p><input type="text" style="width:60%;" name="naslov" value="'.$naslov.'"/><span style="color:#C11B17;" id="naslov"></span></p>
										<br/>';
										if($tip=="vesti"){
										echo'<p>Unesi vest i kao događaj?  <span style="white-space: nowrap;"><input type="radio" name="dupli_unos" '; if($dupli_unos){echo 'checked="checked"';} echo' checked="checked" value="1">Da  <input type="radio" name="dupli_unos" '; if(!$dupli_unos){echo 'checked="checked"';} echo 'value="0">Ne </span></p><br/>';
										echo'<p><input type="checkbox" name="check" id="myCheck"'; if($projekat!=0){echo 'checked="checked"';}echo' />Projekat</p>
										<select name="proj">';
										$p="projekat";
										$query = "SELECT * FROM podaci WHERE tip_unosa='$p' AND odobren='1'";
										$result = mysql_query($query);
										while ($za = mysql_fetch_assoc($result)) {
											$k=$za['pod_ID'];									
											$q = "SELECT * FROM projekti WHERE pod_ID='$k'";
											$r = mysql_query($q);	
											$z = mysql_fetch_assoc($r);
											echo '<option value="'.$k.'"';if($projekat==$k){echo 'selected="selected"';}echo'>'.$z['naziv'].'</option>';
										}
										echo'</select><br/><br/>';
										}
										
										if($tip=="događaj"){
										echo'<p>Unesi događaj i kao vest?  <span style="white-space: nowrap;"><input type="radio" name="dupli_unos" '; if($dupli_unos){echo 'checked="checked"';} echo' checked="checked" value="1">Da  <input type="radio" name="dupli_unos" '; if(!$dupli_unos){echo 'checked="checked"';} echo 'value="0">Ne </span></span></p><br/>';
										}
										echo'
										<p>Abstrakt </p>
										
										<p><textarea style="width:60%;" rows="5"  name="abstrakt" >'.$abstrakt.'</textarea><span style="color:#C11B17;" id="abstrakt"></span></p>
										<br/> 
										
										';
									}
									elseif($tip == 'izjava'){// forma za unos izjave
										$query = "SELECT * FROM izjave WHERE pod_ID = '$ID'";
											$result = mysql_query($query);
										$record = mysql_fetch_assoc($result);
										$naslov=$record['naslov'];
										$abstrakt=$record['abstrakt'];
										$autor=$record['o_autoru'];
										echo'<h1>Unesi 
										izjavu</h1>	<br/>				
											
										<p>Naslov </p>
										
										<p><input style="width:60%;" type="text" name="naslov" value="'.$naslov.'"/><span style="color:#C11B17;" id="naslov"></span></p>
										<br/> 		
										
										<p>Abstrakt </p>
										<p><textarea style="width:60%;" rows="5" name="abstrakt" >'.$abstrakt.'</textarea><span style="color:#C11B17;" id="abstrakt"></span></p>
										<br/> 
										
										<p>O autoru izjave</p>
										<p><span style="color:#C11B17;"></span></p>
										<p><textarea  style="width:60%;" rows="5" name="o_autoru" >'.$autor.'</textarea></p>
										<br/> 
													
										';
									}
									elseif($tip == 'knjiga'){// forma za unos knjige
										$query = "SELECT * FROM knjige WHERE pod_ID = '$ID'";
											$result = mysql_query($query);
										$record = mysql_fetch_assoc($result);
										$naslov=$record['naslov'];
										$abstrakt=$record['abstrakt'];
										$o_autoru=$record['o_autoru_knjige'];
										$autor=$record['autor_knjige'];
										$slika_autor=$record['slika_autor'];
										$naslov_slike_autor=$record['naslov_slike'];
									echo'<h1>Unesi 
										knjigu</h1>	<br/>				
											
										<p>Naslov </p>
										
										<p><input style="width:60%;" type="text" name="naslov" value="'.$naslov.'"/><span style="color:#C11B17;" id="naslov"></span></p>
										<br/> 		
										<p>Abstrakt </p>
										<p><textarea style="width:60%;" rows="5"  name="abstrakt" >'.$abstrakt.'</textarea><span style="color:#C11B17;" id="abstrakt"></span></p>
										<br/> 							
										<p>Autor knjige</p>
										<p><span style="color:#C11B17;"></span></p>
										<p><input type="text" name="autor" value="'.$autor.'"/></p>
										<br/> 
										<p>O autoru knjige</p>
										<p><span style="color:#C11B17;"></span></p>
										<p><textarea  style="width:60%;" rows="5" name="o_autoru" ">'.$o_autoru.'</textarea></p>
										<br/> ';
										if($_GET['id']){
										echo'<p>Slika autora </p>
										<p><span style="color:#C11B17;" id="slika_autor"></span></p>';
										echo '<p><img class="gl_slikaMenu" src="slike/'.$slika_autor.'" alt="slika"/></p>
											<p><input type="hidden" name="slika_autor_promena"   />Promeni sliku</p>
											<p><input type="file" name="slika_autor" value="Promeni"/></p><br/> ';
										echo'
										<p>Naslov slike autora</p>
										<p><span style="color:#C11B17;" id="naslov_slika_autor"></span></p>
										<p><input type="text" style="width:60%;" name="naslov_autor" value="'.$naslov_slike_autor.'"/></p>
										<br/>';
										}
										else{
										echo'<p>Slika autora </p>
										<p><span style="color:#C11B17;" id="slika_autor"></span></p>
										<p><input type="file" name="slika_autor" /></p><br/> ';
										echo'
										<p>Naslov slike autora</p>
										<p><span style="color:#C11B17;" id="naslov_slika_autor"></span></p>
										<p><input type="text" style="width:60%;" name="naslov_autor" /></p>
										<br/>';
										}
										
										
									}
									elseif($tip == 'nagrada'){// forma za unos nagrade
										$query = "SELECT * FROM nagrade WHERE pod_ID = '$ID'";
										$result = mysql_query($query);
										$record = mysql_fetch_assoc($result);
										$naslov=$record['naslov'];
										$godina=$record['godina'];
										$tip_nagrade=$record['tip_nagrade'];
										$nagradjeni=$record['nagradjeni'];
										$komisija=$record['komisija'];
										$abstrakt=$record['abstrakt'];
										$query = "SELECT * FROM podaci WHERE pod_ID = '$ID'";
											$result = mysql_query($query);
										$record = mysql_fetch_assoc($result);
										$tip_nagrada=$record['tip_unosa'];
									echo'<h1>Unesi 
										nagradu</h1><br/>
										
										<p>Naslov </p>
										<p><input style="width:60%;" type="text" name="naslov" value="'.$naslov.'"/><span style="color:#C11B17;" id="naslov"></p>
										<br/> 										
										
										<p><input type="radio" name="nagrada"'; if($tip_nagrada=="nagrada"){echo 'checked="checked"';} echo' checked="checked" value="nagrada">Nagrađeni<br/>
											<input type="radio" name="nagrada"'; if($tip_nagrada=="konkurs"){echo 'checked="checked"';} echo' value="konkurs">Konkurs
										</p>	
										<br/> 	
										
										<p>Abstrakt </p>
										<p><textarea style="width:60%;" rows="5" name="abstrakt" >'.$abstrakt.'</textarea><span style="color:#C11B17;" id="abstrakt"></p>
										<br/> 			
										';
									}
									elseif ($tip == 'projekat'){
									$query = "SELECT * FROM projekti WHERE pod_ID = '$ID'";
											$result = mysql_query($query);
										$record = mysql_fetch_assoc($result);
										$naslov=$record['naziv'];
										$pocetak=$record['start_datum'];
										$zavrsetak=$record['kraj_datum'];
										$suma=$record['zahtevana_suma'];
										$abstrakt=$record['abstrakt'];
									echo'<h1>Unesi 
										projekat</h1>	<br/>				
											
										<p>Naslov projekta </p>
										<p><input style="width:60%;" type="text" name="naslov" value="'.$naslov.'"/><span style="color:#C11B17;" id="naslov"></span></p>
										<br/>
										<p>Datum početka projekta (gggg-mm-dd) </p>
										<p><span style="color:#C11B17;"></span></p>
										<p><input type="text" name="pocetak" value="'.$pocetak.'"/></p>
										<br/> 	
										<p>Datum završetka projekta (gggg-mm-dd) </p>
										<p><span style="color:#C11B17;"></span></p>
										<p><input type="text" name="zavrsetak" value="'.$zavrsetak.'"/></p>
										<br/> 	
										<p>Potrebna suma novca</p>
										<p><span style="color:#C11B17;"></span></p>
										<p><input type="text" name="suma" value="'.$suma.'"/></p>
										<br/> 
																		
										<p>Abstrakt </p>
										<p><textarea style="width:60%;" rows="5" name="abstrakt" >'.$abstrakt.'</textarea><span style="color:#C11B17;" id="abstrakt"></span></p>
										<br/>';	
										
									}
									if($_GET['id']){
									$query1 = "SELECT * FROM text WHERE pod_ID = '$ID'";
											$result1 = mysql_query($query1);
										$record1 = mysql_fetch_assoc($result1);
										$text=$record1['tekst'];
										$slike=$record1['slike'];
										$naslov_slike=$record1['naslov_slike'];
										$podnaslov=$record1['podnaslov'];
										
										$text = explode('!@!', $text);
										$slike = explode('!@!', $slike);
										$naslov_slike = explode('!@!', $naslov_slike);
										$podnaslov = explode('!@!', $podnaslov);
										$p=0;
										
										for($i=0; $i < count($slike); $i++ ){	
												if($slike[$i] != NULL){ 
												echo '<div id="brisanje_s'.$i.'">';
												echo'
												<div class="slika11"><p>Slika   <input type="button" class="delete" onclick="Brisanje(\'brisanje_s'.$i.'\');"'; if ($_COOKIE["slova"]=="cirilica") {echo'value="Обриши слику"';} else{echo' value="Оbriši sliku"';} echo '/></p>
												<p><span style="color:#C11B17;"></span></p>
												<p><img class="gl_slikaMenu" src="slike/'.$slike[$i].'" alt="slika"/></p>
												<p><input type="hidden" name="promena[]" id="myCheck" value="'.$slike[$i].'"/>Promeni sliku</p>
												<p><input type="file" name="slika_nova[]" /></p><br/> 
												<p>Naslov slike</p>
												<p><span style="color:#C11B17;"></span></p>
												<p><input type="text" style="width:60%;" name="naslov_slike[]" value="'.$naslov_slike[$i].'"/></p>
												<br/></div>';
												
												echo'
												<div class="text11" style="display:none;"><p>Tekst</p>
												<p><span style="color:#C11B17;"></span></p>
												<p ><textarea style="width:60%;" rows="10" name="text[]"></textarea></p>
												<br/></div>'; 
												
												echo'
												<div class="naslov11" style="display:none;"><p>Podnaslov</p>
												<p><span style="color:#C11B17;"></span></p>
												<p ><input type="text" style="width:60%;" name="podnaslov[]" value=""/></p>
												<br/></div>';
												
												
												echo '</div>';
												
												}
												
												if($text[$i] != NULL){
												echo '<div id="brisanje_t'.$i.'">';
												echo'
												<div class="slika11" style="display:none;"><p>Slika    </p>
												<p><span style="color:#C11B17;"></span></p>
												
												<p><input type="hidden" name="promena[]" id="myCheck" value=""/>Promeni sliku</p>
												<p><input type="file" name="slika_nova[]" /></p><br/> 
												<p>Naslov slike</p>
												<p><span style="color:#C11B17;"></span></p>
												<p><input type="text" style="width:60%;" name="naslov_slike[]" value=""/></p>
												<br/></div>';
												
												echo'
												<div class="text11" ><p>Tekst   <input type="button" class="delete" onclick="Brisanje(\'brisanje_t'.$i.'\');" '; if ($_COOKIE["slova"]=="cirilica") {echo'value="Обриши текст"';} else{echo' value="Оbriši tekst"';} echo ' /></p>
												<p><span style="color:#C11B17;"></span></p>
												<p ><textarea style="width:60%;" rows="10" name="text[]">'.$text[$i].'</textarea></p>
												<br/></div>'; 
												
												echo'
												<div class="naslov11" style="display:none;"><p>Podnaslov</p>
												<p><span style="color:#C11B17;"></span></p>
												<p ><input type="text" style="width:60%;" name="podnaslov[]" value=""/></p>
												<br/></div>';
												
												
												echo '</div>';
												
												}
												
												if($podnaslov[$i] != NULL){
												echo '<div id="brisanje_n'.$i.'">';
												echo'
												<div class="slika11" style="display:none;"><p>Slika </p>
												<p><span style="color:#C11B17;"></span></p>
												
												<p><input type="hidden" name="promena[]" id="myCheck" value=""/>Promeni sliku</p>
												<p><input type="file" name="slika_nova[]" /></p><br/> 
												<p>Naslov slike</p>
												<p><span style="color:#C11B17;"></span></p>
												<p><input type="text" style="width:60%;" name="naslov_slike[]" value=""/></p>
												<br/></div>';
												
												echo'
												<div class="text11" style="display:none;"><p>Tekst</p>
												<p><span style="color:#C11B17;"></span></p>
												<p ><textarea style="width:60%;" rows="10" name="text[]"></textarea></p>
												<br/></div>'; 
												
												echo'
												<div class="naslov11" ><p>Podnaslov   <input type="button" class="delete" onclick="Brisanje(\'brisanje_n'.$i.'\');" '; if ($_COOKIE["slova"]=="cirilica") {echo'value="Обриши поднаслов"';} else{echo' value="Оbriši podnaslov"';} echo ' /></p>
												<p><span style="color:#C11B17;"></span></p>
												<p ><input type="text" style="width:60%;" name="podnaslov[]" value="'.$podnaslov[$i].'"/></p>
												<br/></div>';
												
												echo '</div>';
												
												}
											
												$p++;
											
											
										}
										echo'<div class="referent"></div>';
									}
									else{
									echo'<div id="brisanje_sl0">
										<div class="slika11" ><p>Glavna slika  <input type="button" class="delete" onclick="Brisanje(\'brisanje_sl0\');" '; if ($_COOKIE["slova"]=="cirilica") {echo'value="Обриши слику"';} else{echo' value="Оbriši sliku"';} echo ' /></p>
										<p><span style="color:#C11B17;" ></span></p>
										<p><input type="file" name="slika[]"/></p>
										<br/> 
										
										<p>Naslov glavne slike</p>
										<p><span style="color:#C11B17;"></span></p>
										<p><input type="text" style="width:60%;" name="naslov_slike[]"/></p>
										<br/></div>
										
										<div class="text11" style="display:none;"><p>Tekst</p>
										<p><span style="color:#C11B17;"></span></p>
										<p ><textarea style="width:60%;" rows="10" name="text[]"></textarea></p>
										<br/></div>
										
										<div class="naslov11" style="display:none;"><p>Podnaslov</p>
										<p><span style="color:#C11B17;"></span></p>
										<p ><input type="text" style="width:60%;" name="podnaslov[]"/></p>
										<br/></div></div>
										
										<div id="brisanje_te0">
										<div class="slika11" style="display:none;"><p>Glavna slika </p>
										<p><span style="color:#C11B17;" ></span></p>
										<p><input type="file" name="slika[]"/></p>
										<br/> 
										
										<p>Naslov glavne slike</p>
										<p><span style="color:#C11B17;"></span></p>
										<p><input type="text" style="width:60%;" name="naslov_slike[]"/></p>
										<br/></div>
										
										<div class="text11" ><p>Tekst   <input type="button" class="delete" onclick="Brisanje(\'brisanje_te0\');" '; if ($_COOKIE["slova"]=="cirilica") {echo'value="Обриши текст"';} else{echo' value="Оbriši tekst"';} echo ' /></p>
										<p><span style="color:#C11B17;"></span></p>
										<p ><textarea style="width:60%;" rows="10" name="text[]"></textarea></p>
										<br/></div>
										
										<div class="naslov11" style="display:none;"><p>Podnaslov</p>
										<p><span style="color:#C11B17;"></span></p>
										<p ><input type="text" style="width:60%;" name="podnaslov[]"/></p>
										<br/></div></div>';
										
									echo'<div class="referent"></div>';
									}
									
									if($tip == 'nagrada'){
										$query = "SELECT * FROM nagrade WHERE pod_ID = '$ID'";
										$result = mysql_query($query);
										$record = mysql_fetch_assoc($result);
										$dodatak=$record['dodatak'];
										$dodatak=explode('!@!',$dodatak);
										$naslov_dodatak=$record['opis_dodatka'];
										$naslov_dodatak=explode('!@!',$naslov_dodatak);
										
									echo '<p>Priložena dokumenta:</p><br/>
										<p><span style="color:#C11B17;"></span></p>
										<p>Naziv <input type="text"  name="naziv_dokumenta[]" value="'.$naslov_dodatak[0].'" />';if($naslov_dodatak[0]){echo ' Promeni';}echo'<input type="file" name="dokument[]"/></p>
										<p>Naziv <input type="text"  name="naziv_dokumenta[]" value="'.$naslov_dodatak[1].'" />';if($naslov_dodatak[1]){echo ' Promeni';}echo'<input type="file" name="dokument[]"/></p>
										<p>Naziv <input type="text"  name="naziv_dokumenta[]" value="'.$naslov_dodatak[2].'" />';if($naslov_dodatak[2]){echo ' Promeni';}echo'<input type="file" name="dokument[]"/></p>
										<p>Naziv <input type="text"  name="naziv_dokumenta[]" value="'.$naslov_dodatak[3].'" />';if($naslov_dodatak[3]){echo ' Promeni';}echo'<input type="file" name="dokument[]"/></p>
										<p>Naziv <input type="text"  name="naziv_dokumenta[]" value="'.$naslov_dodatak[4].'" />';if($naslov_dodatak[4]){echo ' Promeni';}echo'<input type="file" name="dokument[]"/></p>
										<br/>';
									
									}
									if ($_COOKIE["slova"]=="cirilica") {
									echo'<p ><br/>
										<input type="button" class="dugme"  value="Додај слику" onclick="DodavanjeSlikeCIR();"/>
										<input type="button" class="dugme"  id="text" value="Додај текст" disabled="disabled" onclick="DodavanjeTekstaCIR();"/>
										<input type="button" class="dugme"  id="podnaslov" value="Додај поднаслов" onclick="DodavanjeNaslovaCIR();"/>
										<input type="button" class="dugme" value="Погледај" onclick="OnButton1();"/>											
										<input type="hidden" id="counter" value="1">
										</p>
									
										</form>';
									}
									else{
										echo'<p ><br/>
										<input type="button" class="dugme"  value="Dodaj sliku" onclick="DodavanjeSlikeLAT();"/>								
										<input type="button" class="dugme"  id="text" value="Dodaj tekst" disabled="disabled" onclick="DodavanjeTekstaLAT();"/>
										<input type="button" class="dugme"  id="podnaslov" value="Dodaj podnaslov" onclick="DodavanjeNaslovaLAT();"/>
										<input type="button" class="dugme" value="Pogledaj" onclick="OnButton1();"/>	
										<input type="hidden" id="counter" value="1">
										</p>
									
										</form>';
									}
									
									}
									else{
									if ($tip == 'pravni_akt'){// forma za unos pravnog akta
										$query = "SELECT * FROM pravni_akt WHERE pod_ID = '$ID'";
										$result = mysql_query($query);
										$record = mysql_fetch_assoc($result);
										$naslov=$record['naslov'];
										$dodatak=$record['dodatak'];
										$naslov_dodatak=$record['naslov_dodatak'];
										$naslov_dodatak=explode('!@!', $naslov_dodatak );
										$dodatak=explode('!@!', $dodatak);
										$drustvo=$record['drustvo'];
										$fondacija=$record['fondacija'];
										$abstrakt=$record['abstrakt'];
										
									echo'<h1>Unesi pravni akt</h1><br/>
												
										<p>Naziv pravnog akta </p>
										<p><input type="text" style="width:60%;" name="naslov" value="'.$naslov.'"/><span style="color:#C11B17;" id="naslov"></p>
										<br/>
										<p>Organizacija</p>
									
										<p><input type="checkbox" name="drustvo"'; if($drustvo){echo 'checked="checked"';} echo'/> Društvo <br/>
										<input type="checkbox" name="fondacija"'; if($fondacija){echo 'checked="checked"';} echo'/> Fondacija</p>
										<br/>';
										/*<p>Datum donošenja(gggg-mm-dd)</p>
										<p><span style="color:#C11B17;"></span></p>
										<p><input type="text" name="datum" value="'.$datum.'"/></p>
										<br/>	*/
										echo'
										<p>Abstrakt </p>
										<p><textarea style="width:60%;" rows="5" name="abstrakt" >'.$abstrakt.'</textarea><span style="color:#C11B17;" id="abstrakt"></span></p>
										<br/>			
										<p>Priložen dokument:</p><br/>
										<p><span style="color:#C11B17;"></span></p>
										<p>Naziv <input type="text"  name="naziv_dokumenta[]" value="'.$naslov_dodatak[0].'"/>';if($naslov_dodatak[0]){echo ' Promeni';}echo'<input type="file" name="dokument[]"/></p>
										<br/>';
										if ($_COOKIE["slova"]=="cirilica") {
											echo '<p><input type="button" class="dugme" value="Погледај" onclick="OnButton1()"/></p>';
										}
										else{
											echo '<p><input type="button" class="dugme" value="Pogledaj" onclick="OnButton1()"/></p>';
										}
										
										echo'</form>';
									}
									}
								}
								else{
									if ($_COOKIE["slova"]=="cirilica") {
										echo 'Немате права приступа овој страни.';
									}
									else{
										echo 'Nemate prava pristupa ovoj strani.';
									}
								}
							}
							else{
								if ($_COOKIE["slova"]=="cirilica") {
									echo 'Морате бити улоговани како бисте приступили овој страни.';
								}
								else{
									echo 'Morate biti ulogovani kako biste pristupili ovoj strani.';
								}
							}
						}
					?>
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
		<script tip="text/javascript" src="javascript/submenu.js"></script>
		<script tip="text/javascript" src="javascript/slideShow.js"></script>
		<script tip="text/javascript" src="javascript/scrool.js"></script>
		<script tip="text/javascript" src="javascript/verticalmenu.js"></script>
		<script tip="text/javascript" src="javascript/unos.js"></script>
		<script tip="text/javascript">
			skrol();
		
			function OnButton1(){
				var tip = "<?php if ($tip == 'događaj'){$tip = 'dogadjaj';} echo $tip; ?>";
				var ID = "<?php echo $ID; ?>";
				<?php
					if( $tip == 'vesti' || $tip == 'dogadjaj' || $tip == 'prilog' ||  $tip == 'patent' ){
						
						echo 'if(validateForm(document.form1) == true){
							var string_url = "unos_obrada.php?tip=" + tip';if (isset($_GET['id'])){echo '+"&id="+ ID;';}else{echo';';}
						echo'	document.form1.action = string_url;
							document.form1.submit();
						}else return;';
					}
					else if($tip == 'knjiga'){
						echo 'if(validateKnjiga(document.form1) == true){
							var string_url = "unos_obrada.php?tip=" + tip';if (isset($_GET['id'])){echo '+"&id="+ ID;';}else{echo';';}
						echo'	document.form1.action = string_url;
							document.form1.submit();
						}else return;';
					}
					else if($tip == 'nagrada'){
						echo 'if(validateNagrada(document.form1) == true){
							var string_url = "unos_obrada.php?tip=" + tip';if (isset($_GET['id'])){echo '+"&id="+ ID;';}else{echo';';}
						echo'	document.form1.action = string_url;
							document.form1.submit();
						}else return;';
					}
					else if($tip == 'pravni_akt'){
						echo 'if(validatePravni_akt(document.form1) == true){
							var string_url = "unos_obrada.php?tip=" + tip';if (isset($_GET['id'])){echo '+"&id="+ ID;';}else{echo';';}
						echo'	document.form1.action = string_url;
							document.form1.submit();
						}else return;';
					}	
					else if($tip == 'projekat'){
						echo 'if(validateProjekat(document.form1) == true){
							var string_url = "unos_obrada.php?tip=" + tip';if (isset($_GET['id'])){echo '+"&id="+ ID;';}else{echo';';}
						echo'	document.form1.action = string_url;
							document.form1.submit();
						}else return;';
					}	
					else if($tip == 'izjava'){
						echo 'if(validateIzjava(document.form1) == true){
							var string_url = "unos_obrada.php?tip=" + tip';if (isset($_GET['id'])){echo '+"&id="+ ID;';}else{echo';';}
						echo'	document.form1.action = string_url;
							document.form1.submit();
						}else return;';
					}	
				?>	
			}
		</script>
		
	</body>
</html>
