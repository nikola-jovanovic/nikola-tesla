<?php
	$iznos=500;
	$user=$_SESSION['valid_user'];
	for($m=0;$m<2;$m++){  
			// konekcija sa bazom podataka
			include 'includes/db_konekcija_dupla.php';
			$ubaci = "INSERT INTO clanarine (korisnik_id, tip, datum)VALUES ('$user', '$nacin_placanja', '$time')";
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
			
	$u = "SELECT * FROM clanarine  WHERE korisnik_id='$user' AND datum='$time'";
			$rez= mysql_query($u)
			or die(mysql_error());
			$zap= mysql_fetch_assoc($rez);
	$membership_id=$zap['clanarina_id'];
	
	if ($_COOKIE["slova"]=="cirilica") {echo "<h1>Чланарина</h1><br/>";}
	else {echo "<h1>Članarina</h1><br/>"; }
	
	//placanje članarine opštom uplatnicom	
	if($nacin_placanja=="uplatnica"){		
		
		if ($_COOKIE["slova"]=="cirilica") {
			echo'<table class="formular">										
				<tr class="formular">
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
						<p class="text1">Име и презиме:&nbsp<span class="placanje_ime"> '.$ime.'&nbsp'.$prezime.'</span></p>
						<p class="text1">Mail:&nbsp<span class="placanje_ime"> '.$mail.'</span></p>
						<p class="text1">Адреса:&nbsp<span class="placanje_ime"> '.$adresa.'</span></p>
						<p class="text1">Место:&nbsp<span class="placanje_ime"> '.$mesto.'</span></p>
						<p class="text1">Број телефона:&nbsp<span class="placanje_ime"> '.$br_tel.' </span></p>
					</td>
				</tr>
				<tr class="formular">
					<td class="formular" colspan="2" >Информације о примаоцу<br/><br/>
						<p class="text1">Прималац:&nbsp <span class="placanje_ime"> Друштво Никола Тесла</span></p>
						<p class="text1">Број рачуна:&nbsp <span class="placanje_ime"> 123-45678910-11</span></p>
						<p class="text1">Износ за уплату: &nbsp<span class="placanje_ime"> '.$iznos.'дин</span></p>
						<p class="text1">Позив на број:&nbsp<span class="placanje_ime"> '.$membership_id.'</span></p>
						<p class="text1">Сврха уплате:&nbsp<span class="placanje_ime"> Чланарина </span></p>
					</td>
				</tr>
			</table>
			
			<p class=\"tekst\">Информације за уплату су Вам прослеђене на mail</p></br></br>';	
		}
		else{
			echo'<table class="formular">										
				<tr class="formular">
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
						<p class="text1">Ime i prezime:&nbsp<span class="placanje_ime"> '.$ime.'&nbsp'.$prezime.'</span></p>
						<p class="text1">Mail:&nbsp<span class="placanje_ime"> '.$mail.'</span></p>
						<p class="text1">Adresa:&nbsp<span class="placanje_ime"> '.$adresa.'</span></p>
						<p class="text1">Mesto:&nbsp<span class="placanje_ime"> '.$mesto.'</span></p>
						<p class="text1">Broj telefona:&nbsp<span class="placanje_ime"> '.$br_tel.' </span></p>
					</td>
				</tr>
				<tr class="formular">
					<td class="formular" colspan="2" >Informacije o primaocu<br/><br/>
						<p class="text1">Primalac:&nbsp <span class="placanje_ime">Društvo Nikola Tesla</span></p>
						<p class="text1">Broj računa:&nbsp <span class="placanje_ime">123-45678910-11</span></p>
						<p class="text1">Iznos za uplatu: &nbsp<span class="placanje_ime">'.$iznos.'</span></p>
						<p class="text1">Poziv na broj:&nbsp<span class="placanje_ime">'.$membership_id.'</span></p>
						<p class="text1">Svrha uplate:&nbsp<span class="placanje_ime">Članarina </span></p>
					</td>
				</tr>
			</table>
			
			<p class=\"tekst\">Informacije za uplatu su Vam prosleđene na mail</p></br></br>';							
		}
		//slanje maila
			$to = $mail;							
			$subject = 'Informacije za plaćanje članarine'; 
			$headers  = "From:no-reply@nikolatesla.com\r\n";
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			$message='
			<html>
			<head>
			  <title>Donacije za Društvo Nikola Tesla</title>
			</head>
			<body>
			<h1>Informacije za uplatu članarine:</h1>
			<ul>
			<li>Primalac: Društvo Nikola Tesla</li>
			<li>Broj računa: 123-45678910-11</li>
			<li>Iznos za uplatu: '.$iznos.'din</li>
			<li>Poziv na broj: '.$membership_id.'</li>
			<li>Svrha uplate: Članarina</li>
			</ul><br/><br/>
			<b> Hvala vam što plaćate članarinu.</b><br/><br/>
			<p> Molimo vas da uplatu izvršite u naredna 72 sata.</p><br/>
			
			<p> Molimo vas ne odgovarajte na ovaj mail. Ukoliko pošaljete, Društvo Nikola Tesla neće primiti vaš mail.</p>
			</body>
			</html>';
			
			$mail_sent = @mail( $to, $subject, $message, $headers );
			echo $mail_sent ? "" : "<p class=\"tekst\">Slanje mail-a nije uspelo, proverite da li ste uneli tačan mail na vašem profilu pa pokušajte ponovo.</p></br></br>";
	}					
	
	//placanje članarine karticom	
	if($nacin_placanja=="kartica"){
	
		echo '<form action="https://www.2checkout.com/checkout/spurchase" method="post">';
		
		if ($_COOKIE["slova"]=="cirilica") {
			echo'<table class="formular">									
				<tr class="formular">
					<td class="formular">Начин плаћања</td>
					<td class="formular">Картицом online</a>&nbsp&nbsp
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
						<p class="text1">Име и презиме:&nbsp<span class="placanje_ime">'.$ime.'&nbsp'.$prezime.'</span></p>
						<p class="text1">Mail:&nbsp<span class="placanje_ime">'.$mail.'</span></p>
						<p class="text1">Адреса:&nbsp<span class="placanje_ime">'.$adresa.'</span></p>
						<p class="text1">Место:&nbsp<span class="placanje_ime">'.$mesto.'</span></p>
						<p class="text1">Број телефона:&nbsp<span class="placanje_ime">'.$br_tel.' </span></p>
					</td>
				</tr>
			</table>';
			echo "<p class=\"tekst\">Притиском на дугме бићете преусмерени на сајт компаније 2CheckOut</p>";										
	
			echo '<br/><br/><input type="submit" class="dugme" value="Даље"/>';				
		}
		else{
			echo'<table class="formular">									
				<tr class="formular">
					<td class="formular">Način plaćanja</td>
					<td class="formular">Karticom online</a>&nbsp&nbsp
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
						<p class="text1">Ime i prezime:&nbsp<span class="placanje_ime">'.$ime.'&nbsp'.$prezime.'</span></p>
						<p class="text1">Mail:&nbsp<span class="placanje_ime">'.$mail.'</span></p>
						<p class="text1">Adresa:&nbsp<span class="placanje_ime">'.$adresa.'</span></p>
						<p class="text1">Mesto:&nbsp<span class="placanje_ime">'.$mesto.'</span></p>
						<p class="text1">Broj telefona:&nbsp<span class="placanje_ime">'.$br_tel.' </span></p>
					</td>
				</tr>
			</table>';
			echo "<p class=\"tekst\">Pritiskom na dugme bićete preusmereni na sajt kompanije 2CheckOut</p>";										
	
			echo '<br/><br/>
					<input type="submit" class="dugme" value="Dalje"/>';				
		}
		echo '		<input type="hidden" name="sid" value="1819221"/>
					<input type="hidden" name="mode" value="2CO"/>									
					<input type="hidden" name="li_1_product_id" value="c" />
					<input type="hidden" name="cart_order_id" value=" '.$membership_id.'"/>
					<input type="hidden" name="li_1_type" value="product" />
					<input type="hidden" name="li_1_name" value="Članarina" />
					<input type="hidden" name="li_1_quantity" value="1" />
					<input type="hidden" name="li_1_tangible" value="N" />
					<input type="hidden" name="li_1_description" value="Članarina za društvo Nikola Tesla" />
					<input type="hidden" name="li_1_price" value="10.00" />
					<input type="hidden" name="total" value="10.00"/>
					<input type="hidden" name="demo" value="Y"/>
					<input type="hidden" name="fixed" value="Y"/>
					<input type="hidden" name="merchant_order_id" value=" '.$membership_id.'"/>
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
	}					

?>