						<h1><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Регистрација' : 'Registracija'; ?></h1>
						<?php 
							$vidljivo1 = ($_COOKIE["slova"] == "cirilica") ? 'Видљиво мени' : 'Vidljivo meni';
							$vidljivo2 = ($_COOKIE["slova"] == "cirilica") ? 'Видљиво члановима' : 'Vidljivo članovima';
							$vidljivo3 = ($_COOKIE["slova"] == "cirilica") ? 'Видљиво свима' : 'Vidljivo svima';
							if ($_COOKIE["slova"]=="cirilica") {
								echo'<span class="napomena" >Поља означена са (*) су неопходна. Дозвољени карактери за корисницко име и лозинку су слова, цифре и доња црта. Дузина поменутих поља мора бити измедју 5 и 15 карактера.
								</span></span><br/>';
							}
							else{
								echo'<span class="napomena" >Polja označena sa (*) su neophodna. Dozvoljeni karakteri za korisnicko ime i lozinku su slova, cifre i donja crta. Duzina pomenutih polja mora biti izmedju 5 i 15 karaktera.
								</span><br/>';
							}
						?>
						<p><input id="institucija" type="checkbox" name="institution" onclick="institucia()" value="1"/> <?php echo ($_COOKIE["slova"] == "cirilica") ? 'Региструјем се као институција.' : 'Registrujem se kao institucija.'; ?></p><br/>
						<form class="registracijaPojedinac" name ="registracijaPojedinac" enctype="multipart/form-data">
									<input type="hidden" name="institution" onclick="institucia()" value="0"/>
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Име*' : 'Ime*'; ?></p>
									<p>
										<input type="text" onkeyup="validateEmpty(this)" name="firstName"/>  
										<select name="c_firstName">
											<option value="1" selected="selected"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3"><?php echo $vidljivo1 ?></option>
										</select>  
										<span class="greska" style="color:#C11B17"></span>
									</p>
								
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Презиме*' : 'Prezime*'; ?></p>
									<p>
										<input type="text" onkeyup="validateEmpty(this)" name="lastName"/>  
										<select name="c_lastName">
											<option value="1" selected="selected"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3"><?php echo $vidljivo1 ?></option>
										</select>  
										<span class="greska" style="color:#C11B17"></span>
									</p>

									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Институција/Фирма' : 'Institucija/Firma'; ?></p>
									<p>
										<input type="text" name="company"/>  
										<select name="c_company">
											<option value="1" selected="selected"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3"><?php echo $vidljivo1 ?></option>
										</select>
									</p>
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Пол*' : 'Pol*'; ?></p>
									<p>
										<input type="radio" name="gender" value="m"> <?php echo ($_COOKIE["slova"] == "cirilica") ? 'Мушки&nbsp;&nbsp;' : 'Muški&nbsp;&nbsp;'; ?>
										<input type="radio" name="gender" value="z"> <?php echo ($_COOKIE["slova"] == "cirilica") ? 'Женски&nbsp;&nbsp;' : 'Ženski&nbsp;&nbsp;'; ?>
										<select name="c_gender">
											<option value="1" selected="selected"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3"><?php echo $vidljivo1 ?></option>
										</select>
										<span class="greska" style="color:#C11B17"></span>
									</p>
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Телефон*' : 'Telefon*'; ?></p>
									<p>
										<input type="text" onkeyup="validatePhoneNumber(this)" name="phoneNumber"/>  
										<select name="c_phoneNumber">
											<option value="1"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3" selected="selected"><?php echo $vidljivo1 ?></option>
										</select>  
										<span class="greska" style="color:#C11B17"></span>
									</p>
								
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Адреса*' : 'Adresa*'; ?></p>
									<p>
										<input type="text" onkeyup="validateEmpty(this)" name="address"/>  
										<select name="c_address">
											<option value="1"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3" selected="selected"><?php echo $vidljivo1 ?></option>
										</select>  
										<span class="greska" style="color:#C11B17"></span>
									</p>
								
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Место*' : 'Mesto*'; ?></p>
									<p>
										<input type="text" onkeyup="validateEmpty(this)" name="city"/>  
										<select name="c_city">
											<option value="1"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3" selected="selected"><?php echo $vidljivo1 ?></option>
										</select>  
										<span class="greska" style="color:#C11B17"></span>
									</p>
								
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Ваш е-мејл*' : 'Vaš e-mail*'; ?></p>
									<p>
										<input type="text" onkeyup="validateMail(this)" name="eMail"/>  
										<select name="c_eMail">
											<option value="1"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3" selected="selected"><?php echo $vidljivo1 ?></option>
										</select>  
										<span class="greska" style="color:#C11B17"></span>
									</p>
									
									<p id="nestoosebi"><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Нешто о себи' : 'Nešto o sebi'; ?></p>
									<p>
										<textarea style="width:39%" rows="8"  name="about"></textarea>  
										<select name="c_about">
											<option value="1"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3" selected="selected"><?php echo $vidljivo1 ?></option>
										</select>
									</p>
									<p><input style="margin:10px 0px 15px" type="checkbox" name="c_about" value="1"> <?php echo ($_COOKIE["slova"] == "cirilica") ? 'Желим да се приказује у мом материјалу.' : 'Želim da se prikazuje u mom materijalu.'; ?></p>
									
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Корисничко име*' : 'Korisničko ime*'; ?></p>
									<p>
										<input type="text" name="userName" onkeyup="validateUserName(this)"/>  
										<span id="predlog"></span>
										<span class="greska" style="color:#C11B17"></span>
									<p>
								
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Лозинка*' : 'Lozinka*'; ?></p>
									<p>
										<input type="password" onkeyup="validatePassword(this)" name="password"/>  
										<span></span>
										<span class="greska" style="color:#C11B17"></span>
									</p>
								
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Потврда лозинке*' : 'Potvrda lozinke*'; ?></p>
									<p>
										<input type="password" onkeyup="validatePassword(this)" name="password1"/>  
										<span></span>
										<span class="greska" style="color:#C11B17"></span>
									</p>
								
									<br/><br/><p><input type="submit" class="dugme" name="zavrsi" value="<?php echo ($_COOKIE['slova'] == 'cirilica') ? 'Потврди' : 'Potvrdi'; ?>"/>
									<input type="reset"  class="dugme" value="<?php echo ($_COOKIE['slova'] == 'cirilica') ? 'Поништи' : 'Poništi'; ?>"/></p>
									
								
									<br/><p  style="font-style:italic;"><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Поља означена са (*) су неопходна.' : 'Polja označena sa (*) su neophodna.'; ?></p>
									<br/><p  class= "innfo" >fsdfsfs</p>
								
						</form>
						<form style="display:none" class="registracijaInstitucija" name ="registracijaInstitucija" enctype="multipart/form-data">
									<input type="hidden" name="institution" onclick="institucia()" value="1"/>
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Назив институције/фирме*' : 'Naziv institucije/firme*'; ?></p>
									<p>
										<input type="text" onkeyup="validateEmpty(this)" name="company"/>  
										<select name="c_company">
											<option value="1" selected="selected"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3"><?php echo $vidljivo1 ?></option>
										</select>
										<span class="greska" style="color:#C11B17"></span>
									</p>
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Телефон*' : 'Telefon*'; ?></p>
									<p>
										<input type="text" onkeyup="validatePhoneNumber(this)" name="phoneNumber"/>  
										<select name="c_phoneNumber">
											<option value="1"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3" selected="selected"><?php echo $vidljivo1 ?></option>
										</select>  
										<span class="greska" style="color:#C11B17"></span>
									</p>
								
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Адреса*' : 'Adresa*'; ?></p>
									<p>
										<input type="text" onkeyup="validateEmpty(this)" name="address"/>  
										<select name="c_address">
											<option value="1"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3" selected="selected"><?php echo $vidljivo1 ?></option>
										</select>  
										<span class="greska" style="color:#C11B17"></span>
									</p>
								
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Место*' : 'Mesto*'; ?></p>
									<p>
										<input type="text" onkeyup="validateEmpty(this)" name="city"/>  
										<select name="c_city">
											<option value="1"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3" selected="selected"><?php echo $vidljivo1 ?></option>
										</select>  
										<span class="greska" style="color:#C11B17"></span>
									</p>
								
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Ваш е-мејл*' : 'Vaš e-mail*'; ?></p>
									<p>
										<input type="text" onkeyup="validateMail(this)" name="eMail"/>  
										<select name="c_eMail">
											<option value="1"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3" selected="selected"><?php echo $vidljivo1 ?></option>
										</select>  
										<span class="greska" style="color:#C11B17"></span>
									</p>
									
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Ваш сајт' : 'Vaš sajt'; ?></p>
									<p>
										<input type="text" name="site"/>
										<select name="c_site">
											<option value="1" selected="selected"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3"><?php echo $vidljivo1 ?></option>
										</select>  
									</p>

									<p id="nestoosebi"><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Нешто о себи' : 'Nešto o sebi'; ?></p>
									<p>
										<textarea style="width:39%" rows="8"  name="about"></textarea>  
										<select name="c_about">
											<option value="1"><?php echo $vidljivo3 ?></option>
											<option value="2"><?php echo $vidljivo2 ?></option>
											<option value="3" selected="selected"><?php echo $vidljivo1 ?></option>
										</select>
									</p>
									<p><input style="margin:10px 0px 15px" type="checkbox" name="c_about" value="1"> <?php echo ($_COOKIE["slova"] == "cirilica") ? 'Желим да се приказује у мом материјалу.' : 'Želim da se prikazuje u mom materijalu.'; ?></p>
									
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Корисничко име*' : 'Korisničko ime*'; ?></p>
									<p>
										<input type="text" name="userName" onkeyup="validateUserName(this)"/>  
										<span id="predlog"></span>
										<span class="greska" style="color:#C11B17"></span>
									<p>
								
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Лозинка*' : 'Lozinka*'; ?></p>
									<p>
										<input type="password" onkeyup="validatePassword(this)" name="password"/>  
										<span></span>
										<span class="greska" style="color:#C11B17"></span>
									</p>
								
									<p><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Потврда лозинке*' : 'Potvrda lozinke*'; ?></p>
									<p>
										<input type="password" onkeyup="validatePassword(this)" name="password1"/>  
										<span></span>
										<span class="greska" style="color:#C11B17"></span>
									</p>
								
									<br/><br/><p><input type="submit" class="dugme" name="zavrsi" value="<?php echo ($_COOKIE['slova'] == 'cirilica') ? 'Потврди' : 'Potvrdi'; ?>"/>
									<input type="reset"  class="dugme" value="<?php echo ($_COOKIE['slova'] == 'cirilica') ? 'Поништи' : 'Poništi'; ?>"/></p>
									
								
									<br/><p  style="font-style:italic;"><?php echo ($_COOKIE["slova"] == "cirilica") ? 'Поља означена са (*) су неопходна.' : 'Polja označena sa (*) su neophodna.'; ?></p>
									<br/><p  class= "innfo" >fsdfsfs</p>
								
						</form>
					
			<script type="text/javascript" src="javascript/ajax.js"></script>
		