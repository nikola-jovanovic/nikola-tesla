<?php
//ĆIRILICA
if ($_COOKIE["slova"]=="cirilica") {
echo '<ul id = "navigacija">
	<li><a class="expand" href="#" >Награда Никола Тесла</a>
	<ul>
		<li><a '; if( $page == 'nagrade') {echo ' class="active"';} echo 'href="nagrade">Награђени</a></li>
		<li><a '; if( $page == 'konkursi'){echo '  class="active"';} echo 'href="konkursi">Конкурси</a></li>
	</ul></li>
	<li><a '; if( $page == 'nikolatesla') {echo 'class="active"';} echo 'href="nikolatesla">Никола Тесла</a></li>
	<li><a '; if( $page == 'knjige') {echo 'class="active"';} echo 'href="knjige">Књиге о Тесли</a></li>
	<li><a '; if( $page == 'patenti'){echo 'class="active"';} echo 'href="patenti">Теслини патенти</a></li>
	<li class="bolt"><img src="images/bolt.png" alt="munja"/></li>
	<li><a '; if( $page == 'vesti') {echo 'class="active"';} echo 'name="vesti" href="vesti">Вести</a></li>
	<li><a '; if( $page == 'poznati'){echo 'class="active"';} echo 'href="poznati">Познати о Тесли</a></li>
	<li><a '; if( $page == 'prilozi'){echo 'class="active"';} echo 'href="prilozi">Прилози о Тесли</a></li>
	<li><a class="expand" href="#">Акције</a>
		<ul>
			<li><a '; if( $page == 'dogadjaji') {echo 'class="active"';} echo 'href="dogadjaji">Догађаји</a></li>
			<li><a '; if( $page == 'projekti') {echo 'class="active"';} echo ' href="projekti">Пројекти</a>';
				/*<ul>
					<li><a '; if( $fileName == 'projekti.php' && $_GET['type'] == 'tekuci') {echo 'class="active"';} echo 'href="projekti.php?type=tekuci">Текући</a></li>
					<li><a '; if( $fileName == 'projekti.php' && $_GET['type'] == 'buduci'){echo 'class="active"';} echo 'href="projekti.php?type=buduci">Будући</a></li>
					<li><a ';  if( $fileName == 'projekti.php' && $_GET['type'] == 'prethodni') {echo 'class="active"';} echo 'href="projekti.php?type=prethodni">Завршени</a></li>
				</ul>*/
		echo'</li>
			<li><a ';  if( $page == 'donacije') {echo 'class="active"';} echo 'href="donacije">Донирај</a></li>
			<li><a ';if( $page == 'clanarina' ) {echo 'class="active"';}	echo "href='clanarina'>Плати чланарину</a></li>";
				
		echo'	
		</ul>
	</li>
	<li><a class="expand" href="#">Донатори</a>
		<ul>
			<li><a '; if( $page == 'donatori' && $_GET['tip'] == 'institucioni') {echo 'class="active"';} echo 'href="donatori/institucioni">Институциони</a></li>
			<li><a '; if( $page == 'donatori' && $_GET['tip'] == 'individualni') {echo 'class="active"';} echo 'href="donatori/individualni">Индивидуални</a></li>
		</ul>
	</li>';
	
		
		echo"<li><a ";
		if( $page == 'clanovi') echo 'class="active"';
		echo "href='clanovi'>Чланови</a></li>";
		
	
		// ispis menija za administratora
		if( $_SESSION['valid_user'] == 'admin'){
			echo '<li><a ';
			if( $fileName == 'korisnici.php') echo 'class="active" ';
			echo 'href="korisnici.php">Корисници</a></li>';
			
		}
		// ispis menija za korisnika
		$user = $_SESSION['valid_user'];
		if($user){
		
		
		$query = "SELECT * FROM korisnici WHERE korisnik = '$user'";
			$result = mysql_query($query);
			$br_rezultata = mysql_num_rows($result);
			if($br_rezultata != 0){ 
				
					echo '<li><a class="expand" href="#">Унеси материјал</a>';
				
				
				echo '<ul>';
				$red = mysql_fetch_array($result);
				$priv = explode(',', $red['privilegija']);
				
			for($i=0; $i < count($priv); $i++ ){
				if($priv[$i] > 9) $azuriraj = 1;				
				$query = "SELECT opis FROM privilegije WHERE pri_ID = '".$priv[$i]."'";
				$result = mysql_query($query);
				$red = mysql_fetch_array($result);
				if( $red[0]== 'Unesi prilog' || $red[0]== 'Унеси прилог' ){
					echo "<li><a ";
					if( $page == 'unesi' && $_GET['tip'] == 'prilog') echo ' class="active" ';
					echo "href='unesi/prilog'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Unesi vest' || $red[0]== 'Унеси вест' ){
					echo "<li><a ";
					if( $page == 'unesi' && $_GET['tip'] == 'vest') echo ' class="active" ';
					echo "href='unesi/vest'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Unesi događaj' || $red[0]== 'Унеси догађај' ){
					echo "<li><a ";
					if( $page == 'unesi' && $_GET['tip'] == 'dogadjaj') echo ' class="active" ';
					echo "href='unesi/dogadjaj'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Unesi patent' || $red[0]== 'Унеси патент' ){
					echo "<li><a ";
					if( $page == 'unesi' && $_GET['tip'] == 'patent') echo ' class="active" ';
					echo "href='unesi/patent'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Unesi knjigu' || $red[0]== 'Унеси књигу' ){
					echo "<li><a ";
					if( $page == 'unesi' && $_GET['tip'] == 'knjiga') echo ' class="active" ';
					echo 'href="unesi/knjiga">'.$red[0].'</a></li>';
				}
				if( $red[0]== 'Unesi izjavu' || $red[0]== 'Унеси изјаву' ){
					echo "<li><a ";
					if( $page == 'unesi' && $_GET['tip'] == 'izjava') echo ' class="active" ';
					echo "href='unesi/izjava'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Unesi nagradu' || $red[0]== 'Унеси награду' ){
					echo "<li><a ";
					if( $page == 'unesi' && $_GET['tip'] == 'nagrada') echo ' class="active" ';
					echo "href='unesi/nagrada'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Unesi projekat' || $red[0]== 'Унеси пројекат' ){
					echo "<li><a ";
					if( $page == 'unesi' && $_GET['tip'] == 'projekat') echo ' class="active" ';
					echo "href='unesi/projekat'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Unesi pravni akt' || $red[0]== 'Унеси правни акт' ){
					echo "<li><a ";
					if( $page == 'unesi' && $_GET['tip'] == 'pravni_akt') echo ' class="active" ';
					echo "href='unesi/pravni_akt'>".$red[0]."</a></li>";
				}	
			}
					
			echo '</ul></li>';
			}
			
			if($azuriraj == 1){ 
				if ($_COOKIE["slova"]=="cirilica") {
					echo '<li><a class="expand" href="#">Ажурирај материјалe</a>';
					}
				else{
					echo '<li><a class="expand" href="#">Ažuriraj materijale</a>';
				}
				echo '<ul>';
			
			for($i=0; $i < count($priv); $i++ ){
				$query = "SELECT opis FROM privilegije WHERE pri_ID = '".$priv[$i]."'";
				$result = mysql_query($query);
				$red = mysql_fetch_array($result);
				if( $red[0]== 'Ažuriraj prilog' || $red[0]== 'Ажурирај прилог' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'prilog') echo ' class="active" ';
					echo " href='azuriranje.php?type=prilog'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Ažuriraj vest' || $red[0]== 'Ажурирај вест' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'vesti') echo ' class="active" ';
					echo " href='azuriranje.php?type=vesti'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Ažuriraj događaj' || $red[0]== 'Ажурирај догађај' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'dogadjaj') echo ' class="active" ';
					echo " href='azuriranje.php?type=dogadjaj'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Ažuriraj patent' || $red[0]== 'Ажурирај патент' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'patent') echo ' class="active" ';
					echo " href='azuriranje.php?type=patent'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Ažuriraj knjigu' || $red[0]== 'Ажурирај књигу' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'knjiga') echo ' class="active" ';
					echo " href='azuriranje.php?type=knjiga'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Ažuriraj izjavu' || $red[0]== 'Ажурирај изјаву' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'izjava') echo ' class="active" ';
					echo " href='azuriranje.php?type=izjava'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Ažuriraj nagradu' || $red[0]== 'Ажурирај награду' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'nagrada') echo ' class="active" ';
					echo " href='azuriranje.php?type=nagrada'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Ažuriraj projekat' || $red[0]== 'Ажурирај пројекат' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'projekat') echo ' class="active" ';
					echo " href='azuriranje.php?type=projekat'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Ažuriraj pravni akt' || $red[0]== 'Ажурирај правни акт' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'pravni_akt') echo ' class="active" ';
					echo " href='azuriranje.php?type=pravni_akt'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Ažuriraj parametre' || $red[0]== 'Ажурирај параметре' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'parametri') echo ' class="active" ';
					echo " href='azuriranje.php?parametri=1'>".$red[0]."</a></li>";
				}			
			}
			
			echo '</ul></li>';
			}
			$query = "SELECT DISTINCT tip_unosa FROM podaci WHERE korisnik = '$user'";
			$result = mysql_query($query);
			$br_rezultata = mysql_num_rows($result);
			if($br_rezultata != 0){ 
				if ($_COOKIE["slova"]=="cirilica") {
					echo '<li><a class="expand" href="#">Моји материјали</a>';
				}
				else{
					echo '<li><a class="expand" href="#">Moji materijali</a>';
				}
				echo '<ul>';
				for($i=0; $i < $br_rezultata; $i++ ){
					$red = mysql_fetch_array($result);
					if( $red[0]== 'prilog'){
						echo "<li><a";
						if( $fileName == 'materijali.php' && $_GET['type'] == 'prilog') echo ' class="active" ';
						echo " href='materijali.php?type=prilog'>Моји прилози</a></li>";
					}
					if( $red[0]== 'vesti'){
						echo "<li><a";
						if( $fileName == 'materijali.php' && $_GET['type'] == 'vesti') echo ' class="active" ';
						echo " href='materijali.php?type=vesti'>Моје вести</a></li>";
					}
					if( $red[0]== 'dogadjaj'){
						echo "<li><a";
						if( $fileName == 'materijali.php' && $_GET['type'] == 'dogadjaj') echo ' class="active" ';
						echo " href='materijali.php?type=dogadjaj'>Моји догађаји</a></li>";
					}
					if( $red[0]== 'patent'){
						echo "<li><a";
						if( $fileName == 'materijali.php' && $_GET['type'] == 'patent') echo ' class="active" ';
						echo " href='materijali.php?type=patent'>Моји патенти</a></li>";
					}
					if( $red[0]== 'knjiga'){
						echo "<li><a";
						if( $fileName == 'materijali.php' && $_GET['type'] == 'knjiga') echo ' class="active" ';
						echo " href='materijali.php?type=knjiga'>Моје књиге</a></li>";
					}
					if( $red[0]== 'izjava'){
						echo "<li><a";
						if( $fileName == 'materijali.php' && $_GET['type'] == 'izjava') echo ' class="active" ';
						echo " href='materijali.php?type=izjava'>Моје изјаве</a></li>";
					}
					if( $red[0]== 'nagrada'){
						echo "<li><a";
						if( $fileName == 'materijali.php' && $_GET['type'] == 'nagrada') echo ' class="active" ';
						echo " href='materijali.php?type=nagrada'>Моје награде</a></li>";
					}
					if( $red[0]== 'projekat'){
						echo "<li><a";
						if( $fileName == 'materijali.php' && $_GET['type'] == 'projekat') echo ' class="active" ';
						echo " href='materijali.php?type=projekat'>Моји пројекти</a></li>";
					}
					if( $red[0]== 'pravni_akt'){
						echo "<li><a";
						if( $fileName == 'materijali.php' && $_GET['type'] == 'pravni_akt') echo ' class="active" ';
						echo " href='materijali.php?type=pravni_akt'>Моји правни акти</a></li>";
					}
				}
				echo '</ul></li>';
			}
			$query = "SELECT COUNT(*) FROM komentari WHERE korisnik = '".$user."' ";
			$result = mysql_query($query);
			$ukupno = mysql_result($result, 0, 0);
			if ($ukupno!=0){
				echo "<li><a ";
				if( $fileName == 'mojikomentari.php') echo ' class="active" ';
				if ($_COOKIE["slova"]=="cirilica") {
					echo ' href="mojikomentari.php">Моји коментари</a></li>';
				}
				else{
					echo 'href="mojikomentari.php">Moji komentari</a></li>';
				}
			}
		}

		// ispis menija za administratora
		if( $_SESSION['valid_user'] == 'admin'){
			// ispis menija za administratora - dodeljivanje privilegija korisnicima
			echo '<li><a ';
			if( $fileName == 'dodeliPrivilegije.php') echo 'class="active" ';
			echo 'href="dodeliPrivilegije.php">Додели привилегије</a></li>';

			// ispis menija za administratora - dodeljivanje materijala korisnicima
			echo '<li><a ';
			if( $fileName == 'dodeliMaterijale.php') echo 'class="active" ';
			echo 'href="dodeliMaterijale.php">Додели материјале</a></li>';

			// ispis menija za administratora - odobri uplate
			echo '<li><a class="expand" href="#">Одобри уплате</a>
					<ul>
						<li><a ';
			if( $fileName == 'uplate.php' && $_GET['tip'] =='clanarine') echo 'class="active" ';
			echo 'href="uplate.php?tip=clanarine">Чланарине</a></li>
						<li><a ';
			if( $fileName == 'uplate.php' && $_GET['tip'] =='donacije') echo 'class="active" ';
			echo 'href="uplate.php?tip=donacije">Донације</a></li>
					</ul>
				  </li>';		
		}
	echo'
