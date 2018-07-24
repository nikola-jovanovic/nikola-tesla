// prikazuje podmeni u pomocnom meniju
  $(document).ready(function(){
  	$('#navigacija li a').hover(function(){
              $(this).stop().animate({  marginLeft: '4%' }, 'fast');
          }, function(){
              $(this).stop().animate({ marginLeft: '0' }, 'fast');
         });

  	$('.expand').click(function(e) {
      e.preventDefault();
  		if ($(this).next().css('display') == 'none'){	//collapse it
        $('#navigacija>li ul:visible').slideUp();
        $(this).next().slideDown();
      }
  		else	//expand it and collapse all others
        	{	
        		$(this).next().slideUp();
  		}
    });

    $('.expandProjekti').click(function(e) {
      e.preventDefault();
    });

    $('.active').parent().parent().show();
    $('.active').parent().parent().parent().parent().show();
    
    $('.odd, .odd1, .odd2').click(function(e) {
      e.preventDefault();
    });
  });