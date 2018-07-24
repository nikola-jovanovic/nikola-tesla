//forma za registraciju institucije
$(document).ready(function(){
  $('.prikazi').hide();

  $('.registracijaPojedinac').on('submit', function(event){
    var form = $(this)[0];
    var userName = $(this).find('input[name=userName]')[0];
    var password = $(this).find('input[name=password]')[0];
    var firstName = $(this).find('input[name=firstName]')[0];
    var lastName = $(this).find('input[name=lastName]')[0];
    var address = $(this).find('input[name=address]')[0];
    var eMail = $(this).find('input[name=eMail]')[0];
    var phoneNumber = $(this).find('input[name=phoneNumber]')[0];
    var city = $(this).find('input[name=city]')[0];
    var password1 = $(this).find('input[name=password1]')[0];
    var company = $(this).find('input[name=company]')[0];
    if(!validatePojedinac(form)){
        return false;
    }
    else{
        var form = $(this);       
        // let's select and cache all the fields
        var inputs = form.find("input");
        // serialize the data in the form
        var serializedData = form.serialize();

        // let's disable the inputs for the duration of the ajax request
        inputs.prop("disabled", true);

        // fire off the request to /form.php
        request = $.ajax({
            url: "includes/registrationProcess.php",
            type: "post",
            data: serializedData

        });
        // callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR){
          $('.innfo').text(response);
        });

        // callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown){
            // log the error to the console
            alert(
                "The following error occured: "+
                textStatus, errorThrown
            );
        });

        // callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(function () {
            // reenable the inputs
            inputs.prop("disabled", false);
        });

        // prevent default posting of form
       event.preventDefault();
    }
  });


  $('.registracijaInstitucija').on('submit', function(event){
    var form = $(this)[0];
    var userName = $(this).find('input[name=userName]')[0];
    var password = $(this).find('input[name=password]')[0];
    var address = $(this).find('input[name=address]')[0];
    var eMail = $(this).find('input[name=eMail]')[0];
    var phoneNumber = $(this).find('input[name=phoneNumber]')[0];
    var city = $(this).find('input[name=city]')[0];
    var password1 = $(this).find('input[name=password1]')[0];
    var company = $(this).find('input[name=company]')[0];
    if(!validateInstitucija(form)){
      return false;
    }
    else{
        var form = $(this);       
        // let's select and cache all the fields
        var inputs = form.find("input");
        // serialize the data in the form
        var serializedData = form.serialize();

        // let's disable the inputs for the duration of the ajax request
        inputs.prop("disabled", true);

        // fire off the request to /form.php
        request = $.ajax({
            url: "includes/registrationProcess.php",
            type: "post",
            data: serializedData

        });
        // callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR){
          $('.innfo').text(response);
        });

        // callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown){
            // log the error to the console
            alert(
                "The following error occured: "+
                textStatus, errorThrown
            );
        });

        // callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(function () {
            // reenable the inputs
            inputs.prop("disabled", false);
        });

        // prevent default posting of form
       event.preventDefault();
     }
  });

})

  function institucia(){	
  	if($("#institucija").attr('checked')) {
      $(".registracijaPojedinac").slideUp();
  	  $(".registracijaInstitucija").slideDown();
  	}
  	else{
      $(".registracijaInstitucija").slideUp();
      $(".registracijaPojedinac").slideDown();
  	}
  }

// kod za proveru forme za registraciju
function validatePojedinac(theForm) {
	var greska=1;
	if (validateEmpty(theForm.lastName )== false) greska=0;
 	if (validateEmpty(theForm.firstName) == false) greska=0;
 	if (checkRadio() == false) greska=0;
	if (validateEmpty(theForm.address )== false) greska=0;
	if (validateMail(theForm.eMail) == false)	greska=0;
	if (validatePhoneNumber(theForm.phoneNumber) == false) greska=0;
	if (validateEmpty(theForm.city) == false) greska=0;
	if (validateUserName(theForm.userName) == false) greska=0;
	if (validatePassword(theForm.password) == false) greska=0;
	if (validatePassword(theForm.password1) == false) greska=0;
	if (validateEqual(theForm.password, theForm.password1) == false) greska=0;
 	if(greska==0)return false;
  else return true;
}
function validateInstitucija(theForm) {
	var greska=1;
	if (validateEmpty(theForm.company) == false) greska=0;
	if (validateEmpty(theForm.address) == false) greska=0;
	if (validateMail(theForm.eMail) == false) greska=0;
	if (validatePhoneNumber(theForm.phoneNumber) == false) greska=0;
	if (validateEmpty(theForm.city) == false) greska=0;
	if (validateUserName(theForm.userName) == false) greska=0;
	if (validatePassword(theForm.password) == false) greska=0;
	if (validatePassword(theForm.password1) == false) greska=0;
	if (validateEqual(theForm.password, theForm.password1) == false) greska=0;
 	if(greska==0)return false;
  else return true;
}

