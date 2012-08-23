<div class="page-header">
	Login
</div>
<div class="row">
	<div class="span12">
		<form class="form-vertical" action="<?php echo $this->make_route('/login'); ?>" method="post">
			<fieldset>
				<?php Bootstrap::make_input('username', 'Username', 'text'); ?>
				<?php Bootstrap::make_input('password', 'Password', 'password'); ?>
				<div class="form-actions">
					<button class="btn btn-primary">Login!</button>
				</div>
			</fieldset>	
		</form>
	</div>
</div>