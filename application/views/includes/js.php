	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
	<?php if(!isset($_SESSION['valid_user'])) { ?> 
		<script type="text/javascript" src="js/login.js"></script>
	<?php } ?>
	<script type="text/javascript" src="/public/js/submenu.js"></script>
	<script type="text/javascript" src="/public/js/slideShow.js"></script>
	<script type="text/javascript" src="/public/js/verticalmenu.js"></script>
	<script type="text/javascript" src="/public/js/komentari.js"></script>
	<script type="text/javascript" src="/public/js/like-unlike.js"></script>
	<script type="text/javascript" src="/public/js/kolacici.js"></script>
	<script type="text/javascript" src="/public/js/registracija.js"></script>
	<script type="text/javascript" src="/public/js/latUcir.js"></script>
	<script type="text/javascript" src="/public/js/provera.js"></script>
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