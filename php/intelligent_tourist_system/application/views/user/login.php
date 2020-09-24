<?php
	$this->load->view("global/includes/head");
	$this->load->view("global/user/nav_head");
?>


<main class="d-flex">
	<div class="container col-md-5 align-self-center">
		<div class="card">
			<div class="card-header">
				<h3>
					<b>Sign in</b>
				</h3>
			</div>
			<div class="card-body">

				<?php $this->load->view('global/includes/alerts'); ?>

				<form class="" method="post">
					
					<div class="md-form md-outline">
						<input type="text" id="username" name="email" class="form-control" value="<?=set_value('email')?>">
						<label for="username">Email Address</label>
					</div>

					<div class="md-form md-outline">
						<input type="password" id="password" name="password" class="form-control" value="<?=set_value('password')?>">
						<label for="password">Password</label>
					</div>

					<div class="form-group">
						<button class="btn btn-success btn-block rounded-pill" type="submit" >
							<b>Login</b>
						</button>
					</div>

					<div class="form-group text-muted text-center">
						<a href="<?=base_url()?>account/register" class="">Create an account?</a>
					</div>

				</form>


			</div>
		</div>
	</div>
</main>


<?php
	$this->load->view("global/includes/foot");
?>