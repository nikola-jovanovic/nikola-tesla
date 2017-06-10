	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
	<?php
		if(!isset($_SESSION['valid_user'])) echo '<script type="text/javascript" src="javascript/login.js"></script>';
	?>
	<script type="text/javascript" src="javascript/submenu.js"></script>
	<script type="text/javascript" src="javascript/slideShow.js"></script>
	<script type="text/javascript" src="javascript/verticalmenu.js"></script>
	<script type="text/javascript" src="javascript/komentari.js"></script>
	<script type="text/javascript" src="javascript/like-unlike.js"></script>
	<script type="text/javascript" src="javascript/kolacici.js"></script>
	<script type="text/javascript" src="javascript/registracija.js"></script>
	<script type="text/javascript" src="javascript/latUcir.js"></script>
	<script type="text/javascript" src="javascript/provera.js"></script>
	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
				$(window).load(function(){
					var proba = checkCookie();
					if (proba){
						setCookie("slova","cirilica",31);
						$("#cirilica").attr('class', 'cirlatactive');
						$('#cirilica').attr('disabled','disabled');
						$('#latinica').removeAttr('disabled');
					}
					else{
						setCookie("slova","latinica",31);
						$("#latinica").attr('class', 'cirlatactive');
						$('#latinica').attr('disabled','disabled');
						$('#cirilica').removeAttr('disabled');
					}
									
				});
				$('#cirilica').click(function(e){
					e.preventDefault();
					setCookie("slova","cirilica",31);
					window.location.reload();
				});
				$('#latinica').click(function(e){
					e.preventDefault();
					setCookie("slova","latinica",31);
					window.location.reload();
				});
			});
		})(jQuery);
	</script>