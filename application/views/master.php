<!DOCTYPE html>
<html>
	<?php $this->include('includes/head', ["title" => $title]); ?>
	<body>
		<div class="wrapper">
			<?php $this->include('includes/login'); ?>
			<?php $this->include('includes/header'); ?>
			<div class="main">
				<?php $this->include('includes/slider'); ?>
				<?php $this->include('includes/newest-news'); ?>
			</div>
			<div class="sadrzaj">
				<div class="left">
					<?php $this->include('includes/sidebar'); ?>
					<?php $this->include('includes/right'); ?>
				</div>
				<div class="middle">
					<div class="content">
						<?php $this->errors(); ?>
						<?php $this->content(); ?>
					</div>
				</div>
			</div>
			<?php $this->include('includes/footer'); ?>
		</div>
	</body>
</html>