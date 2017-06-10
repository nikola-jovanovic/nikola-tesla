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

						echo'

						<h1>Задаци и циљеви Друштва Никола Тесла</h1>';

						echo '<p class="absMenu">Област рада Друштва је научно-техничка и иновативна делатност.

							Циљ Друштва је популаризација науке генерално, а посебно лика и дела Николе Тесле. Друштво ће остваривати заједничке програмске активности на популарисању дела и лика Николе Тесле и на ширењу научних сазнања са Фондацијом "Фонд Николе Тесле".</p><br/>';

						echo'<p class="text1">Задаци Друштва Никола Тесла:</p><br/>

						<ul class="lista">

						<li>покреће акције и развија делатност на ширењу и унапређењу науке и технике и њихових примена </li>

						<li>развија нове методе и облике ширења и унапређења научних сазнања и у том циљу организује научне скупове, трибине, симпозијуме и саветовања</li>

						<li>издаје и подстиче издавање стручних популарних и научних књига, часописа и других публикација, и видео касета, и приређује научно-техничке изложбе</li>

						<li>организује фестивал научног филма, специјализоване смотре научно-техничких филмова</li>

						<li>популарише личност и дело Николе Тесле и других великана науке ради подстицања научно-техничког стваралаштва у нашој земљи</li>

						<li>успоставља и унапређује сарадњу са сличним организацијама и институцијама у свету</li>

						<li>сарађује са средствима јавног информисања на ширењу и унапређењу науке и технике и развоју научно-техничке културе</li>

						<li>организује и друге акције које му повере чланови Друштва у оквиру заједничких програма</li>

						</ul>';



					}

					else{

						echo'

						<h1>Zadaci i ciljevi Društva Nikola Tesla</h1>';

						echo '<p class="absMenu">Oblast rada Društva je naučno-tehnička i inovativna delatnost.

							Cilj Društva je popularizacija nauke generalno, a posebno lika i dela Nikole Tesle. Društvo će ostvarivati zajedničke programske aktivnosti na popularisanju dela i lika Nikole Tesle i na širenju naučnih saznanja sa Fondacijom "Fond Nikole Tesle".</p><br/>';

						echo'<p class="text1">Zadaci Društva Nikola Tesla:</p><br/>

						<ul class="lista">

						<li>pokreće akcije i razvija delatnost na širenju i unapređenju nauke i tehnike i njihovih primena </li>

						<li>razvija nove metode i oblike širenja i unapređenja naučnih saznanja i u tom cilju organizuje naučne skupove, tribine, simpozijume i savetovanja</li>

						<li>izdaje i podstiče izdavanje stručnih popularnih i naučnih knjiga, časopisa i drugih publikacija, i video kaseta, i priređuje naučno-tehničke izložbe</li>

						<li>organizuje festival naučnog filma, specijalizovane smotre naučno-tehničkih filmova</li>

						<li>populariše ličnost i delo Nikole Tesle i drugih velikana nauke radi podsticanja naučno-tehničkog stvaralaštva u našoj zemlji</li>

						<li>uspostavlja i unapređuje saradnju sa sličnim organizacijama i institucijama u svetu</li>

						<li>sarađuje sa sredstvima javnog informisanja na širenju i unapređenju nauke i tehnike i razvoju naučno-tehničke kulture</li>

						<li>organizuje i druge akcije koje mu povere članovi Društva u okviru zajedničkih programa</li>

						</ul>';

					}				

					

					}

					

					else if($tip=="fondacija"){

					if ($_COOKIE["slova"]=="cirilica") {

					echo '<h1>Задаци и циљеви Фондације Никола Тесла</h1>';



					echo '<p class="absMenu">Фондација је правно лице без основне имовине које је основано ради доброчиног 

					остваривања опште-корисног циља који није забрањен уставом или законом. Фондација ће остваривати, са Друштвом

					за ширење научних сазнања "Никола Тесла", заједничке програмске активности на популарисању дела и лика 

					Николе Тесле.</p><br/>

					<p class="text1">Остваривањем опште-корисног циља Фондације, у смислу закона, сматрају се активности усмерене на промовисање и популаризацију:</p>

					<br/>

					<ul class="lista">



					<li>науке,</li>



					<li>технике,</li>



					<li>техничко-технолошког и енергетског развоја,</li>



					<li>стваралаштва младих и</li>



					<li>идеја и дела Николе Тесле.</li>

					</ul><br/>

					<p class="text1">У складу са претходним Фондација:</p>

					<br/>

					<ul class="lista">



					<li>подстиче и награђује појединце, групе аутора и организације за постигнуте резултате у научно-истраживачком раду, посебно у примени научно-стручних достигнућа на подручју техничких и природних наука;</li>



					<li>подстиче и награђује појединце и групе аутора за рационализаторске, новаторске и проналазачке резултате у материјалној производњи и технолошком развоју;</li>



					<li>додељује признања и награде ученицима и студентима за радове који доприносе њиховом усмеравању ка научно-техничком стваралаштву и истраживачком раду;</li>



					<li>иницира акције за изучавање и популарисање стваралаштва Николе Тесле учешћем у објављивању његових дела и остваривањем одређених програма изучавања научне и стручне заоставштине Николе Тесле и</li>



					<li>учествује у организовању научних и стручних скупова и акција посвећених популарисању и развоју науке и технике, стваралаштву Николе Тесле и обележавању значајних датума из његовог живота и рада.</li>

					</ul>';

					}

					else{

					echo '<h1>Zadaci i ciljevi Fondacije Nikola Tesla</h1>';



					echo '<p class="absMenu">Fondacija je pravno lice bez osnovne imovine koje je osnovano radi dobročinog 

					ostvarivanja opšte-korisnog cilja koji nije zabranjen ustavom ili zakonom. Fondacija će ostvarivati, sa Društvom

					za širenje naučnih saznanja "Nikola Tesla", zajedničke programske aktivnosti na popularisanju dela i lika 

					Nikole Tesle.</p><br/>

					<p class="text1">Ostvarivanjem opšte-korisnog cilja Fondacije, u smislu zakona, smatraju se aktivnosti usmerene na promovisanje i popularizaciju:</p>

					<br/>

					<ul class="lista">



					<li>nauke,</li>



					<li>tehnike,</li>



					<li>tehničko-tehnološkog i energetskog razvoja,</li>



					<li>stvaralaštva mladih i</li>



					<li>ideja i dela Nikole Tesle.</li>

					</ul><br/>

					<p class="text1">U skladu sa prethodnim Fondacija:</p>

					<br/>

					<ul class="lista">



					<li>podstiče i nagrađuje pojedince, grupe autora i organizacije za postignute rezultate u naučno-istraživačkom radu, posebno u primeni naučno-stručnih dostignuća na području tehničkih i prirodnih nauka;</li>



					<li>podstiče i nagrađuje pojedince i grupe autora za racionalizatorske, novatorske i pronalazačke rezultate u materijalnoj proizvodnji i tehnološkom razvoju;</li>



					<li>dodeljuje priznanja i nagrade učenicima i studentima za radove koji doprinose njihovom usmeravanju ka naučno-tehničkom stvaralaštvu i istraživačkom radu;</li>



					<li>inicira akcije za izučavanje i popularisanje stvaralaštva Nikole Tesle učešćem u objavljivanju njegovih dela i ostvarivanjem određenih programa izučavanja naučne i stručne zaostavštine Nikole Tesle i</li>



					<li>učestvuje u organizovanju naučnih i stručnih skupova i akcija posvećenih popularisanju i razvoju nauke i tehnike, stvaralaštvu Nikole Tesle i obeležavanju značajnih datuma iz njegovog života i rada.</li>

					</ul>';

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