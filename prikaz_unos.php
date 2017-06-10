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
						if(isset($_GET['id'])){
							$tip=$_GET['tip'];
								if($tip=="prilog"){									
									include 'content/prilozi.php';
																
								}			
								if($tip=="vesti"){	
									include 'content/vesti.php';
																
								}
								if($tip=="događaj"){
									include 'content/dogadjaji.php';	
									
								}
								
								if($tip=="patent"){
									include 'content/patenti.php';	
									
								}
								if($tip=="knjiga"){
									include 'content/knjige.php';
									
								}
								if($tip=="izjava"){
									include 'content/poznati.php';
									
								}
								if($tip=="nagrada"){
									$id=$_GET['id'];
									$q= "SELECT * FROM podaci WHERE pod_ID='$id'";
									$r = mysql_query($q);
									$zapp = mysql_fetch_array($r);
									$tip_unosa=$zapp['tip_unosa'];
									if($tip_unosa=='nagrada'){
									include 'content/nagrade.php';
									}
									else{
									include 'content/konkursi.php';
									}
									
								}
								if($tip=="projekat"){
									$project_id = $_GET['id'];
									include "content/projekti_posebno.php";
									$tip="projekat";
								}
								if($tip=="pravni_akt"){
									$id=$_GET['id'];
									include 'content/pravni_akti.php';
									
								}
								
							$id=$_GET['id'];
							
							echo '<br/><form name="form2" action="unos.php?tip='.$tip.'&id='.$id.'" method="post" >';
							if ($_COOKIE["slova"]=="cirilica") {
							if(isset($_GET['unos'])){echo '<br/><span style="color:#C11B17;">Успешно сте завршили унос</span>';}
							else{
							echo'<p><input type="button" class="dugme" value="Погледај текс на латиници" onclick="promenaPismaLAT();" />
									<input type="submit" class="dugme" value="Настави унос"/>											
									<input type="submit" class="dugme" value="Заврши унос" onclick="OnButton2()"/>
								</p>';
							}
							}
							else{
							if(isset($_GET['unos'])){echo '<br/><span style="color:#C11B17;">Uspešno ste završili unos</span>';}
							else{
								echo'<p>
									<input type="button" class="dugme" value="Pogledaj tekst na ćirilici" onclick="promenaPismaCIR();" />
									<input type="submit" class="dugme" value="Nastavi unos"/>											
									<input type="submit" class="dugme" value="Završi unos" onclick="OnButton2()"/>
								</p>';
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
		<script tip="text/javascript">
			skrol();
		
			function OnButton2(){
				<?php
					if(isset($_GET['unos'])){
						for($m=0;$m<2;$m++){  
						// konekcija sa bazom podataka
						include 'includes/db_konekcija_dupla.php';
						$query = "UPDATE podaci SET zavrseno = '1' WHERE pod_ID = '$id'";
						$result = mysql_query($query);
						}
					}
				?>
				var ID = "<?php echo $id; ?>";
				var tip = "<?php echo $tip; ?>";
				ID = encodeURIComponent(ID);
				tip = encodeURIComponent(tip);
				var string_url = "prikaz_unos.php?id=" + ID + "&tip=" + tip + "&unos=true";
				document.form2.action = string_url;
			}
			
			function promenaPismaLAT(){
				setCookie("slova","latinica",31);
				window.location.reload();
			}
			function promenaPismaCIR(){
				setCookie("slova","cirilica",31);
				window.location.reload();
			}
		</script>
	</body>
</html>