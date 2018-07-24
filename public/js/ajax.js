// AJAX funkcija za ispis predloga
function showHint(str){
 	if (str.length==0){ 
   		document.getElementById("predlog").innerHTML="";
  		 return;
   	}
 	if (window.XMLHttpRequest){// kod za IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttp=new XMLHttpRequest();
  	}
 	else{// kod za IE6, IE5
   		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   	}
 	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("predlog").innerHTML=xmlhttp.responseText;
		}
   	}
 	xmlhttp.open("GET","korisnicidb.php?q="+str,true);
 	xmlhttp.send();
}

// AJAX funkcija za ispis informacija o korisniku
function showUser(str){
 	if (str==""){
   		document.getElementById("koricnici_info").innerHTML="";
   		return;
  	} 
 	if (window.XMLHttpRequest){// kod za IE7+, Firefox, Chrome, Opera, Safari
   		xmlhttp=new XMLHttpRequest();
   	}
 	else{// kod za IE6, IE5
   		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
 	xmlhttp.onreadystatechange=function(){
   		if (xmlhttp.readyState==4 && xmlhttp.status==200){
     		document.getElementById("korisnici_info").innerHTML=xmlhttp.responseText;
     	}
   	}
 	xmlhttp.open("GET","korisniciInfo.php?q="+str,true);
 	xmlhttp.send();
}
