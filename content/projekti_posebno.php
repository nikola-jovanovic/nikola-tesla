<?php

$upit = "SELECT * FROM podaci, projekti WHERE podaci.pod_ID = '$project_id' AND projekti.pod_ID ='$project_id'";
$rezultat = mysql_query($upit)
  or die(mysql_error());
$z= mysql_fetch_array($rezultat);
$pocetak=$z['start_datum'];
$zavrsetak=$z['kraj_datum'];
$prikupljeno=$z['trenutna_suma'];
$potrebno=	$z['zahtevana_suma'];				
$pocetak = array_reverse( explode('-', $pocetak) );
$pocetak = implode('.', $pocetak);
$zavr = array_reverse( explode('-', $zavrsetak) );
$zavr = implode('.', $zavr);
echo "<h1>";
echo $z['naslov'];
echo "</h1>";
include 'content/datum-autor.php';
echo'<br/>';
if ($_COOKIE["slova"]=="cirilica") {
	echo "
	<p class=\"text1\"> Датум почетка израде пројекта:&nbsp ".$pocetak.".</p>
	<p class=\"text1\"> Планирани датум завршетка пројекта:&nbsp ".$zavr.".</p>";
}
else{
	echo "
	<p class=\"text1\"> Datum početka izrade projekta:&nbsp ".$pocetak.".</p>
	<p class=\"text1\"> Planirani datum završetka projekta:&nbsp ".$zavr.".</p>";
}

$id=$project_id;
echo "<br/><p class='absMenu'>".$z['abstrakt']."</p>";
include'content/sadrzaj.php';
	
echo'<br/>';


$qu="SELECT COUNT(*) FROM podaci, vesti WHERE projekat_id= '$id' AND odobren='1' AND vesti.pod_ID = podaci.pod_ID ";
$re = mysql_query($qu)
	or die(mysql_error());
	$ukupno=mysql_result($re, 0, 0);

if ($ukupno>0){

	echo "<div class=\"levo\">";
	if ($_COOKIE["slova"]=="cirilica") {echo"<p class=\"naslov\" style=\"text-align:center;\"> Прикупљен новац</p><br/>";}
	else{echo"<p class=\"naslov\" style=\"text-align:center;\"> Prikupljen novac</p><br/>";}

	//termometar
	$iznos =100-floor(($prikupljeno/$potrebno)*100);
	echo '<div class="term">
	<div id="thermometar">
			<div id="iznos" style="height:'.$iznos.'%;"></div>
	</div></div>';
	echo'<div class="term1"><p class="pozicija" style="margin-top:0px;">$'.$potrebno.'</p>';
	$pola=$potrebno/2;
	echo'<p class="pozicija" style="margin-top:105px;">$'.$pola.'</p>
		<p class="pozicija" style="margin-top:105px;">$0</p>
	</div>

	</div>';


	//vesti

	echo "<div class=\"desno\">";
	$tip="vesti";
	if ($_COOKIE["slova"]=="cirilica") { 
		echo "<p class='naslov'><a class=\"naslov\" style=\"text-align:center;\" href=\"projekti.php?type=$tip&id=$project_id\">Вести</a></p>";
	}
	else{
		echo "<p class='naslov'><a class=\"naslov\" style=\"text-align:center;\" href=\"projekti.php?type=$tip&id=$project_id\">Vesti</a></p>";
	}
	echo "<div id=\"news_project\">";

	$query= "SELECT * FROM vesti, podaci WHERE projekat_id= '$project_id' AND odobren='1' AND vesti.pod_ID = podaci.pod_ID ORDER BY datum DESC LIMIT 0, 10";
	$rezultat = mysql_query($query)
				  or die(mysql_error());
	 echo '<marquee scrollamount="1" direction="up" loop="true" height="280px" onmouseover="this.stop();" onmouseout="this.start();">';			  
	while ($z = mysql_fetch_assoc($rezultat)) {
		$a="vest_posebno";
		$b=$z['pod_ID'];
		echo "<p class=\"naslov\"><a class=\"lista\" href=\"projekti.php?type=$a&news_id=$b&project_id=$project_id\">".$z['naslov']."</a></p>";
		echo '<p class="datum_vesti">'.$z['datum'].'</p><br/>';
		echo '<p>'.$z['abstrakt'].'<br/>';
		echo '</p><hr/>';
	}						
	echo "</marquee></div></div>";



	echo '<div style="clear:both"><br/><br/>';

}
else {
	echo"<div style=\"text-align:center; display:block;\" >";
		if ($_COOKIE["slova"]=="cirilica") {echo"<p class=\"naslov\" style=\"text-align:center;\"> Прикупљен новац</p><br/>";}
		else{echo"<p class=\"naslov\" style=\"text-align:center;\"> Prikupljen novac</p><br/>";}
		echo"<div style=\"text-align:center; display:block; margin-left:-30px;\" >";
		//termometar
		$iznos =100-floor(($prikupljeno/$potrebno)*100);
		echo '<div class="term">
		<div id="thermometar">
				<div id="iznos" style="height:'.$iznos.'%;"></div>
		</div></div>';
		echo'<div class="term1"><p class="pozicija" style="margin-top:0px;">$'.$potrebno.'</p>';
		$pola=$potrebno/2;
		echo'<p class="pozicija" style="margin-top:105px;">$'.$pola.'</p>
			<p class="pozicija" style="margin-top:105px;">$0</p>
		</div></div>';
echo '<div style="clear:both"><br/><br/></div>';
}
$danas= date ("Y-m-d");

