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
					if ($_COOKIE["slova"]=="cirilica") {
						echo'<h1>Трошкови пројекта</h1>';
					}
					else{
						echo'<h1>Troškovi projekta</h1>';
					}
					$final=$_POST['final'];
					$proje=$_POST['box'];
					//dodavanje troskova za projekat
					if ($proje){
					
						$upit = "SELECT * FROM projekti WHERE pod_ID ='$proje'";
							$rezultat = mysql_query($upit)
							or die(mysql_error());
							$zapis= mysql_fetch_array($rezultat);
							$naziv=$zapis['naslov'];
							
						echo '<p class="text1">'; if ($_COOKIE["slova"]=="cirilica") {echo 'Пројекат: ';} else{echo 'Projekat: ';} 
						echo'<a class="lista" href="projekti.php?id='.$proje.'" >'.$naziv.'</a></p><br/>';
						
						if($final){	
							include 'includes/preslovljivac.php';
							$danas= date ("Y-m-d");
							
							$costs_id=$_POST['cost_id'];
							if(!$costs_id){$costs_id=0;}
							$naziv=$_POST['naziv'];
							$iznos=$_POST['iznos'];
							for($m=0;$m<2;$m++){  
								// konekcija sa bazom podataka
								include 'includes/db_konekcija_dupla.php';
								// čitanje jedan po jedan trošak iz niza
								$upit = "SELECT * FROM troskovi WHERE projekat_id ='$proje'";
									$rezultat = mysql_query($upit)
										or die(mysql_error());
								$result_array=array();
								while ($zapis= mysql_fetch_array($rezultat)){
										array_push($result_array, $zapis['trosak_id']);
								}
								
								$result_array = array_diff($result_array, $costs_id);
								
								for ($i = 0; $i < count($naziv); $i++){
									$x=preslovljavanje($naziv[$i], $t);
									$y=$iznos[$i];
									$cost_id=$costs_id[$i];									
									
									if($cost_id){
										
										if ($x!="" && $y!=0){
											$ubaci = "UPDATE troskovi SET naziv='$x', iznos='$y', datum='$danas' WHERE trosak_id='$cost_id' ";
											$rezultat = mysql_query($ubaci)
												or die(mysql_error());
										}
										else {
											$upit = "DELETE FROM troskovi WHERE trosak_id ='$cost_id'";
												mysql_query($upit)
												or die(mysql_error());
										}
										
									}
									else{
										if ($x!="" && $y!=0){
											$ubaci = "INSERT INTO troskovi (naziv, projekat_id, iznos, datum )
											VALUES ('$x', '$proje', '$y', '$danas')";
											$rezultat = mysql_query($ubaci)
												or die(mysql_error());
										}
									}
									
								}
								
								foreach ($result_array as $value) {
										
										$upit = "DELETE FROM troskovi WHERE trosak_id ='$value'";
												mysql_query($upit)
												or die(mysql_error());
								}
							}
							include 'includes/db_konekcija.php';
							if ($_COOKIE["slova"]=="cirilica") {
								echo '<br/><p style="color:#C11B17;"> Трошкови успешно измењени.</p><br/>';
							}
							else{
								echo '<br/><p style="color:#C11B17;"> Troškovi uspešno izmenjeni.</p><br/>';
							}
							
							
							
						}
						
						
						echo'<form action="troskovi.php"  method="post" onsubmit="return admin_projekti()">
								
								<table class="projekti">
								<tr class="projekti">';
									if ($_COOKIE["slova"]=="cirilica") {
										echo'<th class="projekti">Назив трошка</th>
										<th class="projekti">Износ (дин)</th>';
									}
									else{
										echo'<th class="projekti">Naziv troška</th>
										<th class="projekti">Iznos (din)</th>';
									}
								echo'</tr>';
								
						$upit = "SELECT COUNT(*) FROM troskovi WHERE projekat_id ='$proje' "; 
						$rezultat = mysql_query($upit)
						  or die(mysql_error());
						$ukupno=mysql_result($rezultat, 0, 0);
						if($ukupno){
						
								$upit = "SELECT * FROM troskovi WHERE projekat_id ='$proje'";
								$rezultat = mysql_query($upit)
									or die(mysql_error());
								while ($zapis= mysql_fetch_array($rezultat)){
								echo '<input type="hidden"   name="cost_id[]" value="0"/>';
								echo '<tr class="projekti" id="red_'.$zapis['trosak_id'].'" >
										<input type="hidden"   name="cost_id[]" value="'.$zapis['trosak_id'].'"/>
										<td class="projekti" class="a"><input type="text" style="width:90%;" id="naziv" name="naziv[]" value="'.$zapis['naziv'].'"/>				
										</td>
										<td class="projekti" class="a" ><input type="text"  style="width:90%;" id="suma" name="iznos[]" value="'.$zapis['iznos'].'"/>					
										</td>
										<td class="projekti"><input type="button" class="delete" onclick="Brisanje(\'red_'.$zapis['trosak_id'].'\');" '; if ($_COOKIE["slova"]=="cirilica") {echo'value="Обриши"';} else{echo' value="Оbriši"';} echo ' /></td>
									</tr>';
								}
											
						
								
						}
						echo'
							<tr class="projekti">
								<td class="projekti" class="a"><input type="text"   style="width:90%;" id="naziv" name="naziv[]" />					
								</td>
								<td class="projekti" class="a" ><input type="text"  style="width:90%;" id="suma" name="iznos[]" />					
								</td>	
							</tr>
							<tr class="projekti">
								<td class="projekti" class="a"><input type="text"  style="width:90%;" id="naziv" name="naziv[]" />					
								</td>
								<td class="projekti" class="a" ><input type="text" style="width:90%;" id="suma" name="iznos[]" />					
								</td>	
							</tr>
							<tr class="projekti">
								<td class="projekti" class="a"><input type="text" style="width:90%;" id="naziv" name="naziv[]" />				
								</td>
								<td class="projekti" class="a" ><input type="text"  style="width:90%;" id="suma" name="iznos[]" />					
								</td>	
							</tr>';
																											
							echo '</table>';								
						
							echo'<p>
							
							<input type="hidden"  name="box" value="'.$proje.'"/>
							<input type="hidden"  name="final" value="final"/><br/>';
							if ($_COOKIE["slova"]=="cirilica") {
								echo '<input type="submit" class="dugme" name ="troskovi" value="Сачувај измене"/>
								<input type="button" class="dugme" onclick="DodajTrosak();" value="Додај још"/>
								<input type="button" class="dugme" onclick="azuriranjeProjekata();" value="Ажурирај пројекат"/>';
							}
							else{
								echo '<input type="submit" class="dugme" name ="troskovi" value="Sačuvaj izmene"/>
								<input type="button" class="dugme" onclick="DodajTrosak();" value="Dodaj još"/>
								<input type="button" class="dugme" onclick="azuriranjeProjekata();" value="Ažuriraj projekat"/>';
							}
							echo'
							</p></form><br/><br/>';	
						
						
						}
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
		<script type="text/javascript" src="javascript/provera.js"></script>
		<script type="text/javascript" src="javascript/unos.js"></script>
		<script type="text/javascript">
			function azuriranjeProjekata(){
				window.location="azuriranje.php?type=projekat"; 
			}
			
			skrol();
		</script>
	</body>
</html>