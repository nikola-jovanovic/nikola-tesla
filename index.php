<?php
	include 'includes/configuration.php';
	include 'includes/router.php';
	$dbh = Database::getInstance($_COOKIE["slova"]);
	// $dbh1 = Database::getInstance('latinica');
	// $dbh1 = Database::getInstance('latinica');
	// $vars = get_class_vars("Database");
	// var_dump($vars);
	include 'includes/head.php';
	// include 'includes/brisanje.php';
	var_dump($_COOKIE["slova"]);
?>
	<body>
		<div class="wrapper">
			<?php
				include 'includes/login.php';
				include 'includes/header.php';
			?>
			<div class="main">
				<?php
					include 'includes/pics.php';
					include 'includes/vesti.php';
				?>
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
							var_dump($request);
							var_dump($page);
							var_dump($parsed);
							var_dump($getVars);
							if($page == 'naslovna' || $page == ''){
								if ($_COOKIE["slova"]=="cirilica") {
								echo '<h1>Добродошли</h1>';
								echo '<p>Друштво и фондација Никола Тесла је веб портал посвећен нашем највећем научнику из области електротехнике. Сазнајте више о Николи Тесли, његовом животу и делу. 
									На овом месту можете наћи бројне вести, прилоге, изјаве, књиге о Николи Тесли, као и бројне проналаске, патенте, пројекте.</p><br/>
									<p>Региструјте се, постаните члан друштва, пишите разне вести, прилоге, донирајте, будите у току са најновијим вестима из разних пројеката. </p>';
								}
								else{
									echo '<h1>Dobrodošli </h1>';
									echo '<p>Društvo i fondacija Nikola Tesla je veb portal posvećen našem najvećem naučniku iz oblasti elektrotehnike.
										Saznajte više o Nikoli Tesli, njegovom životu i delu. 
										Na ovom mestu možete naći brojne vesti, priloge, izjave, knjige o Nikoli Tesli, kao i brojne pronalaske, patente, projekte.</p><br/>
										<p>Registrujte se, postanite član društva, pišite razne vesti, priloge, donirajte, budite u toku sa najnovijim 
										vestima iz raznih projekata. </p>';
								}
							}
							else{
								//compute the path to the file
								if($page == 'donatori'){
									if($getVars['tip'] == 'institucioni'){
										$target = 'content/donatori_institucioni.php';
									}
									elseif($getVars['tip'] == 'individualni'){
										$target = 'content/donatori_individualni.php';
									}
								}
								else{
									$target = 'content/' . $page . '.php';
								}

								//get target
								if (file_exists($target)) {
								    include_once($target);
								}
								else {
									//can't find the file in 'controllers'! 
									die('page does not exist!');
								}
							}
						?>	
					</div>
				</div>
			</div>
			<?php
				include 'includes/footer.php';
			?>
		</div>
	</body>
</html>