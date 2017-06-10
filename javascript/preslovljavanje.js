$(document).ready(function(){
	$('#cirilica').click(function(e){
		e.preventDefault();
		$('a,p,li,span,h1,h2,h3').each(function(index) {	
			var text = $(this).html();
			text = latUcir_saLinkovima(text);
			//setCookie("slova","cirilica",31);
			$(this).html(text);
		});
	});
});