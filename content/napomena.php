<?php
if ($_COOKIE["slova"]=="cirilica") {
	echo'<span class="napomena" >Текст који уносите биће пресловљен на ћирилично, односно латинично писмо. 
Уколико желите да неки део текста остане само на писму којим пишете, тај текст ограничите са две тарабе (#) са обе стране.<br/>
	Уколико желите у оквиру текста да ставите линк то урадите на следећи начин: <span>##&#60;a href##="http://жељени линк"&#62 Назив линка у тексту &#60;/a&#62;.
	</span></span><br/>';
}
else{
	echo'<span class="napomena" >Tekst koji unosite biće preslovljen na ćirilično, odnosno latinično pismo. 
	Ukoliko želite da neki deo teksta ostane samo na pismu kojim pišete, taj tekst ograničite sa dve tarabe (#) sa obe strane.<br/>
	Ukoliko želite u okviru teksta da stavite link to uradite na sledeći način ##&#60a href##="http://željeni link"&#62 Naziv linka u tekstu &#60/a&#62.
	</span><br/>';
}
?>