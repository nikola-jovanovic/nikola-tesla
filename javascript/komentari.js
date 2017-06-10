function plus(id){
	if (window.XMLHttpRequest){// kod za IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttp=new XMLHttpRequest();
  	}
 	else{// kod za IE6, IE5
   		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   	}
 	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		
			var plus="plus_"+id;
			var minus="minus_"+id;
			document.getElementById(plus).setAttribute("disabled","disabled");
			document.getElementById(minus).setAttribute("disabled","disabled");
			setCookie(plus,"1",1);
			var pluss="pluss_"+id;
			var iznos=document.getElementById(pluss).innerHTML;
			iznos++;
			document.getElementById(pluss).innerHTML=iznos;
			
		}
   	}
 	xmlhttp.open("GET","plus_minus.php?tip=plus&id="+id,true);
 	xmlhttp.send();
	
}


function minus(id){
	if (window.XMLHttpRequest){// kod za IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttp=new XMLHttpRequest();
  	}
 	else{// kod za IE6, IE5
   		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   	}
 	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			var plus="plus_"+id;
			var minus="minus_"+id;
			document.getElementById(plus).setAttribute("disabled","disabled");
			document.getElementById(minus).setAttribute("disabled","disabled");
			setCookie(plus,"1",1);
			var minuss="minuss_"+id;
			var iznos=document.getElementById(minuss).innerHTML;
			iznos++;
			document.getElementById(minuss).innerHTML=iznos;
			
		}
   	}
 	xmlhttp.open("GET","plus_minus.php?tip=minus&id="+id,true);
 	xmlhttp.send();
	
}

function provera_komentar(){
var komentar=document.getElementById("komentar").value;

if(komentar==""){
	document.getElementById("upozor").innerHTML="Polje za komentar nije popunjeno!";
	return false;
}
else{
	return true;
}
}

function odgovorLAT(kom_id, pod_id){
	odgovor='#odgovor_'+kom_id;
	podgovor='p#odgovor'+kom_id;
	$('<div class="komentar1" >Odgovor<form action="" method="post" ><span id="upozor'+kom_id+'" style="color:#C11B17;"></span><p><textarea style="width:60%;" rows="3" id="komentar'+kom_id+'" name="komentar" ></textarea></p><input type="submit" class="odgovori"  value="Pošalji" onclick="return provera_podkomentar('+kom_id+')"/><input type="hidden" value="'+pod_id+'" name="id" /><input type="hidden" value="'+kom_id+'" name="kom_id" /><input type="hidden" value="poslato" name="poslato" /><form></div>').insertAfter(podgovor);
	$(odgovor).remove();

}
function odgovorCIR(kom_id, pod_id){
	odgovor='#odgovor_'+kom_id;
	podgovor='p#odgovor'+kom_id;
	$('<div class="komentar1" >Одговор<form action="" method="post" ><span id="upozor'+kom_id+'" style="color:#C11B17;"></span><p><textarea style="width:60%;" rows="3" id="komentar'+kom_id+'" name="komentar" ></textarea></p><input type="submit" class="odgovori"  value="Пошаљи" onclick="return provera_podkomentar('+kom_id+')"/><input type="hidden" value="'+pod_id+'" name="id" /><input type="hidden" value="'+kom_id+'" name="kom_id" /><input type="hidden" value="poslato" name="poslato" /><form></div>').insertAfter(podgovor);
	$(odgovor).remove();

}
function provera_podkomentar(kom_id){
	koment="komentar"+kom_id;
	var komentar=document.getElementById(koment).value;
	if(komentar==""){
		upozor="upozor"+kom_id;
		document.getElementById(upozor).innerHTML="Polje za komentar nije popunjeno!";
		return false;
	}
	else{
		return true;
	}
}

function logCIR() {
	alert("Морате бити улоговани како бисте послали коментар.");
	
}

function logLAT() {
	alert("Morate biti ulogovani kako biste poslali komentar.");
	
}