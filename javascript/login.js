// kod koji prikazuje deo za prijavu
$(document).ready(function(){
	$('#logg a').click(function(e){
		e.preventDefault();
		var pos = $('.login').innerHeight();
		$('.login').animate({top: -pos-5},{duration:400});
	});
	$("#log a").click(function(e){
		e.preventDefault();
	    $(".login").animate({top: 0},{duration:400});
	});

  $('.formlogin').on('submit', function(event){
    var userName = $(this).find('input[name=userName]');
    var password = $(this).find('input[name=password]');
    if(!login(userName) || !login(password)){
      return false;
    }
    else{
        // setup some local variables
        var form = $(this);
        // let's select and cache all the fields
        var inputs = form.find("input");
        // serialize the data in the form
        var serializedData = form.serialize();

        // let's disable the inputs for the duration of the ajax request
        inputs.prop("disabled", true);

        // fire off the request to /form.php
        request = $.ajax({
            url: "includes/loginProcess.php",
            type: "post",
            data: serializedData

        });
        // callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR){
          if(response == 'uspeh'){
            window.location.reload();
          }
          else{
            $('.innfo').text(response);
          }
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

});

function login(fld) {
  var illegalChars = /\W/; // dozvoljava unosenje samo slova, brojeva i donjih crta
  if (fld.val().length == 0) {
    return false;
  }
  else if ((fld.val().length < 5) || (fld.val().length > 15)) {
    return false;
  }
  else if (illegalChars.test(fld.val())) {
    return false;
  }
  else {
    return true;
  } 
}