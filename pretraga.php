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

				if ($_COOKIE["slova"]=="cirilica") { echo "<h1>Претрага</h1>";} 

				else { echo "<h1>Pretraga</h1>";} 

				echo '<form id="pretraga" method="get" action="pretraga.php" >';

						

						if ($_COOKIE["slova"] == "cirilica") { echo '<br/><p><input type="checkbox" id="pokljucnojreci" name="pokljucnojreci"'; if (isset($_GET["pokljucnojreci"])){ echo 'checked=checked';} echo 'value="da"/>По кључним речима </p><p class="box_pretraga"><input name="kljucna_rec" id ="kljucna_rec"  type="text" '; if (!isset($_GET["pokljucnojreci"])){ echo 'disabled=disabled';} echo ' value="'.$_GET["kljucna_rec"].'" maxlength="25"/></p><br/>';}

						else { echo '<br/><p><input type="checkbox" id="pokljucnojreci" name="pokljucnojreci"'; if (isset($_GET["pokljucnojreci"])){ echo 'checked=checked';} echo ' value="da"/>Po ključnim rečima </p><p class="box_pretraga"><input name="kljucna_rec"  id ="kljucna_rec" type="text" '; if (!isset($_GET["pokljucnojreci"])){ echo 'disabled=disabled';} echo ' value="'.$_GET["kljucna_rec"].'" maxlength="25"/></p><br/>';}

                        if ($_COOKIE["slova"] == "cirilica") { echo  '<p><input type="checkbox" name="poopsegudatuma" id = "poopsegudatuma" '; if (isset($_GET["poopsegudatuma"])){ echo 'checked=checked';} echo 'value="da"/>По датуму </p>';}

						else { echo	'<p><input type="checkbox" id = "poopsegudatuma" name="poopsegudatuma"'; if (isset($_GET["poopsegudatuma"])){ echo 'checked=checked';} echo ' value="da"/>Po datumu </p>';}

                        if ($_COOKIE["slova"] == "cirilica") { echo  '<p class="box_pretraga"><span style="white-space: nowrap;">Oд ';} else { echo '<p class="box_pretraga"><span style="white-space: nowrap;">Od ';}

                        echo'<select name="dan_od" class="datum11" '; if (!isset($_GET["poopsegudatuma"])){ echo 'disabled=disabled';} echo '>';

								for($i=1;$i<32;$i++){

									echo '<option'; if($_GET["dan_od"]== "'.$i.'"){echo 'selected="selected"';} echo'>'.$i.'</option>';

								}

						echo'</select>';		

						if ($_COOKIE["slova"]=="cirilica") {

							echo'

							<select name="mesec_od" class="datum11"'; if (!isset($_GET["poopsegudatuma"])){ echo 'disabled=disabled';} echo '>

								<option value="Јаn"'; if($_GET["mesec_od"]== 'Јаn'){echo 'selected="selected"';} echo'>Јан</option>

								<option value="Feb"'; if($_GET["mesec_od"]== 'Feb'){echo 'selected="selected"';} echo'>Феб</option>

								<option value="Mar"'; if($_GET["mesec_od"]== 'Mar'){echo 'selected="selected"';} echo'>Мар</option>

								<option value="Apr"'; if($_GET["mesec_od"]== 'Apr'){echo 'selected="selected"';} echo'>Aпр</option>

								<option value="Maj"'; if($_GET["mesec_od"]== 'Maj'){echo 'selected="selected"';} echo'>Maj</option>

								<option value="Jun"'; if($_GET["mesec_od"]== 'Jun'){echo 'selected="selected"';} echo'>Jун</option>

								<option value="Jul"'; if($_GET["mesec_od"]== 'Jul'){echo 'selected="selected"';} echo'>Jул</option>

								<option value="Avg"'; if($_GET["mesec_od"]== 'Avg'){echo 'selected="selected"';} echo'>Aвг</option>

								<option value="Sep"'; if($_GET["mesec_od"]== 'Sep'){echo 'selected="selected"';} echo'>Сеп</option>

								<option value="Okt"'; if($_GET["mesec_od"]== 'Okt'){echo 'selected="selected"';} echo'>Oкт</option>

								<option value="Nov"'; if($_GET["mesec_od"]== 'Nov'){echo 'selected="selected"';} echo'>Нов</option>

								<option value="Dec"'; if($_GET["mesec_od"]== 'Dec'){echo 'selected="selected"';} echo'>Дец</option>

							</select>';

						}

						else{

							echo'

							<select name="mesec_od" class="datum11"'; if (!isset($_GET["poopsegudatuma"])){ echo 'disabled=disabled';} echo '>

								<option value="Јаn"'; if($_GET["mesec_od"]== 'Јаn'){echo 'selected="selected"';} echo'>Јаn</option>

								<option value="Feb"'; if($_GET["mesec_od"]== 'Feb'){echo 'selected="selected"';} echo'>Feb</option>

								<option value="Mar"'; if($_GET["mesec_od"]== 'Mar'){echo 'selected="selected"';} echo'>Mar</option>

								<option value="Apr"'; if($_GET["mesec_od"]== 'Apr'){echo 'selected="selected"';} echo'>Apr</option>

								<option value="Maj"'; if($_GET["mesec_od"]== 'Maj'){echo 'selected="selected"';} echo'>Maj</option>

								<option value="Jun"'; if($_GET["mesec_od"]== 'Jun'){echo 'selected="selected"';} echo'>Jun</option>

								<option value="Jul"'; if($_GET["mesec_od"]== 'Jul'){echo 'selected="selected"';} echo'>Jul</option>

								<option value="Avg"'; if($_GET["mesec_od"]== 'Avg'){echo 'selected="selected"';} echo'>Avg</option>

								<option value="Sep"'; if($_GET["mesec_od"]== 'Sep'){echo 'selected="selected"';} echo'>Sep</option>

								<option value="Okt"'; if($_GET["mesec_od"]== 'Okt'){echo 'selected="selected"';} echo'>Okt</option>

								<option value="Nov"'; if($_GET["mesec_od"]== 'Nov'){echo 'selected="selected"';} echo'>Nov</option>

								<option value="Dec"'; if($_GET["mesec_od"]== 'Dec'){echo 'selected="selected"';} echo'>Dec</option>

							</select>';

						}

						echo'

							<select name="godina_od" class="datum11"'; if (!isset($_GET["poopsegudatuma"])){ echo 'disabled=disabled';} echo '>

								<option value=2012 '; if($_GET["godina_od"]== 2012){echo 'selected="selected"';} echo'>2012</option>

								<option value=2013 '; if($_GET["godina_od"]== 2013){echo 'selected="selected"';} echo'>2013</option>

								<option value=2014 '; if($_GET["godina_od"]== 2014){echo 'selected="selected"';} echo'>2014</option>

							</select> </span>&nbsp&nbsp';

							

						echo ($_COOKIE["slova"] == "cirilica") ? '<span style="white-space: nowrap;">До ' : '<span style="white-space: nowrap;">Do ';

						echo'<select name="dan_do" class="datum11"'; if (!isset($_GET["poopsegudatuma"])){ echo 'disabled=disabled';} echo '>';

								for($i=1;$i<32;$i++){

									echo '<option value="'.$i.'"'; if($_GET["dan_do"]== "'.$i.'"){echo 'selected="selected"';} echo'>'.$i.'</option>';

								}

						echo'</select>';

							if ($_COOKIE["slova"]=="cirilica") {

							echo'

							<select name="mesec_do" class="datum11"'; if (!isset($_GET["poopsegudatuma"])){ echo 'disabled=disabled';} echo '>

								<option value="Јаn"'; if($_GET["mesec_do"]== 'Јаn'){echo 'selected="selected"';} echo'>Јан</option>

								<option value="Feb"'; if($_GET["mesec_do"]== 'Feb'){echo 'selected="selected"';} echo'>Феб</option>

								<option value="Mar"'; if($_GET["mesec_do"]== 'Mar'){echo 'selected="selected"';} echo'>Мар</option>

								<option value="Apr"'; if($_GET["mesec_do"]== 'Apr'){echo 'selected="selected"';} echo'>Aпр</option>

								<option value="Maj"'; if($_GET["mesec_do"]== 'Maj'){echo 'selected="selected"';} echo'>Maj</option>

								<option value="Jun"'; if($_GET["mesec_do"]== 'Jun'){echo 'selected="selected"';} echo'>Jун</option>

								<option value="Jul"'; if($_GET["mesec_do"]== 'Jul'){echo 'selected="selected"';} echo'>Jул</option>

								<option value="Avg"'; if($_GET["mesec_do"]== 'Avg'){echo 'selected="selected"';} echo'>Aвг</option>

								<option value="Sep"'; if($_GET["mesec_do"]== 'Sep'){echo 'selected="selected"';} echo'>Сеп</option>

								<option value="Okt"'; if($_GET["mesec_do"]== 'Okt'){echo 'selected="selected"';} echo'>Oкт</option>

								<option value="Nov"'; if($_GET["mesec_do"]== 'Nov'){echo 'selected="selected"';} echo'>Нов</option>

								<option value="Dec"'; if($_GET["mesec_do"]== 'Dec'){echo 'selected="selected"';} echo'>Дец</option>

							</select>';

							}

							else{

								echo'

								<select name="mesec_do" class="datum11"'; if (!isset($_GET["poopsegudatuma"])){ echo 'disabled=disabled';} echo '>

									<option value="Јаn"'; if($_GET["mesec_do"]== 'Јаn'){echo 'selected="selected"';} echo'>Јаn</option>

									<option value="Feb"'; if($_GET["mesec_do"]== 'Feb'){echo 'selected="selected"';} echo'>Feb</option>

									<option value="Mar"'; if($_GET["mesec_do"]== 'Mar'){echo 'selected="selected"';} echo'>Mar</option>

									<option value="Apr"'; if($_GET["mesec_do"]== 'Apr'){echo 'selected="selected"';} echo'>Apr</option>

									<option value="Maj"'; if($_GET["mesec_do"]== 'Maj'){echo 'selected="selected"';} echo'>Maj</option>

									<option value="Jun"'; if($_GET["mesec_do"]== 'Jun'){echo 'selected="selected"';} echo'>Jun</option>

									<option value="Jul"'; if($_GET["mesec_do"]== 'Jul'){echo 'selected="selected"';} echo'>Jul</option>

									<option value="Avg"'; if($_GET["mesec_do"]== 'Avg'){echo 'selected="selected"';} echo'>Avg</option>

									<option value="Sep"'; if($_GET["mesec_do"]== 'Sep'){echo 'selected="selected"';} echo'>Sep</option>

									<option value="Okt"'; if($_GET["mesec_do"]== 'Okt'){echo 'selected="selected"';} echo'>Okt</option>

									<option value="Nov"'; if($_GET["mesec_do"]== 'Nov'){echo 'selected="selected"';} echo'>Nov</option>

									<option value="Dec"'; if($_GET["mesec_do"]== 'Dec'){echo 'selected="selected"';} echo'>Dec</option>

								</select>';

							}

							echo'

							<select name="godina_do" class="datum11"'; if (!isset($_GET["poopsegudatuma"])){ echo 'disabled=disabled';} echo '>

								<option value=2012 '; if($_GET["godina_do"]== 2012){echo 'selected="selected"';} echo'>2012</option>

								<option value=2013 '; if($_GET["godina_do"]== 2013){echo 'selected="selected"';} echo'>2013</option>

								<option value=2014 '; if($_GET["godina_do"]== 2014){echo 'selected="selected"';} echo'>2014</option>

							</select></span>

						</p><br/>';

						if ($_COOKIE["slova"]=="cirilica") {

						echo'

						<p>Сортирај по:

						<select name="sort">

							<option value="vreme" '; if($_GET["sort"]== 'vreme'){echo 'selected="selected"';} echo'>Датуму</option>

							<option value="kategorija" '; if($_GET["sort"]== 'kategorija'){echo 'selected="selected"';} echo'>Категорији</option>

							<option value="ocena" '; if($_GET["sort"]== 'ocena'){echo 'selected="selected"';} echo'>Oценама</option>

							<option value="komentari" '; if($_GET["sort"]== 'komentari'){echo 'selected="selected"';} echo'>Броју коментара</option>

							<option value="popularnost" '; if($_GET["sort"]== 'popularnost'){echo 'selected="selected"';} echo'>Популарности</option>

						</select></p><br/><br/>';

						}

						else{

						echo'

						<p>Sortiraj po:

						<select name="sort">

							<option value="vreme" '; if($_GET["sort"]== 'vreme'){echo 'selected="selected"';} echo'>Datumu</option>

							<option value="kategorija" '; if($_GET["sort"]== 'kategorija'){echo 'selected="selected"';} echo'>Kategoriji</option>

							<option value="ocena" '; if($_GET["sort"]== 'ocena'){echo 'selected="selected"';} echo'>Ocenama</option>

							<option value="komentari" '; if($_GET["sort"]== 'komentari'){echo 'selected="selected"';} echo'>Broju komentara</option>

							<option value="popularnost" '; if($_GET["sort"]== 'popularnost'){echo 'selected="selected"';} echo'>Popularnosti</option>

						</select></p><br/><br/>';						

						}

						

						if ($_COOKIE["slova"]=="cirilica") {

							echo'

							<div><input type="submit" class="dugme" name="trazi" value="Тражи"/></div><br/>';

						}

						else{

							echo'

							<div><input type="submit" class="dugme" name="trazi" value="Traži"/></div><br/>';

						}

					echo'	

					</form><hr/><br/>';

					include 'content/pretraga.php';

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



			$('#pokljucnojreci').live("change click", function(){

			$('#pokljucnojreci').is(':checked') ? $("#kljucna_rec").removeAttr('disabled') : $("#kljucna_rec").attr('disabled','disabled');

			});

			

			$('#poopsegudatuma').live("change click", function(){

			$('#poopsegudatuma').is(':checked') ? $(".datum11").prop('disabled', false) : $(".datum11").prop('disabled','disabled');

			});

	

		</script>

	</body>

</html>