</ul>';
}

//LATINICA
else{
echo '<ul id = "navigacija">
	<li><a class="expand" href="#" >Nagrada Nikola Tesla</a>
	<ul>
		<li><a '; if( $fileName == 'nagradaNikolaTesla.php' && $_GET['tip'] == 'nagradjeni') {echo 'class="active"';} echo 'href="nagradaNikolaTesla.php?tip=nagradjeni">Nagrađeni</a></li>
		<li><a '; if( $fileName == 'nagradaNikolaTesla.php' && $_GET['tip'] == 'konkursi'){echo 'class="active"';} echo 'href="nagradaNikolaTesla.php?tip=konkursi">Konkursi</a></li>
	</ul></li>
	<li><a '; if( $fileName == 'nikolatesla.php') {echo 'class="active"';} echo 'href="nikolatesla.php">Nikola Tesla</a></li>
	<li><a '; if( $fileName == 'knjige.php') {echo 'class="active"';} echo 'href="knjige.php">Knjige o Tesli</a></li>
	<li><a '; if( $fileName == 'patenti.php'){echo 'class="active"';} echo 'href="patenti.php">Teslini patenti</a></li>
	<li class="bolt"><img src="images/bolt.png" alt="munja"/></li>
	<li><a '; if( $fileName == 'vesti.php') {echo 'class="active"';} echo 'name="vesti" href="vesti.php">Vesti</a></li>
	<li><a '; if( $fileName == 'poznati.php'){echo 'class="active"';} echo 'href="poznati.php">Poznati o Tesli</a></li>
	<li><a '; if( $fileName == 'prilozi.php'){echo 'class="active"';} echo 'href="prilozi.php">Prilozi o Tesli</a></li>
	<li><a class="expand" href="#">Akcije</a>
		<ul>
			<li><a '; if( $fileName == 'dogadjaji.php') {echo 'class="active"';} echo 'href="dogadjaji.php">Događaji</a></li>
			<li><a '; if( $fileName == 'projekti.php') {echo 'class="active"';} echo ' href="projekti.php">Projekti</a>';
				/*<ul>
					<li><a '; if( $fileName == 'projekti.php' && $_GET['type'] == 'tekuci') {echo 'class="active"';} echo 'href="projekti.php?type=tekuci">Tekući</a></li>
					<li><a '; if( $fileName == 'projekti.php' && $_GET['type'] == 'buduci'){echo 'class="active"';} echo 'href="projekti.php?type=buduci">Budući</a></li>
					<li><a ';  if( $fileName == 'projekti.php' && $_GET['type'] == 'prethodni') {echo 'class="active"';} echo 'href="projekti.php?type=prethodni">Završeni</a></li>
				</ul>*/
		echo'</li>
			<li><a ';  if( $fileName == 'donacije.php') {echo 'class="active"';} echo 'href="donacije.php">Doniraj</a></li>
			<li><a ';if( $fileName == 'clanarina.php' ) {echo 'class="active"';}	echo "href='clanarina.php'>Plati članarinu</a></li>";
			
		echo'	
		</ul>
	</li>
	<li><a class="expand" href="#">Donatori</a>
		<ul>
			<li><a '; if( $fileName == 'donatori.php' && $_GET['tip'] == 'institucioni') {echo 'class="active"';} echo 'href="donatori.php?tip=institucioni">Institucioni</a></li>
			<li><a '; if( $fileName == 'donatori.php' && $_GET['tip'] == 'individualni') {echo 'class="active"';} echo 'href="donatori.php?tip=individualni">Individualni</a></li>
		</ul>
	</li>';
	
		echo"<li><a ";
		if( $fileName == 'clanovi.php') echo 'class="active"';
		echo "href='clanovi.php'>Članovi</a></li>";
	
		// ispis menija za administratora
		if( $_SESSION['valid_user'] == 'admin'){
			echo '<li><a ';
			if( $fileName == 'korisnici.php') echo 'class="active"';
			echo 'href="korisnici.php">Korisnici</a></li>';
			
		}
		// ispis menija za korisnika
		$user = $_SESSION['valid_user'];
		if($user){
		
		
		$query = "SELECT * FROM korisnici WHERE korisnik = '$user'";
			$result = mysql_query($query);
			$br_rezultata = mysql_num_rows($result);
			if($br_rezultata != 0){ 
				if ($_COOKIE["slova"]=="cirilica") {
					echo '<li><a class="expand" href="#">Унеси материјал</a>';
					}
				else{
					echo '<li><a class="expand" href="#">Unesi materijal</a>';
				}
				echo '<ul>';
				$red = mysql_fetch_array($result);
				$priv = explode(',', $red['privilegija']);
				
			for($i=0; $i < count($priv); $i++ ){
				if($priv[$i] > 9) $azuriraj = 1; 			
				$query = "SELECT opis FROM privilegije WHERE pri_ID = '".$priv[$i]."'";
				$result = mysql_query($query);
				$red = mysql_fetch_array($result);
				if( $red[0]== 'Unesi prilog' || $red[0]== 'Унеси прилог' ){
					echo "<li><a ";
					if( $fileName == 'unos.php' && $_GET['tip'] == 'prilog') echo ' class="active" ';
					echo "href='unos.php?tip=prilog'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Unesi vest' || $red[0]== 'Унеси вест' ){
					echo "<li><a ";
					if( $fileName == 'unos.php' && $_GET['tip'] == 'vesti') echo ' class="active" ';
					echo "href='unos.php?tip=vesti'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Unesi događaj' || $red[0]== 'Унеси догађај' ){
					echo "<li><a ";
					if( $fileName == 'unos.php' && $_GET['tip'] == 'dogadjaj') echo ' class="active" ';
					echo "href='unos.php?tip=dogadjaj'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Unesi patent' || $red[0]== 'Унеси патент' ){
					echo "<li><a ";
					if( $fileName == 'unos.php' && $_GET['tip'] == 'patent') echo ' class="active" ';
					echo "href='unos.php?tip=patent'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Unesi knjigu' || $red[0]== 'Унеси књигу' ){
					echo "<li><a ";
					if( $fileName == 'unos.php' && $_GET['tip'] == 'knjiga') echo ' class="active" ';
					echo 'href="unos.php?tip=knjiga">'.$red[0].'</a></li>';
				}
				if( $red[0]== 'Unesi izjavu' || $red[0]== 'Унеси изјаву' ){
					echo "<li><a ";
					if( $fileName == 'unos.php' && $_GET['tip'] == 'izjava') echo ' class="active" ';
					echo "href='unos.php?tip=izjava'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Unesi nagradu' || $red[0]== 'Унеси награду' ){
					echo "<li><a ";
					if( $fileName == 'unos.php' && $_GET['tip'] == 'nagrada') echo ' class="active" ';
					echo "href='unos.php?tip=nagrada'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Unesi projekat' || $red[0]== 'Унеси пројекат' ){
					echo "<li><a ";
					if( $fileName == 'unos.php' && $_GET['tip'] == 'projekat') echo ' class="active" ';
					echo "href='unos.php?tip=projekat'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Unesi pravni akt' || $red[0]== 'Унеси правни акт' ){
					echo "<li><a ";
					if( $fileName == 'unos.php' && $_GET['tip'] == 'pravni_akt') echo ' class="active" ';
					echo "href='unos.php?tip=pravni_akt'>".$red[0]."</a></li>";
				}	
			}
					
			echo '</ul></li>';
			}

			if($azuriraj == 1){ 
				if ($_COOKIE["slova"]=="cirilica") {
					echo '<li><a class="expand" href="#">Ажурирај материјалe</a>';
					}
				else{
					echo '<li><a class="expand" href="#">Ažuriraj materijale</a>';
				}
				echo '<ul>';
			
			for($i=0; $i < count($priv); $i++ ){
				$query = "SELECT opis FROM privilegije WHERE pri_ID = '".$priv[$i]."'";
				$result = mysql_query($query);
				$red = mysql_fetch_array($result);
				if( $red[0]== 'Ažuriraj prilog' || $red[0]== 'Ажурирај прилог' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'prilog') echo ' class="active" ';
					echo " href='azuriranje.php?type=prilog'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Ažuriraj vest' || $red[0]== 'Ажурирај вест' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'vesti') echo ' class="active" ';
					echo " href='azuriranje.php?type=vesti'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Ažuriraj događaj' || $red[0]== 'Ажурирај догађај' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'dogadjaj') echo ' class="active" ';
					echo " href='azuriranje.php?type=dogadjaj'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Ažuriraj patent' || $red[0]== 'Ажурирај патент' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'patent') echo ' class="active" ';
					echo " href='azuriranje.php?type=patent'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Ažuriraj knjigu' || $red[0]== 'Ажурирај књигу' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'knjiga') echo ' class="active" ';
					echo " href='azuriranje.php?type=knjiga'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Ažuriraj izjavu' || $red[0]== 'Ажурирај изјаву' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'izjava') echo ' class="active" ';
					echo " href='azuriranje.php?type=izjava'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Ažuriraj nagradu' || $red[0]== 'Ажурирај награду' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'nagrada') echo ' class="active" ';
					echo " href='azuriranje.php?type=nagrada'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Ažuriraj projekat' || $red[0]== 'Ажурирај пројекат' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'projekat') echo ' class="active" ';
					echo " href='azuriranje.php?type=projekat'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Ažuriraj pravni akt' || $red[0]== 'Ажурирај правни акт' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'pravni_akt') echo ' class="active" ';
					echo " href='azuriranje.php?type=pravni_akt'>".$red[0]."</a></li>";
				}
				if( $red[0]== 'Ažuriraj parametre' || $red[0]== 'Ажурирај параметре' ){
					echo "<li><a";
					if( $fileName == 'azuriranje.php' && $_GET['type'] == 'parametri') echo ' class="active" ';
					echo " href='azuriranje.php?parametri=1'>".$red[0]."</a></li>";
				}			
			}
			
			echo '</ul></li>';
			}
			$query = "SELECT DISTINCT tip_unosa FROM podaci WHERE korisnik = '$user'";
			$result = mysql_query($query);
			$br_rezultata = mysql_num_rows($result);
			if($br_rezultata != 0){ 
				if ($_COOKIE["slova"]=="cirilica") {
					echo '<li><a class="expand" href="#">Моји материјали</a>';
				}
				else{
					echo '<li><a class="expand" href="#">Moji materijali</a>';
				}
				echo '<ul>';
				for($i=0; $i < $br_rezultata; $i++ ){
					$red = mysql_fetch_array($result);
					if( $red[0]== 'prilog'){
						echo "<li><a";
						if( $fileName == 'materijali.php' && $_GET['type'] == 'prilog') echo ' class="active" ';
						echo " href='materijali.php?type=prilog'>Moji prilozi</a></li>";
					}
					if( $red[0]== 'vesti'){
						echo "<li><a";
						if( $fileName == 'materijali.php' && $_GET['type'] == 'vesti') echo ' class="active" ';
						echo " href='materijali.php?type=vesti'>Moje vesti</a></li>";
					}
					if( $red[0]== 'dogadjaj'){
						echo "<li><a";
						if( $fileName == 'materijali.php' && $_GET['type'] == 'dogadjaj') echo ' class="active" ';
						echo " href='materijali.php?type=dogadjaj'>Moji događaji</a></li>";
					}
					if( $red[0]== 'patent'){
						echo "<li><a";
						if( $fileName == 'materijali.php' && $_GET['type'] == 'patent') echo ' class="active" ';
						echo " href='materijali.php?type=patent'>Moji patenti</a></li>";
					}
					if( $red[0]== 'knjiga'){
						echo "<li><a";
						if( $fileName == 'materijali.php' && $_GET['type'] == 'knjiga') echo ' class="active" ';
						echo " href='materijali.php?type=knjiga'>Moje knjige</a></li>";
					}
					if( $red[0]== 'izjava'){
						echo "<li><a";
						if( $fileName == 'materijali.php' && $_GET['type'] == 'izjava') echo ' class="active" ';
						echo " href='materijali.php?type=izjava'>Moje izjave</a></li>";
					}
					if( $red[0]== 'nagrada'){
						echo "<li><a";
						if( $fileName == 'materijali.php' && $_GET['type'] == 'nagrada') echo ' class="active" ';
						echo " href='materijali.php?type=nagrada'>Moje nagrade</a></li>";
					}
					if( $red[0]== 'projekat'){
						echo "<li><a";
						if( $fileName == 'materijali.php' && $_GET['type'] == 'projekat') echo ' class="active" ';
						echo " href='materijali.php?type=projekat'>Moji projekti</a></li>";
					}
					if( $red[0]== 'pravni_akt'){
						echo "<li><a";
						if( $fileName == 'materijali.php' && $_GET['type'] == 'pravni_akt') echo ' class="active" ';
						echo " href='materijali.php?type=pravni_akt'>Moji pravni akti</a></li>";
					}
				}
				echo '</ul></li>';
			}
			$query = "SELECT COUNT(*) FROM komentari WHERE korisnik = '".$user."' ";
			$result = mysql_query($query);
			$ukupno = mysql_result($result, 0, 0);
			if ($ukupno!=0){
				echo "<li><a ";
				if( $fileName == 'mojikomentari.php') echo ' class="active" ';
				if ($_COOKIE["slova"]=="cirilica") {
					echo ' href="mojikomentari.php">Моји коментари</a></li>';
				}
				else{
					echo 'href="mojikomentari.php">Moji komentari</a></li>';
				}
			}
		}

		// ispis menija za administratora
		if( $_SESSION['valid_user'] == 'admin'){
			// ispis menija za administratora - dodeljivanje privilegija korisnicima
			echo '<li><a ';
			if( $fileName == 'dodeliPrivilegije.php') echo 'class="active" ';
			echo 'href="dodeliPrivilegije.php">Dodeli privilegije</a></li>';

			// ispis menija za administratora - dodeljivanje materijala korisnicima
			echo '<li><a ';
			if( $fileName == 'dodeliMaterijale.php') echo 'class="active" ';
			echo 'href="dodeliMaterijale.php">Dodeli materijale</a></li>';

			// ispis menija za administratora - odobri uplate
			echo '<li><a class="expand" href="#">Odobri uplate</a>
					<ul>
						<li><a ';
			if( $fileName == 'uplate.php' && $_GET['tip'] =='clanarine') echo 'class="active" ';
			echo 'href="uplate.php?tip=clanarine">Članarine</a></li>
						<li><a ';
			if( $fileName == 'uplate.php' && $_GET['tip'] =='donacije') echo 'class="active" ';
			echo 'href="uplate.php?tip=donacije">Donacije</a></li>
					</ul>
				  </li>';		
		}
	echo'
</ul>';


}
?>
