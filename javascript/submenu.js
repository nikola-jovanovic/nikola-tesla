// prikazuje podmeni u glavnom meniju
$(document).ready(function(){
	$('#over1,.submenu1').mouseover(function(){
		$('.submenu1').show();
	});
	$('#over1,.submenu1').mouseout(function(){
		$('.submenu1').hide();
	});
	$('#over2,.submenu2').mouseover(function(){
		$('.submenu2').show();
	});
	$('#over2,.submenu2').mouseout(function(){
		$('.submenu2').hide();
	});
});

