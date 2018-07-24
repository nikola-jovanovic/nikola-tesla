function like(id){
	if (window.XMLHttpRequest){// kod za IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttp=new XMLHttpRequest();
  	}
 	else{// kod za IE6, IE5
   		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   	}
 	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		
			var plus="like_"+id;
			var minus="unlike_"+id;
			document.getElementById(plus).setAttribute("disabled","disabled");
			document.getElementById(minus).setAttribute("disabled","disabled");
			setCookie(plus,"1",1);
			var pluss="likee_"+id;
			var iznos=document.getElementById(pluss).innerHTML;
			iznos++;
			document.getElementById(pluss).innerHTML=iznos;
			
		}
   	}
 	xmlhttp.open("GET","like_unlike.php?tip=plus&id="+id,true);
 	xmlhttp.send();
	
}


function unlike(id){
	if (window.XMLHttpRequest){// kod za IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttp=new XMLHttpRequest();
  	}
 	else{// kod za IE6, IE5
   		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   	}
 	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			var plus="likee_"+id;
			var minus="unlikee_"+id;
			document.getElementById(plus).setAttribute("disabled","disabled");
			document.getElementById(minus).setAttribute("disabled","disabled");
			setCookie(plus,"1",1);
			var minuss="unlikee_"+id;
			var iznos=document.getElementById(minuss).innerHTML;
			iznos++;
			document.getElementById(minuss).innerHTML=iznos;
			
		}
   	}
 	xmlhttp.open("GET","like_unlike.php?tip=minus&id="+id,true);
 	xmlhttp.send();
	
}