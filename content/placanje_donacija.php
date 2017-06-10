<?php
	
if($project_id){	
	if ($_COOKIE["slova"]=="cirilica") {	echo "<h1>Ваша донација</h1>";}
	else{ echo "<h1>Vaša donacija</h1>"; }
	
	if($project_id=="drustvo"){
		if ($_COOKIE["slova"]=="cirilica") {	$naslov="Друштво Никола Тесла";}
		else{ $naslov="Društvo Nikola Tesla"; }		
		$project_id=0;
}
else{
	$upit = "SELECT * FROM projekti  WHERE pod_ID=$project_id";
	$rezultat = mysql_query($upit)
	or die(mysql_error());
	$zapis = mysql_fetch_assoc($rezultat);
	$naslov=$zapis['naslov'];
}

for($m=0;$m<2;$m++){  
	// konekcija sa bazom podataka
	include 'includes/db_konekcija_dupla.php';
	$ubaci = "INSERT INTO donacije (donator, datum, iznos, projekat_id, prikaz, odobreno, placanje)
		VALUES ('$donator', '$time', '$iznos', '$project_id', '$prikaz', '0', '$nacin_placanja')";
	$rezultat = mysql_query($ubaci)
		or die(mysql_error());
	
		
	$ime = preslovljavanje($ime, $t);
	$prezime=preslovljavanje($prezime, $t);
	$adresa=preslovljavanje($adresa, $t);
	$mesto=preslovljavanje($mesto, $t);
	$pr="UPDATE korisnici SET Ime='$ime', Prezime='$prezime', mail='$mail', adresa='$adresa', mesto='$mesto', br_tel='$br_tel'  WHERE korisnik='$donator' ";
	mysql_query($pr)
		or die(mysql_error());
}
	include 'includes/db_konekcija.php';
	$u = "SELECT * FROM korisnici  WHERE korisnik='$user'";
			$rez= mysql_query($u)
			or die(mysql_error());
			$zap= mysql_fetch_assoc($rez);
			
		$ime = $zap['Ime'];
		$prezime=$zap['Prezime'];
		$adresa=$zap['adresa'];
		$mesto=$zap['mesto'];
	
	$u = "SELECT * FROM donacije  WHERE datum='$time'";
		$rez= mysql_query($u)
		or die(mysql_error());
		$zap= mysql_fetch_assoc($rez);
	$donation_id=$zap['donacija_id'];	
		
	//placanje donacije opštom uplatnicom	
		if($nacin_placanja=="uplatnica"){		
			if ($_COOKIE["slova"]=="cirilica") {
				echo'<table class="formular">
				<tr>
					<td class="formular">Пројекат</td>
					<td class="formular">';
					if($project_id==0){
					echo '<p class="tekst">'.$naslov.'</p>';									
					}
					else{echo"<a class=\"lista\" href=\"projekti.php?id=$project_id\" >".$naslov."</a>";}					
				echo'</td>
				</tr>
				<tr>
					<td class="formular">Начин плаћања</td>
					<td class="formular">Општа уплатница</a>					
					</td>
				</tr>
				<tr class="formular">
					<td class="formular">Износ за уплату</td>
					<td class="formular">'.$iznos.'дин</a>					
					</td>
				</tr>
				<tr class="formular">
					<td class="formular" colspan="2" >Информације о уплатиоцу<br/><br/>									
						<p class="text1">Име и презиме:<span class="placanje_ime">&nbsp'.$ime.'&nbsp'.$prezime.'</span></p>
						<p class="text1">E-mail:<span class="placanje_ime">&nbsp'.$mail.'</span></p>
						<p class="text1">Адреса:<span class="placanje_ime">&nbsp'.$adresa.'</span></p>
						<p class="text1">Место:<span class="placanje_ime">&nbsp'.$mesto.'</span></p>
						<p class="text1">Број телефона:<span class="placanje_ime">&nbsp'.$br_tel.'</span> </p>
					</td>
				</tr>							
				<tr class="formular">
					<td class="formular" colspan="2" >Информације о примаоцу<br/><br/>								
						<p class="text1">Прималац:&nbsp<span class="placanje_ime"> Друштво Никола Тесла</span></p>
						<p class="text1">Број рачуна:<span class="placanje_ime"> 123-45678910-11</span></p>
						<p class="text1">Износ за уплату:<span class="placanje_ime"> '.$iznos.'дин</span></p>
						<p class="text1">Позив на број: <span class="placanje_ime">'.$donation_id.'</span></p>
						<p class="text1">Сврха уплате:&nbsp<span class="placanje_ime">Донација </span></p>
					</td>
				</tr>
			</table>
			<p class=\"tekst\">Информације за уплату су Вам прослеђене на mail</p></br></br>';
			}
			else{
				echo'<table class="formular">
				<tr>
					<td class="formular">Projekat</td>
					<td class="formular">';
					if($project_id==0){
					echo '<p class="tekst">'.$naslov.'</p>';									
					}
					else{echo"<a class=\"lista\" href=\"projekti.php?id=$project_id\" >".$naslov."</a>";}					
				echo'</td>
				</tr>
				<tr>
					<td class="formular">Način plaćanja</td>
					<td class="formular">Opšta uplatnica</a>					
					</td>
				</tr>
				<tr class="formular">
					<td class="formular">Iznos za uplatu</td>
					<td class="formular">'.$iznos.'din</a>					
					</td>
				</tr>
				<tr class="formular">
					<td class="formular" colspan="2" >Informacije o uplatiocu<br/><br/>									
						<p class="text1">Ime i prezime:<span class="placanje_ime">&nbsp'.$ime.'&nbsp'.$prezime.'</span></p>
						<p class="text1">E-mail:<span class="placanje_ime">&nbsp'.$mail.'</span></p>
						<p class="text1">Adresa:<span class="placanje_ime">&nbsp'.$adresa.'</span></p>
						<p class="text1">Mesto:<span class="placanje_ime">&nbsp'.$mesto.'</span></p>
						<p class="text1">Broj telefona:<span class="placanje_ime">&nbsp'.$br_tel.'</span> </p>
					</td>
				</tr>							
				<tr class="formular">
					<td class="formular" colspan="2" >Informacije o primaocu<br/><br/>								
						<p class="text1">Primalac:&nbsp<span class="placanje_ime"> Društvo Nikola Tesla</span></p>
						<p class="text1">Broj računa:&nbsp<span class="placanje_ime"> 123-45678910-11</span></p>
						<p class="text1">Iznos za uplatu:&nbsp<span class="placanje_ime"> '.$iznos.'din</span></p>
						<p class="text1">Poziv na broj:&nbsp <span class="placanje_ime">'.$donation_id.'</span></p>
						<p class="text1">Svrha uplate:&nbsp<span class="placanje_ime">Donacija </span></p>
					</td>
				</tr>
			</table>
			<p class=\"tekst\">Informacije za uplatu su Vam prosleđene na mail</p></br></br>';
			}
		
		//slanje maila
			$to = $mail;						
			$subject = 'Informacije za doniranje'; 							
			$headers  = "From:no-reply@nikolatesla.com\r\n";
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			$message='
			<html>
			<head>
			  <title>Donacije za Društvo Nikola Tesla</title>
			</head>
			<body>
			<h1>Informacije za uplatu donacije:</h1>
			<ul>
			<li>Primalac: Društvo Nikola Tesla</li>
			<li>Broj računa:&nbsp 123-45678910-11</li>
			<li>Iznos za uplatu:&nbsp '.$iznos.'din</li>
			<li>Poziv na broj:&nbsp'.$donation_id.'</li>
			<li>Svrha uplate:&nbsp Donacija</li>
			</ul><br/><br/>
			<b> Društvo Nikola Tesla se zahvaljuje na donaciji.</b><br/><br/>
			<p> Molimo vas da uplatu izvršite u naredna 72 sata.</p>
			
			<p> Molimo vas ne odgovarajte na ovaj mail. Ukoliko pošaljete, Društvo Nikola Tesla neće primiti vaš mail.</p>
			</body>
			</html>';	
			
			$mail_sent = mail( $to, $subject, $message, $headers );
			echo $mail_sent ? "" : "<p class=\"tekst\">Slanje mail-a nije uspelo, proverite da li ste uneli tačan mail na vašem profilu pa pokušajte ponovo.</p></br></br>";
		}

	//plaćanje karticom
	if($nacin_placanja=="kartica"){
		
		if ($_COOKIE["slova"]=="cirilica") {
			echo'<table class="formular">
				<tr>
					<td class="formular">Пројекат</td>
					<td class="formular">';
					if($project_id==0){
					echo '<p class="tekst">'.$naslov.'</p>';									
					}
					else{echo"<a class=\"lista\" href=\"projekti.php?id=$project_id\" >".$naslov."</a>";}					
				echo'</td>
				</tr>
				<tr>
					<td class="formular">Начин плаћања</td>
					<td class="formular">Картицом online</a>&nbsp &nbsp
					<img src="images/2co.jpg" class="visa"/>
					</td>
				</tr>
				<tr class="formular">
					<td class="formular">Износ за уплату</td>
					<td class="formular">'.$iznos.'дин</a>					
					</td>
				</tr>										
				<tr class="formular">
					<td class="formular" colspan="2" >Информације о уплатиоцу<br/><br/>
						<p class="text1">Име и презиме:<span class="placanje_ime">&nbsp'.$ime.'&nbsp'.$prezime.'</span></p>
						<p class="text1">E-mail:<span class="placanje_ime">&nbsp'.$mail.'</span></p>
						<p class="text1">Адреса:<span class="placanje_ime">&nbsp'.$adresa.'</span></p>
						<p class="text1">Место:<span class="placanje_ime">&nbsp'.$mesto.'</span></p>
						<p class="text1">Број телефона:<span class="placanje_ime">&nbsp'.$br_tel.'</span> </p>
					</td>
				</tr>
					</table>';
			echo "<p class=\"tekst\">Притиском на дугме бићете преусмерени на сајт компаније 2CheckOut</p>";	
		}
		else{
		echo'<table class="formular">
				<tr>
					<td class="formular">Projekat</td>
					<td class="formular">';
					if($project_id=="drustvo"){
						echo '<p class="tekst">'.$naslov.'</p>';											
					}
					else{echo"<a class=\"lista\" href=\"projekti.php?id=$project_id\" >".$naslov."</a>";}					
				echo'</td>
				</tr>
				<tr>
					<td class="formular">Način plaćanja</td>
					<td class="formular">Karticom online</a>&nbsp &nbsp
					<img src="images/2co.jpg" class="visa"/>
					</td>
				</tr>
				<tr class="formular">
					<td class="formular">Iznos za uplatu</td>
					<td class="formular">'.$iznos.'din</a>					
					</td>
				</tr>										
				<tr class="formular">
					<td class="formular" colspan="2" >Informacije o uplatiocu<br/><br/>
						<p class="text1">Ime i prezime:<span class="placanje_ime">&nbsp'.$ime.'&nbsp'.$prezime.'</span></p>
						<p class="text1">E-mail:<span class="placanje_ime">&nbsp'.$mail.'</span></p>
						<p class="text1">Adresa:<span class="placanje_ime">&nbsp'.$adresa.'</span></p>
						<p class="text1">Mesto:<span class="placanje_ime">&nbsp'.$mesto.'</span></p>
						<p class="text1">Broj telefona:<span class="placanje_ime">&nbsp'.$br_tel.'</span> </p>
					</td>
				</tr>
					</table>';
			echo "<p class=\"tekst\">Pritiskom na dugme bićete preusmereni na sajt kompanije 2CheckOut</p>";										
			
			}	
			//uspostavljanje interfejsa sa kompanijom 2Checkout
			echo '<br/><br/><form action="https://www.2checkout.com/checkout/spurchase" method="post">
					<input type="hidden" name="sid" value="1819221"/>
					<input type="hidden" name="mode" value="2CO"/>
					<input type="hidden" name="cart_order_id" value="'.$donation_id.'"/>
					<input type="hidden" name="li_1_type" value="product" />
					<input type="hidden" name="li_1_product_id" value="d" />
					<input type="hidden" name="li_1_name" value="Donacija" />
					<input type="hidden" name="li_1_quantity" value="1" />
					<input type="hidden" name="li_1_tangible" value="N" />
					<input type="hidden" name="li_1_description" value="Donacija za društvo Nikola Tesla" />
					<input type="hidden" name="li_1_price" value="'.$iznos.'.00" />
					<input type="hidden" name="total" value="'.$iznos.'.00"/>
					<input type="hidden" name="demo" value="Y"/>
					<input type="hidden" name="fixed" value="Y"/>
					<input type="hidden" name="merchant_order_id" value="'.$donation_id.'"/>
					<input type="hidden" name="card_holder_name" value="'.$ime.' '.$prezime.'"/>
					<input type="hidden" name="street_address" value="'.$adresa.'"/>
					<input type="hidden" name="city" value="'.$mesto.'"/>
					<input type="hidden" name="state" value="Serbia"/>
					<input type="hidden" name="zip" value="12345"/>
					<input type="hidden" name="country" value="Serbia"/>
					<input type="hidden" name="email" value="'.$mail.'"/>
					<input type="hidden" name="phone" value="'.$br_tel.'"/>
					<input type="hidden" name="phone_extension" value="381"/>
					<input type="hidden" name="lang" value="en"/>
					<input type="hidden" name="pay_method" value="CC"/>';
					if ($_COOKIE["slova"]=="cirilica") {
						echo'<input type="submit" class="dugme" value="Даље"/>';}
					else{
						echo'<input type="submit" class="dugme" value="Dalje"/>';
					}
		}
	}
	else { echo "<p class=\"upozorenje\">Niste čekirali ni jedan projekat</p>"; }	

?>