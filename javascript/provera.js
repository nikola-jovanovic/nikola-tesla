function provera_doniraj(){
	var checkStr=document.getElementById("amount").value;
	var ime=document.getElementById("ime").value;
	var prezime=document.getElementById("prezime").value;
	var mail=document.getElementById("mail").value;
	var br_tel=document.getElementById("br_tel").value;
	var adresa=document.getElementById("adresa").value;
	var mesto=document.getElementById("mesto").value;
	var checkOK = "0123456789";
	var allValid = true;
	var allNum = "";
	if (checkStr=="" || ime=="" || prezime=="" || mail=="" || br_tel=="" || adresa=="" || mesto==""){
		alert("Sva polja moraju biti popunjena.");
		return false;
	}
	else if (checkStr.length > 6){
		allValid = false;		
	}
	else {
	//provera da li su samo brojevi upisani
		for (i = 0;  i < checkStr.length;  i++){
			ch = checkStr.charAt(i);
			for (j = 0;  j < checkOK.length;  j++)
			if (ch == checkOK.charAt(j)){
			break;
			}
			if (j == checkOK.length)
			{
			allValid = false;
			break;
			}
			if (ch != ","){
			allNum += ch;}
		}
	}
	if (!allValid){
		alert("U polje iznos mogu se uneti samo brojevi maksimalne dužine 6.");
		return false;
	}
	else{
		if (br_tel.length<8){
			alert("Niste uneli dobar broj telefona.");
			return false;
		}
		else {
			//provera da li su samo brojevi upisani
			for (i = 0;  i < br_tel.length;  i++){
				ch = br_tel.charAt(i);
				for (j = 0;  j < checkOK.length;  j++)
				if (ch == checkOK.charAt(j)){
					break;
				}
				if (j == checkOK.length){
					allValid = false;
					break;
				}
				if (ch != ","){
					allNum += ch;
				}
			}
		}
	}
	if (!allValid){
		alert("U polje telefon mogu se uneti samo brojevi.");
		return false;
	}
	else {
		//proveravanje formata maila
		var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
		if (filter.test(mail)){
			return true;
		}
		else{
			alert("Unesite pravilnu e-mail adresu!")
			return false;
		}
	}
}

function admin_projekti(){	
	var naziv = document.getElementsByName("naziv[]");
	var iznos = document.getElementsByName("iznos[]");
	var i=naziv.length;
	var a="";
	var b="";
	for (k = 0;  k < naziv.length;  k++){
		var n=naziv[k].value;
		var s=iznos[k].value;
		a=a+s;
		b=b+n;
		var allValid = true;
		if(n!="" && s!=""){
			var checkStr=s;
			var checkOK = "0123456789";				
			var allNum = "";
			if (checkStr.length > 9){
				allValid = false;
				alert("U polje iznos mogu se uneti samo brojevi maksimalne dužine 9.");
				return false;
			}
			else {
				for (i = 0;  i < checkStr.length;  i++){
					ch = checkStr.charAt(i);
					for (j = 0;  j < checkOK.length;  j++)
					if (ch == checkOK.charAt(j)){
					break;
					}
					if (j == checkOK.length){
						allValid = false;
						break;
					}
					if (ch != ","){
						allNum += ch;}
				}
			}
			if(!allValid){
				alert("U polje iznos mogu se uneti samo brojevi maksimalne dužine 9.");
				return false;
			}

		}
	}
}

function cekiranje(){ //admin_uplate.php
	var ch = document.getElementById("ch"); 	
	var duzina = document.ch.elements.length;
	var a=0;
    for (i=0; i<duzina; i++){
        var type = ch.elements[i].type;		
        if (type=="checkbox" && ch.elements[i].checked){
			a=a+1;			
        }        
    }
	if(a==0){
		alert("Niste ništa čekirali!");
		return false;
	}
}

function DodajTrosak(){
	$('<tr class="projekti"><td class="projekti" class="a"><input type="text" style="width:90%;" id="naziv" name="naziv[]" /></td><td class="projekti" class="a" ><input type="text" style="width:90%;" id="suma" name="iznos[]" /></td></tr>').insertAfter('tr:last');
}





