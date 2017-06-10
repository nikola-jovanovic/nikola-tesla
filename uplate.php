<?php
	session_start();
	error_reporting(0);
	include 'includes/head.php';
?>
	<body>
		<div class="wrapper">
			<div class="login">
				<?php
					include 'includes/login.php';
				?>
			</div>
			<div class="header">
				<?php
					include 'includes/header.php';
				?>
			</div>
			<div class="main">
				<div class="pics">
					<?php
						include 'includes/pics.php';
					?>
				</div>
				<div id="news">
					<?php
						include 'includes/vesti.php';
					?>
				</div>
			</div>
			<div class="left">
				<?php
					include 'includes/leftMenu.php';
					include 'includes/right.php';
				?>
			</div>
			<div class="middle">
				<div class="content">
					<?php					
					if(isset($_SESSION['valid_user'])){
						
						//pristup podacima dozvoljen samo administratoru
						if( $_SESSION['valid_user'] == "admin"){
							$type=$_GET['tip'];
						
							//donacije
							if ($type=="donacije"){
								include 'content/uplate_donacije.php';
							}
						
						
							//clanarina
							if ($type=="clanarine"){
								include 'content/uplate_clanarine.php';
							}
						}
					}					
					?>			
				</div>
			</div>
			<div class="right">
			
			</div>
			<div class="footer">
			<?php
					include 'includes/footer.php';
				?>

			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<?php
			if(!isset($_SESSION['valid_user'])) echo '<script type="text/javascript" src="javascript/login.js"></script>';
		?>

		<script type="text/javascript" src="javascript/submenu.js"></script>
		<script type="text/javascript" src="javascript/slideShow.js"></script>
		<script type="text/javascript" src="javascript/scrool.js"></script>
		<script type="text/javascript" src="javascript/verticalmenu.js"></script>
		<script type="text/javascript" src="javascript/utrosen.js"></script>
		<script type="text/javascript" src="javascript/provera.js"></script>
		<script type="text/javascript">
			skrol();
		</script>
	</body>
</html>