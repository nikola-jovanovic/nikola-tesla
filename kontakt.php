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

				if ($_COOKIE["slova"]=="cirilica") {

				echo'	<h1>Kонтакт</h1>

					<p class="text1">Адреса: Косте Главинића 8a, Београд, Србија</p>

					<p class="text1">Телефон: +381 11 36 91 447<br/>

					E-mail: fondacija.nikola.tesla@gmail.com</p><br/>

					<iframe width="80%" height="300px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=sr&amp;geocode=&amp;q=%D0%9A%D0%BE%D1%81%D1%82%D0%B5+%D0%93%D0%BB%D0%B0%D0%B2%D0%B8%D0%BD%D0%B8%D1%9B%D0%B0,+%D0%91%D0%B5%D0%BE%D0%B3%D1%80%D0%B0%D0%B4,+%D0%A1%D1%80%D0%B1%D0%B8%D1%98%D0%B0&amp;aq=0&amp;oq=ko&amp;sll=37.0625,-95.677068&amp;sspn=36.368578,77.871094&amp;ie=UTF8&amp;hq=&amp;hnear=%D0%9A%D0%BE%D1%81%D1%82%D0%B5+%D0%93%D0%BB%D0%B0%D0%B2%D0%B8%D0%BD%D0%B8%D1%9B%D0%B0,+%D0%91%D0%B5%D0%BE%D0%B3%D1%80%D0%B0%D0%B4,+%D0%93%D1%80%D0%B0%D0%B4+%D0%91%D0%B5%D0%BE%D0%B3%D1%80%D0%B0%D0%B4,+%D0%A1%D1%80%D0%B1%D0%B8%D1%98%D0%B0&amp;ll=44.795011,20.441193&amp;spn=0.003982,0.009506&amp;t=m&amp;z=14&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=sr&amp;geocode=&amp;q=%D0%9A%D0%BE%D1%81%D1%82%D0%B5+%D0%93%D0%BB%D0%B0%D0%B2%D0%B8%D0%BD%D0%B8%D1%9B%D0%B0,+%D0%91%D0%B5%D0%BE%D0%B3%D1%80%D0%B0%D0%B4,+%D0%A1%D1%80%D0%B1%D0%B8%D1%98%D0%B0&amp;aq=0&amp;oq=ko&amp;sll=37.0625,-95.677068&amp;sspn=36.368578,77.871094&amp;ie=UTF8&amp;hq=&amp;hnear=%D0%9A%D0%BE%D1%81%D1%82%D0%B5+%D0%93%D0%BB%D0%B0%D0%B2%D0%B8%D0%BD%D0%B8%D1%9B%D0%B0,+%D0%91%D0%B5%D0%BE%D0%B3%D1%80%D0%B0%D0%B4,+%D0%93%D1%80%D0%B0%D0%B4+%D0%91%D0%B5%D0%BE%D0%B3%D1%80%D0%B0%D0%B4,+%D0%A1%D1%80%D0%B1%D0%B8%D1%98%D0%B0&amp;ll=44.795011,20.441193&amp;spn=0.003982,0.009506&amp;t=m&amp;z=14" style="color:#0000FF;text-align:left">Прикажи већу мапу</a></small>

				';

				}

				else{

					echo'	<h1>Kontakt</h1>

					<p class="text1">Adresa: Koste Glavinića 8a, Beograd, Srbija</p>

					<p class="text1">Telefon: +381 11 36 91 447<br/>

					E-mail: fondacija.nikola.tesla@gmail.com</p><br/>

					<iframe width="80%" height="300px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=sr&amp;geocode=&amp;q=%D0%9A%D0%BE%D1%81%D1%82%D0%B5+%D0%93%D0%BB%D0%B0%D0%B2%D0%B8%D0%BD%D0%B8%D1%9B%D0%B0,+%D0%91%D0%B5%D0%BE%D0%B3%D1%80%D0%B0%D0%B4,+%D0%A1%D1%80%D0%B1%D0%B8%D1%98%D0%B0&amp;aq=0&amp;oq=ko&amp;sll=37.0625,-95.677068&amp;sspn=36.368578,77.871094&amp;ie=UTF8&amp;hq=&amp;hnear=%D0%9A%D0%BE%D1%81%D1%82%D0%B5+%D0%93%D0%BB%D0%B0%D0%B2%D0%B8%D0%BD%D0%B8%D1%9B%D0%B0,+%D0%91%D0%B5%D0%BE%D0%B3%D1%80%D0%B0%D0%B4,+%D0%93%D1%80%D0%B0%D0%B4+%D0%91%D0%B5%D0%BE%D0%B3%D1%80%D0%B0%D0%B4,+%D0%A1%D1%80%D0%B1%D0%B8%D1%98%D0%B0&amp;ll=44.795011,20.441193&amp;spn=0.003982,0.009506&amp;t=m&amp;z=14&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=sr&amp;geocode=&amp;q=%D0%9A%D0%BE%D1%81%D1%82%D0%B5+%D0%93%D0%BB%D0%B0%D0%B2%D0%B8%D0%BD%D0%B8%D1%9B%D0%B0,+%D0%91%D0%B5%D0%BE%D0%B3%D1%80%D0%B0%D0%B4,+%D0%A1%D1%80%D0%B1%D0%B8%D1%98%D0%B0&amp;aq=0&amp;oq=ko&amp;sll=37.0625,-95.677068&amp;sspn=36.368578,77.871094&amp;ie=UTF8&amp;hq=&amp;hnear=%D0%9A%D0%BE%D1%81%D1%82%D0%B5+%D0%93%D0%BB%D0%B0%D0%B2%D0%B8%D0%BD%D0%B8%D1%9B%D0%B0,+%D0%91%D0%B5%D0%BE%D0%B3%D1%80%D0%B0%D0%B4,+%D0%93%D1%80%D0%B0%D0%B4+%D0%91%D0%B5%D0%BE%D0%B3%D1%80%D0%B0%D0%B4,+%D0%A1%D1%80%D0%B1%D0%B8%D1%98%D0%B0&amp;ll=44.795011,20.441193&amp;spn=0.003982,0.009506&amp;t=m&amp;z=14" style="color:#0000FF;text-align:left">Prikaži veću mapu</a></small>

				';

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