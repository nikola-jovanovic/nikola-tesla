<?php
$id_korisnika=$za['korisnik'];
$q= "SELECT * FROM korisnici WHERE korisnik= '$id_korisnika' ";
$r = mysql_query($q)
		  or die(mysql_error());
$za = mysql_fetch_assoc($r);
 
 $c_opis=$za['c_opis'];
 if($c_opis){
 echo "<br/><br/><hr/><br/><p class='text1'><b>Napisao:</b> ".$za['opis']."</p>";
  }
?>