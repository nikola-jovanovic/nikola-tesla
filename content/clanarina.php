					<?php

					if ($_COOKIE["slova"]=="cirilica") {

						echo'<h1>Плати чланарину</h1>';

						if(!isset($_SESSION['valid_user'])){

						echo'<p class="text1">Ако желите да постанете члан Друштва Никола Тесла, најпре треба да се <a href="registracija.php">региструјете</a> , затим да се улогујете и платите чланарину која износи 500дин на годишњем нивоу.</p><br/>';

						echo'<p class="text1">Као члан ћете моћи да коментаришете материјале који се појављују на сајту. Уколико желите ваше име и контакт ће се појавити на овом сајту, у рубрици Чланови.</p>';

						}

						else{

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

							$clanarina=$zapis['clanarina'];

							$danas=date ("Y-m-d");

							

							if($clanarina<=$danas){

							echo"<form action=\"placanje\"  method=\"post\" onsubmit=\"return provera_doniraj()\">";

							echo'<table class="formular">													

									<tr class="formular">

										<td class="formular">Износ чланарине </td>

										<td class="formular" >500дин</td>

									</tr>

									<tr class="formular">

										<td class="formular">Изаберите начин плаћања</td>

										<td class="formular">

										<input type="radio" checked="checked" value="kartica" name="nacin_placanja"/>Картицом<br/>

										<p class="obavestenje">Ради наставка процеса плаћања чланарине бићете преусмерени на 2CheckOut e-commerce портал који посредује у промету роба и/или услуга на Интернету у име и за рачун нашег Друштва</p><br/>

										<input type="radio" value="uplatnica" name="nacin_placanja"/>Путем опште уплатнице

										<p class="obavestenje">Уколико се одлучите за плаћање путем опште уплатнице, молимо вас да уплату реализујете у року од 72 сата након добијања инструкција за плаћање. Уколико не примимо вашу уплату у назначеном року, отказаћемо вашу чланарину.

										</tr>

									<tr class="formular">

										<td class="formular" colspan="2">Лични подаци <br/><br/>

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

							echo "<br/>";

							echo "<input type=\"hidden\" value=\"10\" id=\"amount\" name=\"amount\"/>&nbsp";

							echo "<input type=\"hidden\" value=\"clanarina\" name=\"svrha\"/>&nbsp";

							echo "<p><input type=\"submit\" class=\"dugme\" name =\"submit\" onclick=\"return provera_doniraj()\" value=\"Даље\"/></p>

							</form><br/>";

							}

							else{

								echo'<p class="text1">Чланарина је плаћена и важи до: '.$clanarina.'</p><br/>';

					

							}

						}

					}

					else{

						echo'<h1>Plati članarinu</h1>';

						if(!isset($_SESSION['valid_user'])){

						echo'<p class="text1">Ako želite da postanete član Društva Nikola Tesla, najpre treba da se <a href="registracija.php">registrujete</a> , zatim da se ulogujete i platite članarinu koja iznosi 500din na godišnjem nivou.</p><br/>';

						echo'<p class="text1">Kao član ćete moći da komentarišete materijale koji se pojavljuju na sajtu. Ukoliko želite vaše ime i kontakt će se pojaviti na ovom sajtu, u rubrici Članovi.</p>';

						}

						else{

							$user_id=$_SESSION['valid_user'];			

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

							$clanarina=$zapis['clanarina'];

							$danas=date ("Y-m-d");

							

							if($clanarina<$danas){	

							echo"<form action=\"placanje\"  method=\"post\" onsubmit=\"return provera_doniraj()\">";

							echo'<table class="formular">													

									<tr class="formular">

										<td class="formular">Iznos članarine </td>

										<td class="formular" >500din</td>

									</tr>

									<tr class="formular">

										<td class="formular">Izaberite način plaćanja</td>

										<td class="formular">

										<input type="radio" checked="checked" value="kartica" name="nacin_placanja"/>Karticom online <br/>

										<p class="obavestenje">Radi nastavka procesa plaćanja članarine bićete preusmereni na 2CheckOut e-commerce portal koji posreduje u prometu roba i/ili usluga na Internetu u ime i za račun našeg društva</p><br/>

										<input type="radio" value="uplatnica" name="nacin_placanja"/>Putem opšte uplatnice

										<p class="obavestenje">  Ukoliko se odlučite za plaćanje putem opšte uplatnice, molimo vas da uplatu realizujete u roku od 72 sata nakon dobijanja instrukcija za plaćanje. Ukoliko ne primimo vašu uplatu u naznačenom roku, otkazaćemo vašu članarinu.

										</tr>

									<tr class="formular">

										<td class="formular" colspan="2">Lični podaci: <br/><br/>

										<div style="float:left;width:45%">

										<p class="text1">Ime:</p>

										<p class="text1"><input type="text" style="width:70%;" value="'.$ime.'" id="ime" name="ime"/></p>

										<p class="text1">Prezime:</p>

										<p class="text1"><input type="text" style="width:70%;" value="'.$prezime.'" id="prezime" name="prezime"/></p>

										<p class="text1">Mail:</p>

										<p class="text1"><input type="text" style="width:70%;" value="'.$mail.'" id="mail" name="mail"/></p>

										</div>

										<div style="float:right;width:45%">											

										<p class="text1">Broj telefona:</p>

										<p class="text1"><input type="text" style="width:70%;" value="'.$br_tel.'" id="br_tel" name="br_tel"/></p>

										<p class="text1">Adresa:</p>

										<p class="text1"><input type="text" style="width:70%;" value="'.$adresa.'" id="adresa" name="adresa"/></p>

										<p class="text1">Mesto:</p>

										<p class="text1"><input type="text" style="width:70%;" value="'.$mesto.'" id="mesto" name="mesto"/></p>

										</div>

										<div style="clear:both;"></div>

										</td>

									</tr>

								</table>';								

							echo "<br/>";

							echo "<input type=\"hidden\" value=\"10\" id=\"amount\" name=\"amount\"/>&nbsp";

							echo "<input type=\"hidden\" value=\"clanarina\" name=\"svrha\"/>&nbsp";

							echo "<p><input type=\"submit\" class=\"dugme\" name =\"submit\" onclick=\"return provera_doniraj()\" value=\"Dalje\"/></p>

							</form><br/>";

							}

							else{

								echo'<p class="text1">Članarina je plaćena i važi do: '.$clanarina.'</p><br/>';

					

							}

						}

					}

					

					?>
