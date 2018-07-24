function DodavanjeSlikeLAT() {
var counter=$('#counter').val();
counter++
$("#counter").val(counter);
$('<div id="brisanje_sl'+counter+'"><div class="slika11"><p>Slika   <input type="button" class="delete" onclick="Brisanje(\'brisanje_sl'+counter+'\');" value="Obriši sliku" /></p><p><input type="file" accept="image/x-png, image/gif, image/jpeg" name="slika[]"/></p><br/><p>Naslov slike</p><p><input type="text" style="width:60%;" name="naslov_slike[]"/></p><br/></div><div class="text11" style="display:none;"><p>Tekst</p><p><span style="color:#C11B17;"></span></p><p ><textarea style="width:60%;" rows="10" name="text[]"></textarea></p><br/></div><div class="naslov11" style="display:none;"><p>Поднаслов</p><p><span style="color:#C11B17;"></span></p><p ><input type="text" style="width:60%;" name="podnaslov[]"/></p><br/></div></div><div class="referent"></div>').insertAfter("div.referent:last");
$('#text').removeAttr('disabled');
$('#podnaslov').removeAttr('disabled');
}
function DodavanjeTekstaLAT() {
var counter=$('#counter').val();
counter++
$("#counter").val(counter);
$('<div id="brisanje_te'+counter+'"><div class="slika11" style="display:none;"><p>Slika</p><p><input type="file"  name="slika[]"/></p><br/><p>Naslov slike</p><p><input type="text" style="width:60%;" name="naslov_slike[]"/></p><br/></div><div class="text11"><p>Tekst <input type="button" class="delete" onclick="Brisanje(\'brisanje_te'+counter+'\');" value="Obriši tekst" /></p><p><span style="color:#C11B17;"></span></p><p ><textarea style="width:60%;" rows="10" name="text[]"></textarea></p><br/></div><div class="naslov11" style="display:none;"><p>Поднаслов</p><p><span style="color:#C11B17;"></span></p><p ><input type="text" style="width:60%;" name="podnaslov[]"/></p><br/></div></div><div class="referent"></div>').insertAfter('div.referent:last');
$('#text').attr('disabled','disabled');
$('#podnaslov').removeAttr('disabled');
}

function DodavanjeSlikeCIR() {
var counter=$('#counter').val();
counter++
$("#counter").val(counter);
$('<div id="brisanje_sl'+counter+'"><div class="slika11"><p>Слика <input type="button" class="delete" onclick="Brisanje(\'brisanje_sl'+counter+'\');" value="Обриши слику" /></p><p><input type="file" accept="image/x-png, image/gif, image/jpeg" name="slika[]"/></p><br/><p>Наслов слике</p><p><input type="text" style="width:60%;" name="naslov_slike[]"/></p><br/></div><div class="text11" style="display:none;"><p>Текст</p><p><span style="color:#C11B17;"></span></p><p ><textarea style="width:60%;" rows="10" name="text[]"></textarea></p><br/></div><div class="naslov11" style="display:none;"><p>Поднаслов</p><p><span style="color:#C11B17;"></span></p><p ><input type="text" style="width:60%;" name="podnaslov[]"/></p><br/></div></div><div class="referent"></div>').insertAfter("div.referent:last");
$('#text').removeAttr('disabled');
$('#podnaslov').removeAttr('disabled');
}
function DodavanjeTekstaCIR() {
var counter=$('#counter').val();
counter++
$("#counter").val(counter);
$('<div id="brisanje_te'+counter+'"><div class="slika11" style="display:none;"><p>Слика</p><p><input type="file"  name="slika[]"/></p><br/><p>Наслов слике</p><p><input type="text" style="width:60%;" name="naslov_slike[]"/></p><br/></div><div class="text11"><p>Текст <input type="button" class="delete" onclick="Brisanje(\'brisanje_te'+counter+'\');" value="Oбриши текст" /></p><p><span style="color:#C11B17;"></span></p><p ><textarea style="width:60%;" rows="10" name="text[]"></textarea></p><br/></div><div class="naslov11" style="display:none;"><p>Поднаслов</p><p><span style="color:#C11B17;"></span></p><p ><input type="text" style="width:60%;" name="podnaslov[]"/></p><br/></div></div><div class="referent"></div>').insertAfter('div.referent:last');
$('#text').attr('disabled','disabled');
$('#podnaslov').removeAttr('disabled');
}

