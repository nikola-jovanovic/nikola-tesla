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
				if($tip=="drustvo"){
					if ($_COOKIE["slova"]=="cirilica") {
					echo'
					<h1>Руководство Друштва Никола Тесла</h1>
					
					<p class="naslov">Председник Управног одбора</p>
					<ul class="lista">
					<li>Радомир М. Наумов (Институт Никола Тесла)</li>
					</ul>
					
					<p class="naslov">Управни одбор</p>
					<ul class="lista">
					<li>Драган Ковачевић (Институт Никола Тесла)</li>
					<li>Владимир Јеленковић (Музеј Николе Тесле)</li>
					<li>Бошко Буха (Електропривреда Србије)</li>
					<li>Милош Недељковић (Машински факултет у Београду)</li>
					<li>Братислав Миловановић (ЕТФ Ниш)</li>
					<li>Александра Смиљанић (ЕТФ Београд)</li>
					<li>Јован Цветић (ЕТФ Београд)</li>
					<li>Милун Бабић (Машински факултет у Крагујевцу)</li>
					<li>Радомир М. Наумов (Институт Никола Тесла)</li>
					</ul>
					
					<p class="naslov">Predsednik Nadzornog odbora</p>
					<ul class="lista">
					<li>Милољуб Смиљанић (АИНС)</li>
					</ul>
					
					<p class="naslov">Надзорни одбор</p>
					<ul class="lista">
					<li>Милољуб Смиљанић (АИНС)</li>
					<li>Небојша Јовичић (Машински факултет, Крагујевац)</li>
					<li>Сандра Лучић (Институт Никола Тесла)</li>
					</ul>';
					}
					else{
					echo'
					<h1>Rukovodstvo Društva Nikola Tesla</h1>
					
					<p class="naslov">Predsednik Upravnog odbora</p>
					<ul class="lista">
					<li>Radomir M. Naumov (Institut Nikola Tesla)</li>
					</ul>
					
					<p class="naslov">Upravni odbor</p>
					<ul class="lista">
					<li>Dragan Kovačević (Institut Nikola Tesla)</li>
					<li>Vladimir Jelenković (Muzej Nikole Tesle)</li>
					<li>Boško Buha (Elektroprivreda Srbije)</li>
					<li>Miloš Nedeljković (Mašinski fakultet u Beogradu)</li>
					<li>Bratislav Milovanović (ETF Niš)</li>
					<li>Aleksandra Smiljanić (ETF Beograd)</li>
					<li>Jovan Cvetić (ETF Beograd)</li>
					<li>Milun Babić (Mašinski fakultet u Kragujevcu)</li>
					<li>Radomir M. Naumov (Institut Nikola Tesla)</li>
					</ul>
					
					<p class="naslov">Predsednik Nadzornog odbora</p>
					<ul class="lista">
					<li>Miloljub Smiljanić (AINS)</li>
					</ul>
					
					<p class="naslov">Nadzorni odbor</p>
					<ul class="lista">
					<li>Miloljub Smiljanić (AINS)</li>
					<li>Nebojša Jovičić (Mašinski fakultet, Kragujevac)</li>
					<li>Sandra Lučić (Institut Nikola Tesla)</li>
					</ul>';
					}
					}
					
					else if($tip=="fondacija"){
					if ($_COOKIE["slova"]=="cirilica") {
					echo'
					<h1>Руководство Фондације Никола Тесла</h1>
					
					<p class="naslov">Председник Фондације</p>
					<ul class="lista">
					<li>Милун Бабић (Машински факултет у Крагујевцу)</li>
					</ul>
					
					
					<p class="naslov">Председник Управног одбора</p>
					<ul class="lista">
					<li>Милорад Марковић (Минел Холдинг)</li>
					</ul>
					
					<p class="naslov">Управни одбор</p>
					<ul class="lista">
					
					<li>Емилија Турковић (Институт Никола Тесла)</li>
					<li>Милорад Марковић (Минел Холдинг)</li>
					<li>Љубомир Лукић (АБС Минел)</li>
					<li>Глиша Класнић (ТЕНТ)</li>
					<li>Нинко Радивојевић (ИРИТЕЛ)</li>
					<li>Мирослав Копечни (Влада Србије)</li>
					<li>Миленко Николић (Институт Михаило Пупин)</li>
					<li>Владимир Стрезоски (ЕТФ Нови Сад)</li>
					<li>Владислав Лучић (Телеком)</li>
					<li>Радомир М. Наумов (Институт Никола Тесла)</li>
					</ul>
					
					<p class="naslov">Predsednik Nadzornog odbora</p>
					<ul class="lista">
					<li>Милољуб Смиљанић (АИНС)</li>
					</ul> 
					
					<p class="naslov">Nadzorni odbor</p>
					<ul class="lista">
					<li>Милољуб Смиљанић (АИНС)</li>
					<li>Небојша Јовичић (Машински факултет, Крагујевац)</li>
					<li>Сандра Лучић (Институт Никола Тесла)</li>
					</ul>';
					
					}
					else{
					echo'
					<h1>Rukovodstvo Fondacije Nikola Tesla</h1>
					
					<p class="naslov">Predsednik Fondacije</p>
					<ul class="lista">
					<li>Milun Babić (Mašinski fakultet u Kragujevcu)</li>
					</ul>
					
					
					<p class="naslov">Predsednik Upravnog odbora</p>
					<ul class="lista">
					<li>Milorad Marković (Minel Holding)</li>
					</ul>
					
					<p class="naslov">Upravni odbor</p>
					<ul class="lista">
					
					<li>Emilija Turković (Institut Nikola Tesla)</li>
					<li>Milorad Marković (Minel Holding)</li>
					<li>Ljubomir Lukić (ABS Minel)</li>
					<li>Gliša Klasnić (TENT)</li>
					<li>Ninko Radivojević (IRITEL)</li>
					<li>Miroslav Kopečni (Vlada Srbije)</li>
					<li>Milenko Nikolić (Institut Mihailo Pupin)</li>
					<li>Vladimir Strezoski (ETF Novi Sad)</li>
					<li>Vladislav Lučić (Telekom)</li>
					<li>Radomir M. Naumov (Institut Nikola Tesla)</li>
					</ul>
					
					<p class="naslov">Predsednik Nadzornog odbora</p>
					<ul class="lista">
					<li>Miloljub Smiljanić (AINS)</li>
					</ul> 
					
					<p class="naslov">Nadzorni odbor</p>
					<ul class="lista">
					<li>Miloljub Smiljanić (AINS)</li>
					<li>Nebojša Jovičić (Mašinski fakultet, Kragujevac)</li>
					<li>Sandra Lučić (Institut Nikola Tesla)</li>
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