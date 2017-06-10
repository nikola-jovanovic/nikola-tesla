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
	$sid=$_POST['sid'];
	$id=$_POST['li_0_product_id'];
	$total=$_POST['total'];
	$merchant_order_id=$_POST['merchant_order_id'];
	$key=$_POST['key'];
	$order_number=$_POST['order_number'];
	if($sid== "1819221"){
		$string_to_hash = "tango1819221" ."1".$_POST["total"];
		$check_key = strtoupper(md5($string_to_hash));
		if ($key==$check_key){						
			//donacija
			if($id=="d"){	
				for($m=0;$m<2;$m++){  
				// konekcija sa bazom podataka
				include 'includes/db_konekcija_dupla.php';
				$pr="UPDATE donacije SET  iznos='$total', sale_id='$order_number' WHERE donacija_id='$merchant_order_id' ";
				mysql_query($pr)
				or die(mysql_error());
				$upit = "SELECT * FROM donacije WHERE donacija_id='$merchant_order_id' "; 
				$rezultat = mysql_query($upit)
				  or die(mysql_error());	
				$zapis = mysql_fetch_assoc($rezultat);
				$iznos=$zapis['iznos'];
				$project_id=$zapis['projekat_id'];
				$pr="UPDATE projekti SET trenutna_suma=trenutna_suma+'$iznos' WHERE pod_ID='$project_id' ";
					mysql_query($pr)
					or die(mysql_error());
				}	
				echo '<h1></h1><br/>';
				if ($_COOKIE["slova"]=="cirilica") {
					echo '<div style="text-align:center;"><p class="thanks">Друштво и Фондација Никола Тесла се захваљује на донацији!</p><br/>';
				}
				else{
					echo '<div style="text-align:center;"><p class="thanks">Društvo i Fondacija Nikola Tesla se zahvaljuje na donaciji!</p><br/>';
				}
				
				echo '<img class="hvala" src="images/nikola_tesla.jpg"/></div><br/>';
				//echo '<p class="tekst">Vaša donacija će biti proknjižena čim dobijemo informaciju od 2CheckOut-a da je transakcija uspešno realizovana. U tom slučaju na vašem <a href="profil.php">profilu</a> biće vidljiva donacija.</p>';
			}
			//članarina
			if($id=="c"){
				$danas=date ("Y-m-d");
				$d= strtotime($danas);
				$final = date("Y-m-d", strtotime("+1 year", $d));
				for($m=0;$m<2;$m++){  
				// konekcija sa bazom podataka
				include 'includes/db_konekcija_dupla.php';
				$pr="UPDATE clanarine SET sale_id='$order_number' WHERE clanarina_id='$merchant_order_id' ";
					mysql_query($pr)
					or die(mysql_error());
					
				$upit = "SELECT * FROM clanarine WHERE clanarina_id='$merchant_order_id'";
				$rezultat = mysql_query($upit)
				  or die(mysql_error());
				$zapis = mysql_fetch_assoc($rezultat);
				$user=$zapis['korisnik_id'];
				$pr="UPDATE korisnici SET clanarina='$final' WHERE korisnik='$user' ";
					mysql_query($pr)
					or die(mysql_error());	
				}
				echo '<h1></h1><br/>';
				if ($_COOKIE["slova"]=="cirilica") {
					echo '<div style="text-align:center;"><p class="thanks">Хвала што сте платили чланарину!</p><br/>';
				}
				else{
					echo '<div style="text-align:center;"><p class="thanks">Hvala što ste platili članarinu!</p><br/>';
				}
				
				echo '<img class="hvala" src="images/nikola_tesla.jpg"/></div><br/>';
				//echo '<p class="tekst">Vaša članarina će biti proknjižena čim dobijemo informaciju od 2CheckOut-a da je transakcija uspešno realizovana.</p>';	
			}
		}
	else {echo '<p class="text1">Autentifikacija nije uspela!</p><br/>';}
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

		<script type="text/javascript" src="javascript/submenu.js"></script>
		<script type="text/javascript" src="javascript/slideShow.js"></script>
		<script type="text/javascript" src="javascript/scrool.js"></script>
		<script type="text/javascript" src="javascript/verticalmenu.js"></script>
		<script type="text/javascript">
			skrol();
		</script>
	</body>
</html>