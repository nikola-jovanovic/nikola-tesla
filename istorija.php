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
							echo '<h1>Историја Друштва за ширење научних сазнања „Никола Тесла“</h1>';
						}
						else{
							echo '<h1>Istorija Društva za širenje naučnih saznanja „Nikola Tesla“</h1>';
						}
					
						$query = "SELECT * FROM text WHERE pod_ID =13 ";
						$result = mysql_query($query);
						$record = mysql_fetch_assoc($result);
						echo $record['tekst'];

					}

					else if($tip=="fondacija") {
					if ($_COOKIE["slova"]=="cirilica") {
						echo '<h1>Историја Фондације „Никола Тесла“</h1>';
					}
					else{
						echo '<h1>Istorija Fondacije „Nikola Tesla“</h1>';
					}	
						$query = "SELECT * FROM text WHERE pod_ID =14 ";
						$result = mysql_query($query);
						$record = mysql_fetch_assoc($result);
						echo $record['tekst'];
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

			<?php

				//if($tip == 'vesti')echo 'vesti.style.color="red";';

				//if($tip == 'dogadjaj')echo 'dogadjaj.style.color="red";';



			?>

		</script>

	</body>

</html>