if ($zavrsetak>=$danas){
	$type="donacija";
	$donacija="Doniraj";
	echo "<div style=\"text-align:center;\"><br/><a id=\"doniraj\"  href=\"donacije.php?projekat_id=$project_id&tip=donacija\">";if ($_COOKIE["slova"]=="cirilica") {echo'Донирај';} else{echo'Doniraj';}echo'</a>';
	echo"</div><br/>";
}
else {echo '<br/>';}
if ($_COOKIE["slova"]=="cirilica") {
echo '<p class="text1">Главни извори прихода Друштва Никола Тесла су донације, поклони, легати и сопствени приходи. Пројекти се релизују у највећем броју случајева помоћу донација. Захваљујемо се свим донаторима који су помогли израду овог пројекта. Списак донатора за овај пројекат можете погледати <a href="#donatori">овде</a>.</p>';

echo '<br/><p class="text1">Сви трошкови пројекта морају бити покривени претходно прорачунатим буџетом за тај пројекат. Буџет пројекта зависи од укупних трошкова инвестиције. Преглед трошкова овог пројекта можете погледати <a href="#troskovi"> овде</a>.</p><br/><br/>';
}
else{
echo '<p class="text1">Glavni izvori prihoda Društva Nikola Tesla su donacije, pokloni, legati i sopstveni prihodi. Projekti se relizuju u najvećem broju slučajeva pomoću donacija. Zahvaljujemo se svim donatorima koji su pomogli izradu ovog projekta. Spisak donatora za ovaj projekat možete pogledati <a href="#donatori">ovde</a>.</p>';

echo '<br/><p class="text1">Svi troškovi projekta moraju biti pokriveni prethodno proračunatim budžetom za taj projekat. Budžet projekta zavisi od ukupnih troškova investicije. Pregled troškova ovog projekta možete pogledati <a href="#troskovi"> ovde</a>.</p><br/><br/>';

}
//donatori na projektu
echo "<p class='naslov'><a  class=\"naslov\" href=\"#\" name=\"donatori\">";if ($_COOKIE["slova"]=="cirilica") {echo "Донатори на пројекту";}else{echo "Donatori na projektu";} echo"</a></p>";
			
echo "<table class=\"tabela\">";
//header tabele
echo "<tr>";
if ($_COOKIE["slova"]=="cirilica") {
	echo "<th class=\"tabela\"> Донатор </th>\n";
	echo "<th class=\"tabela\"> Износ </th>\n";
	echo "<th class=\"tabela\"> Датум</th>\n";
}
else{
	echo "<th class=\"tabela\"> Donator </th>\n";
	echo "<th class=\"tabela\"> Iznos </th>\n";
	echo "<th class=\"tabela\"> Datum</th>\n";
}
echo "</tr>\n";

//ispis podataka
$q = "SELECT * FROM donacije WHERE projekat_id ='$project_id' AND odobreno='1' AND prikaz='1' ORDER BY datum DESC ";
$rez = mysql_query($q)
  or die(mysql_error());
while ($zap= mysql_fetch_array($rez)){
	$donator=$zap['donator'];					  
	$u = "SELECT * FROM korisnici WHERE korisnik ='$donator' ";
	$r = mysql_query($u)
		or die(mysql_error());
	$z= mysql_fetch_array($r);
	$name=$z['Ime'];
	$surname=$z['Prezime'];
	echo "<tr>\n";
	echo "<td class=\"tabela\">\n";
	echo $name; 
	echo "&nbsp";
	echo $surname;
	echo "</td>\n";
	$iznos=$zap['iznos'];
	echo "<td class=\"tabela\">$";
	echo $iznos;
	echo "</td>\n";
	$datum=$zap['datum'];
	$datum = substr($datum, 0, 10);
	$datum = array_reverse( explode('-', $datum) );
	$datum = implode('.', $datum);
	echo "<td class=\"tabela\">\n";
	echo $datum;
	echo ".</td>\n";
	echo "</tr>\n";					  
}
echo "</ul>\n";
$a=$z['projekat_id'];

echo "</table><br/><br/>";

//troskovi na projektu					
if ($_COOKIE["slova"]=="cirilica") {echo "<p class='naslov'><a class=\"naslov\" href=\"#\" name=\"troskovi\">Утрошен новац</a></p>";}
else{echo "<p class='naslov'><a class=\"naslov\" href=\"#\" name=\"troskovi\">Utrošen novac</a></p>";}

echo "<table class=\"tabela\">\n";
//header tabele
echo "<tr>\n";
if ($_COOKIE["slova"]=="cirilica") {
	echo "<th class=\"tabela\"> Трошак </th>\n";
	echo "<th class=\"tabela\"> Износ </th>\n";
	echo "<th class=\"tabela\"> Датум</th>\n";
}
else{
	echo "<th class=\"tabela\"> Trošak </th>\n";
	echo "<th class=\"tabela\"> Iznos </th>\n";
	echo "<th class=\"tabela\"> Datum</th>\n";
}
echo "</tr>\n";
//ispis podataka
$q = "SELECT * FROM troskovi WHERE projekat_id ='$project_id'";
$rez = mysql_query($q)
  or die(mysql_error());
while ($zap= mysql_fetch_array($rez)){
	echo "<tr>\n";
	$trosak=$zap['naziv'];
	echo "<td class=\"tabela\">\n";
	echo $trosak;
	echo "</td>\n";
	$iznos=$zap['iznos'];
	echo "<td class=\"tabela\">$";
	echo $iznos;
	echo "</td>\n";
	$datum=$zap['datum'];
	$datum = array_reverse( explode('-', $datum) );
	$datum = implode('.', $datum);
	echo "<td class=\"tabela\">\n";
	echo $datum;
	echo ".</td>\n";
	echo "</tr>\n";
}
echo "</table>";
echo "<br/></div>";		
include 'content/komentari.php';				

?>
