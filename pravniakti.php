<?php

	session_start();

	error_reporting(0);

	include 'includes/head.php';

	include 'includes/brisanje.php';

	

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

				$tip=$_GET['tip'];

				$tip_unosa="pravni_akt";

				if($tip=="drustvo"){

				if ($_COOKIE["slova"]=="cirilica") {

					echo'<h1>Правни акти Друштва Никола Тесла</h1>';

				}

				else{

					echo'<h1>Pravni akti Društva Nikola Tesla</h1>';

				}	

					$query = "SELECT * FROM pravni_akt, podaci WHERE odobren = '1' AND podaci.tip_unosa = '$tip_unosa' AND pravni_akt.pod_ID = podaci.pod_ID AND pravni_akt.drustvo='1' ORDER BY podaci.datum DESC ";

					$rez = mysql_query($query)

						 or die(mysql_error());

					while ($z = mysql_fetch_assoc($rez)) {

					$naslov=$z['naslov'];

					$abstrakt=$z['abstrakt'];

					$dodatak=$z['dodatak'];

					$dodatak = explode('!@!', $dodatak);

					echo "<p class=\"naslov\">".$naslov."</p>";



					echo '<p class="datum_vesti">'.$z['datum'].'</p>

					<div class="izlistano"><p class="text1">'.$abstrakt.'';

					if ($_COOKIE["slova"]=="cirilica") {echo ' Документ можете преузети <a href="fajlovi/'.$dodatak[0].'">овде';}

					else{echo ' Dokument možete preuzeti <a href="fajlovi/'.$dodatak[0].'">ovde';} echo'</a>.</p></div><hr/>';

					



					}

					

					}

					

					else if($tip=="fondacija"){

					if ($_COOKIE["slova"]=="cirilica") {

						echo'<h1>Правни акти фондације Никола Тесла</h1>';

					}

					else{

						echo'<h1>Pravni akti Fondacije Nikola Tesla</h1>';

					}	

					

					

					$query = "SELECT * FROM pravni_akt, podaci WHERE odobren = '1' AND podaci.tip_unosa = '$tip_unosa' AND pravni_akt.pod_ID = podaci.pod_ID AND pravni_akt.fondacija='1' ORDER BY podaci.datum DESC ";

					$rez = mysql_query($query)

						 or die(mysql_error());

					while ($z = mysql_fetch_assoc($rez)) {

					$naslov=$z['naslov'];

					$abstrakt=$z['abstrakt'];

					$dodatak=$z['dodatak'];

					$dodatak = explode('!@!', $dodatak);

					echo "<p class=\"naslov\">".$naslov."</p>";



					echo '<p class="datum_vesti">'.$z['datum'].'</p>

					<div class="izlistano"><p class="text1">'.$abstrakt.'';

					if ($_COOKIE["slova"]=="cirilica") {echo ' Документ можете преузети <a href="fajlovi/'.$dodatak[0].'">овде';}

					else{echo ' Dokument možete preuzeti <a href="fajlovi/'.$dodatak[0].'">ovde';} echo'</a>.</p></div><hr/>';

					}

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

		<script type="text/javascript">

			skrol();

		</script>

	</body>

</html>