function DodavanjeNaslovaLAT() {
var counter=$('#counter').val();
counter++
$("#counter").val(counter);
$('<div id="brisanje_na'+counter+'"><div class="slika11" style="display:none;"><p>Слика</p><p><input type="file"  name="slika[]"/></p><br/><p>Наслов слике</p><p><input type="text" style="width:60%;" name="naslov_slike[]"/></p><br/></div><div class="text11" style="display:none;"><p>Текст</p><p><span style="color:#C11B17;"></span></p><p ><textarea style="width:60%;" rows="10" name="text[]"></textarea></p><br/></div><div class="naslov11"><p>Podnaslov <input type="button" class="delete" onclick="Brisanje(\'brisanje_na'+counter+'\');" value="Obriši podnaslov" /></p><p><span style="color:#C11B17;"></span></p><p ><input type="text" style="width:60%;" name="podnaslov[]"/></p><br/></div></div><div class="referent"></div>').insertAfter("div.referent:last");
$('#podnaslov').removeAttr('disabled');
$('#text').removeAttr('disabled');
}
function DodavanjeNaslovaCIR() {
var counter=$('#counter').val();
counter++
$("#counter").val(counter);
$('<div id="brisanje_na'+counter+'"><div class="slika11" style="display:none;"><p>Слика</p><p><input type="file"  name="slika[]"/></p><br/><p>Наслов слике</p><p><input type="text" style="width:60%;" name="naslov_slike[]"/></p><br/></div><div class="text11" style="display:none;"><p>Текст</p><p><span style="color:#C11B17;"></span></p><p ><textarea style="width:60%;" rows="10" name="text[]"></textarea></p><br/></div><div class="naslov11"><p>Поднаслов <input type="button" class="delete" onclick="Brisanje(\'brisanje_na'+counter+'\');" value="Обриши поднаслов" /></p><p><span style="color:#C11B17;"></span></p><p ><input type="text" style="width:60%;" name="podnaslov[]"/></p><br/></div></div><div class="referent"></div>').insertAfter('div.referent:last');
$('#podnaslov').attr('disabled','disabled');
$('#text').removeAttr('disabled');
}

function Brisanje(aaa){  
var a='#'+aaa;
//alert (a);
$(a).remove();    
}

// kod za proveru forme za unos vesti, priloga,  patenta i dogadjaja
function validateForm(theForm) {
	var greska=1;
	if (validateEmpty(theForm.naslov)==false) {
		 greska=0;
 	}
	
	if (validateEmpty(theForm.abstrakt)==false) {
 	    greska=0;
 	}
			
	if(greska==0)return false;
	else return true;
}

// kod za proveru forme za unos knjige
function validateKnjiga(theForm) {
	var greska=1;
	if (validateEmpty(theForm.naslov)==false) {
 	    greska=0;
 	}
	if (validateEmpty(theForm.abstrakt)==false) {
 	    greska=0;
 	}

	if(greska==0)return false;
	else return true;
}

//kod za proveru forme za izjave
function validateIzjava(theForm) {
	var greska=1;
	if (validateEmpty(theForm.naslov)==false) {
 	    greska=0;
 	}
	if (validateEmpty(theForm.abstrakt)==false) {
 	    greska=0;
 	}
	if(greska==0)return false;
	else return true;
}

// kod za proveru forme za unos nagrade
function validateNagrada(theForm) {
	var greska=1;
	if (validateEmpty(theForm.naslov)==false) {
 	    greska=0;
 	}
	if (validateEmpty(theForm.abstrakt)==false) {
 	    greska=0;
 	}
	if (validateDocs(theForm)==false) {
 	    greska=0;
 	}

	if(greska==0)return false;
	else return true;
}

// kod za proveru forme za pravnog akta
function validatePravni_akt(theForm) {
	var greska=1;
	if (validateEmpty(theForm.naslov)==false) {
 	    greska=0;
 	}
	if (validateEmpty(theForm.abstrakt)==false) {
 	    greska=0;
 	}
	if (validateEmpty(theForm.abstrakt)==false) {
 	    greska=0;
 	}
	if (validateEmptyDoc(theForm)==false) {
 	    greska=0;
 	}
	if (validateCheck(theForm)==false){
		greska=0;
	}
	if(greska==0)return false;
	else return true;
}

//provera forme projekta
function validateProjekat(theForm) {
	var greska=1;
	if (validateEmpty(theForm.naslov)==false) {
 	    greska=0;
 	}
	if (validateEmpty(theForm.abstrakt)==false) {
 	    greska=0;
 	}
	if (validateDate(theForm.pocetak)==false) {
 	    greska=0;
 	}
	if (validateDate(theForm.zavrsetak)==false) {
 	    greska=0;
 	}
	if (validateAmount(theForm.suma)==false) {//////////////////////////
 	    greska=0;
 	}

	if(greska==0)return false;
	else return true;
}

// proverava da li je polje prazno
function validateEmpty(fld) {
    if (fld.value.length == 0) {
    	fld.nextSibling.innerHTML="Obavezno polje!";  
     	return false;
  	}
	else {
		fld.nextSibling.innerHTML="";  
    	return true;
		
   	}
}

