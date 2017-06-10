
<?php	
//provera da li je korisnik ulogovan
if(isset($_SESSION['valid_user'])){
	
		if ($_COOKIE["slova"]=="cirilica") {echo "<h1>Ваша донација</h1><br/>";}
		else{ echo "<h1>Vaša donacija</h1><br/>";}
		if($project_id=="drustvo"){
			if ($_COOKIE["slova"]=="cirilica"){$naslov="Друштво Никола Тесла";}
			else{$naslov="Društvo Nikola Tesla";}
		}
		else{
			$upit = "SELECT * FROM projekti  WHERE pod_ID=$project_id";
			$rezultat = mysql_query($upit)
			or die(mysql_error());
			$zapis = mysql_fetch_assoc($rezultat);
			$naslov=$zapis['naslov'];
			//zastita od promena id-a u url-u
			if($naslov==""){
				if ($_COOKIE["slova"]=="cirilica"){$naslov="Друштво Никола Тесла";}
				else{$naslov="Društvo Nikola Tesla";}
				$project_id="drustvo";
			}
		}
		
		//formular za doniranje
		echo"<form action=\"placanje.php\"  method=\"post\" onsubmit=\"return provera_doniraj()\">";
			$user=$_SESSION['valid_user'];
			$upit = "SELECT * FROM korisnici  WHERE korisnik='$user'";
			$rezultat = mysql_query($upit)
			or die(mysql_error());
			$zapis = mysql_fetch_assoc($rezultat);
			$ime = $zapis['Ime'];
			$prezime=$zapis['Prezime'];
			$mail=$zapis['mail'];
			$br_tel=$zapis['br_tel'];
			$adresa=$zapis['adresa'];
			$mesto=$zapis['mesto'];
			
		if ($_COOKIE["slova"]=="cirilica") {
			echo'<table class="formular">
				<tr class="formular">
					<td class="formular">Сврха уплате</td>';
				echo"<td class=\"formular\">";
				if($project_id=="drustvo"){
					echo '<p class="tekst">'.$naslov.'</p>';
					
					}
				else{
				echo"<a class=\"lista\" href=\"projekti.php?id=$project_id\" >".$naslov."</a>";}					
				echo'	</td>
				</tr>
				<tr class="formular">
					<td class="formular">Износ који донирате</td>
					<td class="formular"><input type="text" style="width:40%;" id="amount" name="iznos"/>&nbspдин</td>
				</tr>
				<tr class="formular">
					<td class="formular">Да ли желите да будете приказани на страници пројекта као донатор</td>
					<td class="formular"><input type="radio" checked="checked" value="1" name="display"/>Да<br/><input type="radio" value="0" name="display"/>Не</td>
				</tr>
				<tr class="formular">
					<td class="formular">Изаберите начин плаћања</td>
					<td class="formular">
					<input type="radio" checked="checked" value="kartica" name="nacin_placanja"/>Картицом online <br/>
					<p class="obavestenje">Ради наставка процеса донирања бићете преусмерени на 2CheckOut e-commerce портал који посредује у промету роба и/или услуга на Интернету у име и за рачун нашег друштва.</p><br/>
					<input type="radio" value="uplatnica" name="nacin_placanja"/>Путем опште уплатнице
					<p class="obavestenje"> Уколико се одлучите за плаћање путем опште уплатнице, молимо вас да уплату реализујете у року од 72 сата након добијања инструкција за плаћање. Уколико не примимо вашу уплату у назначеном року, отказаћемо вашу донацију.
					</tr>
				<tr class="formular">
					<td class="formular" colspan="2">Лични подаци донатора <br/><br/>
					<div style="float:left;width:45%">
						<p class="text1">Име</p>
						<p class="text1"><input type="text" style="width:70%;" value="'.$ime.'" id="ime" name="ime"/></p>
						<p class="text1">Презиме</p>
						<p class="text1"><input type="text" style="width:70%;" value="'.$prezime.'" id="prezime" name="prezime"/></p>
						<p class="text1">Mail</p>
						<p class="text1"><input type="text" style="width:70%;" value="'.$mail.'" id="mail" name="mail"/></p>
						</div>
						<div style="float:right;width:45%">											
						<p class="text1">Број телефона</p>
						<p class="text1"><input type="text" style="width:70%;" value="'.$br_tel.'" id="br_tel" name="br_tel"/></p>
						<p class="text1">Адреса</p>
						<p class="text1"><input type="text" style="width:70%;" value="'.$adresa.'" id="adresa" name="adresa"/></p>
						<p class="text1">Место</p>
						<p class="text1"><input type="text" style="width:70%;" value="'.$mesto.'" id="mesto" name="mesto"/></p>
					</div>
					<div style="clear:both;"></div>
					</td>
				</tr>
			</table>';										
			echo "<input type=\"hidden\" value=\"".$project_id."\" name=\"project_id\"/>&nbsp";
			echo "<input type=\"hidden\" value=\"donacije\" name=\"svrha\"/>&nbsp<br/>";
			echo "<p><input type=\"submit\" class=\"dugme\" name =\"submit\" value=\"Даље\"/></p>
				</form><br/>";
		}
		else{
			echo'<table class="formular">
				<tr class="formular">
					<td class="formular">Svrha uplate:</td>';
				echo"<td class=\"formular\">";
				if($project_id=="drustvo"){
					echo '<p class="tekst">'.$naslov.'</p>';
					
					}
				else{
				echo"<a class=\"lista\" href=\"projekti_posebno.php?project_id=$project_id\" >".$naslov."</a>";}					
				echo'	</td>
				</tr>
				<tr class="formular">
					<td class="formular">Iznos koji donirate</td>
					<td class="formular"><input type="text" style="width:40%;" id="amount" name="iznos"/>&nbspdin</td>
				</tr>
				<tr class="formular">
					<td class="formular">Da li želite da budete prikazani na stranici projekta kao donator</td>
					<td class="formular"><input type="radio" checked="checked" value="1" name="display"/>Da<br/><input type="radio" value="0" name="display"/>Ne</td>
				</tr>
				<tr class="formular">
					<td class="formular">Izaberite način plaćanja</td>
					<td class="formular">
					<input type="radio" checked="checked" value="kartica" name="nacin_placanja"/>Karticom online <br/>
					<p class="obavestenje">Radi nastavka procesa doniranja bićete preusmereni na 2CheckOut e-commerce portal koji posreduje u prometu roba i/ili usluga na Internetu u ime i za račun našeg društva</p><br/>
					<input type="radio" value="uplatnica" name="nacin_placanja"/>Putem opšte uplatnice
					<p class="obavestenje"> Ukoliko se odlučite za plaćanje putem opšte uplatnice, molimo vas da uplatu realizujete u roku od 72 sata nakon dobijanja instrukcija za plaćanje. Ukoliko ne primimo vašu uplatu u naznačenom roku, otkazaćemo vašu donaciju.
					</tr>
				<tr class="formular">
					<td class="formular" colspan="2">Lični podaci donatora<br/><br/>
					<div style="float:left;width:45%">
					<p class="text1">Ime</p>
					<p class="text1"><input type="text" style="width:70%;" value="'.$ime.'" id="ime" name="ime"/></p>
					<p class="text1">Prezime</p>
					<p class="text1"><input type="text" style="width:70%;" value="'.$prezime.'" id="prezime" name="prezime"/></p>
					<p class="text1">Mail</p>
					<p class="text1"><input type="text" style="width:70%;" value="'.$mail.'" id="mail" name="mail"/></p>
					</div>
					<div style="float:right;width:45%">											
					<p class="text1">Broj telefona</p>
					<p class="text1"><input type="text" style="width:70%;" value="'.$br_tel.'" id="br_tel" name="br_tel"/></p>
					<p class="text1">Adresa</p>
					<p class="text1"><input type="text" style="width:70%;" value="'.$adresa.'" id="adresa" name="adresa"/></p>
					<p class="text1">Mesto</p>
					<p class="text1"><input type="text" style="width:70%;" value="'.$mesto.'" id="mesto" name="mesto"/></p>
					</div>
					<div style="clear:both;"></div>
					</td>
				</tr>
				</table>';										
			echo "<input type=\"hidden\" value=\"".$project_id."\" name=\"project_id\"/>&nbsp";
			echo "<input type=\"hidden\" value=\"donacije\" name=\"svrha\"/>&nbsp<br/>";
			echo "<p><input type=\"submit\" class=\"dugme\" name =\"submit\" value=\"Dalje\"/></p>
				</form><br/>";
		}
		
}						
//ako korisnik nije ulogovan	
else{ 			
	//formular za logovanje
	include 'content/logovanje.php';
}
			
?>	