// proverava da li je polje prazno
function validateEmpty(fld) {
  if (fld.value.length == 0) {
  	fld.style.background = '#C0C0C0 '; 
  	fld.style.boxShadow = "1px 1px 3px red";
	  fld.parentNode.children[2].innerHTML="&nbsp Obavezno polje!";  
  	return false;
  }
	else {
  	fld.style.background = 'White';
  	fld.style.boxShadow = "0px 0px white";
	  fld.parentNode.children[2].innerHTML="";
    return true;
  }
}

function checkRadio(){
 	var pol = document.getElementsByName("gender");
  if (pol[0].checked || pol[1].checked){
      pol[0].parentNode.children[3].innerHTML="";
      return true;
  }
  else{
      pol[0].parentNode.children[3].innerHTML="&nbsp Obavezno polje!";  
     	return false;
  }
}

// proverava korisnicko ime
function validateUserName(fld) {
  var illegalChars = /\W/; // dozvoljava unosenje samo slova, brojeva i donjih crta
  if (fld.value.length == 0) {
   	fld.style.background = '#C0C0C0 '; 
   	fld.style.boxShadow = "1px 1px 3px red";
		fld.parentNode.children[2].innerHTML="&nbsp Niste uneli korisničko ime!";  
   	return false;
  }
  else if ((fld.value.length < 5) || (fld.value.length > 15)) {
   	fld.style.background = '#C0C0C0 '; 
   	fld.style.boxShadow = "1px 1px 3px red";
		fld.parentNode.children[2].innerHTML="&nbsp Korisničko ime nije odgovarajuće dužine.(5-15 slova)!";  
   	return false;
  }
	else if (illegalChars.test(fld.value)) {
  	fld.style.background = '#C0C0C0 ';
  	fld.style.boxShadow = "1px 1px 3px red"; 
		fld.parentNode.children[2].innerHTML="&nbsp Korisničko ime sadrži zabranjene karaktere!";  
		return false;
  }
	else {
		fld.style.background = 'White';
		fld.style.boxShadow = "0px 0px white";
		fld.parentNode.children[2].innerHTML="";
		return true;
  } 
}

// proverava broj telefona
function validatePhoneNumber(fld) {
  var illegalChars = /^\d+$/; // dozvoljava unosenje samo brojeva
  if (fld.value.length == 0) {
    fld.style.background = '#C0C0C0 '; 
    fld.style.boxShadow = "1px 1px 3px red";
    fld.parentNode.children[2].innerHTML="&nbsp Niste uneli broj telefona!";  
    return false;
  }
  else if (!illegalChars.test(fld.value)) {
    fld.style.background = '#C0C0C0 ';
    fld.style.boxShadow = "1px 1px 3px red"; 
    fld.parentNode.children[2].innerHTML="&nbsp Broj telefona mora sadrzati samo cifre!";  
    return false;
  }
  else if ((fld.value.length < 7) || (fld.value.length > 11)) {
    fld.style.background = '#C0C0C0 '; 
    fld.style.boxShadow = "1px 1px 3px red";
    fld.parentNode.children[2].innerHTML="&nbsp Broj telefona nije odgovarajuće dužine.(7-11 cifara)!";  
    return false;
  }
  else {
    fld.style.background = 'White';
    fld.style.boxShadow = "0px 0px white";
    fld.parentNode.children[2].innerHTML="";
    return true;
    } 
}