function validateDate(fld) {
	
    if (fld.value.length != 10) {
		fld.nextSibling.innerHTML="Format datuma nije dobar!"; 
		return false;
	}
	else if(fld.value.length == 10){
		var checkOK = "0123456789";
		for (i = 0;  i < 10;  i++){
			znak = fld.value.charAt(i);
			for (k = 0;  k< checkOK.length;  k++){
				if (znak == checkOK.charAt(k)){
				break;
				}
				if (k == checkOK.length){
					if (i!=4 && i!=7){					
						fld.nextSibling.innerHTML="Format datuma nije dobar!"; 
						return false;
						break;
					}
				}
				if (i==4 || i==7){
					if(znak!="-" ){	
						fld.nextSibling.innerHTML="Format datuma nije dobar!"; 
						return false;
						break;
					}
				}
			}
    	}
	}
	else {
		fld.nextSibling.innerHTML=""; 
    	return true;
		
   	}
}

function validateAmount(fld) {
	var isnum = /^\d+$/.test(fld.value);
    if (fld.value.length == 0 || fld.value.length>9 || isnum!=1) {		
		fld.nextSibling.innerHTML="Format potrebne sume nije dobar!";  
     	return false;
  	}
	else {
		fld.nextSibling.innerHTML="";  
    	return true;
   	}
}

function validateEmptyDoc(fld){
	var naziv = document.getElementsByName("dokument[]");
	var n=naziv[0].value;
	var promena=fld.promena_doc.value;
	if(promena=="da"){
		if (n !="" ){		
			n=n.split(".");
			l=n.length-1;
			n=n[l];
			if (!(n=="jpg" || n=="doc" || n=="docx" || n=="pdf" )	){
				document.getElementById("docc").innerHTML="Nedozvoljen format dokumenta!";
				return false;
			}
			else{
				document.getElementById("docc").innerHTML="";
				return true;
			}
		}
		else{
			document.getElementById("docc").innerHTML="";
			return true;
		}
	}
	else{
		if (n ==""){
			document.getElementById("docc").innerHTML="Obavezno polje!";
				return false;
		}		
		else {
			n=n.split(".");
			l=n.length-1;
			n=n[l];
			if (!(n=="jpg" || n=="doc" || n=="docx" || n=="pdf" )	){
				document.getElementById("docc").innerHTML="Nedozvoljen format dokumenta!";
				return false;
			}
			else{
				document.getElementById("docc").innerHTML="";
				return true;
			}
		}
	}
}

function validateCheck(fld){
	
	var drustvo=fld.drustvo;
	var fondacija=fld.fondacija;
	if( !(drustvo.checked || fondacija.checked) ){
		document.getElementById("pravni_check").innerHTML="Obavezno je čekirati jednu ili obe organizacije!<br/>";
		return false;
	}
	else{
		document.getElementById("pravni_check").innerHTML="";
		return true;
	}

}

function validateDocs(fld){
	var dokument = document.getElementsByName("dokument[]");
	var naziv = document.getElementsByName("naziv_dokumenta[]");
	var promena = document.getElementsByName("promena_doc[]");
	var greska=0;
	for (i = 0;  i < dokument.length;  i++){
	n=dokument[i].value;
	docc="docc"+i;
	
	if(promena[i].value == "da"){	
		
		if (n !="" ){
			if(naziv[i].value !=""){
				n=n.split(".");
				l=n.length-1;
				n=n[l];
				if (!(n=="jpg" || n=="doc" || n=="docx" || n=="pdf" )	){
					document.getElementById(docc).innerHTML="Nedozvoljen format dokumenta!";
					greska=1;
				}
				else{
					document.getElementById(docc).innerHTML="";
					
				}
			}
			else{
				document.getElementById(docc).innerHTML="Obavezan naziv dokumenta!";
				greska=1;
			}
		}
		else{
			document.getElementById(docc).innerHTML="";
			
		}
	}
	else{
	
		if (n !=""){
			if(naziv[i].value !=""){
				n=n.split(".");
				l=n.length-1;
				n=n[l];
				if (!(n=="jpg" || n=="doc" || n=="docx" || n=="pdf" )	){
					document.getElementById(docc).innerHTML="Nedozvoljen format dokumenta!";
					greska=1;
				}
				else{
					document.getElementById(docc).innerHTML="";
					
				}
			}
			else{
				document.getElementById(docc).innerHTML="Obavezan naziv dokumenta!";
				greska=1;
			}
		}
		else{
			document.getElementById(docc).innerHTML="";
			
		}
	}

}
if(greska==1){ return false;}
else{ return true;}
}
