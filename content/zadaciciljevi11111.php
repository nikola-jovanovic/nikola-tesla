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

					

					echo'

					<h1>Zadaci i ciljevi Društva Nikola Tesla</h1>';

					

					

					

					echo "<p class=\"absMenu\">Oblast rada Društva je naučno-tehnička i inovativna delatnost.

						Cilj Društva je popularizacija nauke generalno, a posebno lika i dela Nikole Tesle.</p><br/>";



					

					echo'<p class="naslov">Zadaci Društva Nikola Tesla</p>

					<ul class="rukovodstvo">

					<li>pokreće akcije i razvija delatnost na širenju i unapređenju nauke i tehnike i njihovih primena </li>

					<li>razvija nove metode i oblike širenja i unapređenja naučnih saznanja i u tom cilju organizuje naučne skupove, tribine, simpozijume i savetovanja</li>

					<li>izdaje i podstiče izdavanje stručnih popularnih i naučnih knjiga, časopisa i drugih publikacija, i video kaseta, i priređuje naučno-tehničke izložbe</li>

					<li>organizuje festival naučnog filma, specijalizovane smotre naučno-tehničkih filmova</li>

					<li>populariše ličnost i delo Nikole Tesle i drugih velikana nauke radi podsticanja naučno-tehničkog stvaralaštva u našoj zemlji</li>

					<li>uspostavlja i unapređuje saradnju sa sličnim organizacijama i institucijama u svetu</li>

					<li>sarađuje sa sredstvima javnog informisanja na širenju i unapređenju nauke i tehnike i razvoju naučno-tehničke kulture</li>

					<li>organizuje i druge akcije koje mu povere članovi Društva u okviru zajedničkih programa</li>

					</ul><br/>

					<p class="absMenu">Društvo će ostvarivati zajedničke programske aktivnosti na popularisanju dela i lika Nikole Tesle i na širenju naučnih saznanja sa Fondacijom "Fond Nikole Tesle".</p>

					

					

					';

					



					

					

					}

					

					else if($tip=="fondacija"){

					

					echo'

					<h1>Zadaci i ciljevi Društva Nikola Tesla</h1>';

					echo '<p class="absMenu">Fondacija je pravno lice bez osnovne imovine koje je osnovano radi dobročinog 
					ostvarivanja opšte-korisnog cilja koji nije zabranjen ustavom ili zakonom. Fondacija će ostvarivati, sa Društvom
					za širenje naučnih saznanja "Nikola Tesla", zajedničke programske aktivnosti na popularisanju dela i lika 
					Nikole Tesle.</p><br/>';

					

					

					//echo "<p class=\"absMenu\">Oblast rada Društva je naučno-tehnička i inovativna delatnost.

						//Cilj Društva je popularizacija nauke generalno, a posebno lika i dela Nikole Tesle.</p><br/>";



					

					echo'<p class="naslov">Zadaci Fondacije Nikola Tesla</p>
						<p>Ostvarivanjem opšte-korisnog cilja Fondacije, u smislu zakona, smatraju se aktivnosti usmerene na promovisanje i popularizaciju:</p>

					<ul class="rukovodstvo">

					<li>nauke,</li>

					<li>tehnike,</li>

					<li>tehničko-tehnološkog i energetskog razvoja,</li>

					<li>stvaralaštva mladih i</li>

					<li>ideja i dela Nikole Tesle.</li>
					</ul><br/>
					<p>U skladu sa prethodnim Fondacija:</p>

					<ul class="rukovodstvo">

					<li>podstiče i nagrađuje pojedince, grupe autora i organizacije za postignute rezultate u naučno-istraživačkom radu, posebno u primeni naučno-stručnih dostignuća na području tehničkih i prirodnih nauka;</li>

					<li>podstiče i nagrađuje pojedince i grupe autora za racionalizatorske, novatorske i pronalazačke rezultate u materijalnoj proizvodnji i tehnološkom razvoju;</li>

					<li>dodeljuje priznanja i nagrade učenicima i studentima za radove koji doprinose njihovom usmeravanju ka naučno-tehničkom stvaralaštvu i istraživačkom radu;</li>

					<li>inicira akcije za izučavanje i popularisanje stvaralaštva Nikole Tesle učešćem u objavljivanju njegovih dela i ostvarivanjem određenih programa izučavanja naučne i stručne zaostavštine Nikole Tesle i</li>

					<li>učestvuje u organizovanju naučnih i stručnih skupova i akcija posvećenih popularisanju i razvoju nauke i tehnike, stvaralaštvu Nikole Tesle i obeležavanju značajnih datuma iz njegovog života i rada.</li>
					</ul><br/>


					<p class="absMenu">Za radove kojima se ostvaruju ciljevi Fondacije, pojedincima, timovima i organizacijama, kao
					redovno priznanje, dodeljuje se Teslina nagrada. Teslina nagrada se sastoji od plakete sa Teslinim likom, diplome i novčanog iznosa. Teslinu nagradu dodeljuje Odbor za dodelu Tesline nagrade, čije članove i predsednika imenuje Upravni odbor Fondacije. <br/>Pravilnik o dodeli Tesline nagrade možete preuzeti <a href="fajlovi/PravilnikododeliTeslinenagrade.pdf">ovde</a>.<br/>Uputstvo o dodeli Tesline nagrade možete preuzeti <a href="fajlovi/Teslinanagradauputstvo.pdf">ovde</a>.</p>

					

					';

					

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