// proverava lozinku
function validatePassword(fld) {
  var illegalChars = /\W/; // dozvoljava unosenje samo slova, brojeva i donjih crta. 
  if (fld.value.length == 0) {
  	fld.style.background = '#C0C0C0 '; 
  	fld.style.boxShadow = "1px 1px 3px red";
		fld.parentNode.children[2].innerHTML="&nbsp Niste uneli lozinku!";  
  	return false;
  }
	else if ((fld.value.length < 5) || (fld.value.length > 15)) {
   	fld.style.background = '#C0C0C0 '; 
   	fld.style.boxShadow = "1px 1px 3px red";
		fld.parentNode.children[2].innerHTML="&nbsp Lozinka nije odgovarajuće dužine.(5-15 karaktera)!";  
  	return false;
  } 
	else if (illegalChars.test(fld.value)) {
   	fld.style.background = '#C0C0C0 '; 
   	fld.style.boxShadow = "1px 1px 3px red";
		fld.parentNode.children[2].innerHTML="&nbsp Lozinka sadrzi zabranjene karaktere!";  
   	return false;
  }
	else {
   	fld.style.background = 'White';
   	fld.style.boxShadow = "0px 0px white";
		fld.parentNode.children[2].innerHTML="";
		return true;
  }
}  

// proverava e-mail
function trim(s){
  	return s.replace(/^\s+|\s+$/, '');
}

function validateMail(fld) {
	var tfld = trim(fld.value);  
  var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;
  var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/ ;
  if (fld.value.length == 0) {
  	fld.style.background = '#C0C0C0 ';
  	fld.style.boxShadow = "1px 1px 3px red";
    fld.parentNode.children[2].innerHTML="&nbsp Niste uneli E-mail!";  
    return false;
  } 
	else if (!emailFilter.test(tfld)) {              // testira mejl na zabranjene karaktere
   	fld.style.background = '#C0C0C0 '; 
   	fld.style.boxShadow = "1px 1px 3px red";
		fld.parentNode.children[2].innerHTML="&nbsp Uneli ste pogrešno E-mejl adresu!";  
   	return false;
  } 
	else if (fld.value.match(illegalChars)) {
   	fld.style.background = '#C0C0C0 '; 
   	fld.style.boxShadow = "1px 1px 3px red";
		fld.parentNode.children[2].innerHTML="&nbsp E-mejl sadrži zabranjene karaktere!";  
   	return false;
  }
	else {
    fld.style.background = 'White';
    fld.style.boxShadow = "0px 0px white";
		fld.parentNode.children[2].innerHTML="";
		return true;
  }
}

// proverava da li su dva polja jednaka
function validateEqual(fld, fld1) {
  if (fld.value != fld1.value) {
  	fld.style.background = '#C0C0C0 '; 
  	fld.style.boxShadow = "1px 1px 3px red";
		fld1.style.background = '#C0C0C0 ';
		fld1.style.boxShadow = "1px 1px 3px red";
		fld1.parentNode.children[2].innerHTML="&nbsp Niste uspešno potvrdili lozinku!";  
  	return false;
  }
	else {
  	fld.style.background = 'White';
  	fld.style.boxShadow = "0px 0px white";
		fld1.style.background = 'White';
		fld1.style.boxShadow = "0px 0px white";
		fld1.parentNode.children[2].innerHTML="";
		return true;
  }
}

function validateFormPassword(theForm) {
  var greska=1;
  if (theForm.stara.value==0){
    theForm.stara.style.background =  '#C0C0C0';
    theForm.stara.parentNode.children[2].innerHTML="&nbsp Niste uneli lozinku!";
    greska=0;
  }
  else if (theForm.stara.value!=theForm.pass.value){
    theForm.stara.style.background = '#C0C0C0';
    theForm.stara.parentNode.children[2].innerHTML="&nbsp Niste uneli dobru lozinku!";  
    greska=0;
  }
  if (validatePassword(theForm.nova)==false) {
    greska=0;
  }
  if (validatePassword(theForm.nova_ponovo)==false) {
    greska=0;
  }
  if (validateEqual(theForm.nova, theForm.nova_ponovo) == false) greska=0;
  if(greska==0)return false;
}

function checkRadios(fld){
  var greska1 = 1;
  for(var i=0;i<fld.length;i++){
    if (fld[i].checked) greska1 = 0;    
  }
  if(greska1 == 1){
      alert('Morate oznaciti materijal!')
      return false;
    }
  else return true;
}

