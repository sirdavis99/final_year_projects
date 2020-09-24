<?php
	$this->load->view("global/includes/head");
	$this->load->view("global/user/nav_head");
?>

<main class="spaced">
	<div class="container col-md-5">
		<div class="card">
			<div class="card-header">
				<h3><b>Register Now</b></h3>
			</div>
			<div class="card-body">

				<?php $this->load->view('global/includes/alerts'); ?>

				<form class="" method="post" id="register">

					<div class="md-form md-outline">
						<input type="text" id="fname" name="fname" class="form-control" value="<?=set_value('fname')?>">
						<label for="fname">Full Name</label>
					</div>

					<div class="md-form md-outline">
						<input type="email" id="email" name="email" class="form-control"  value="<?=set_value('email')?>">
						<label for="email">Email Address</label>
					</div>

					<div class="md-form md-outline">
						<input type="text" id="phone" name="phone" class="form-control" value="<?=set_value('phone')?>">
						<label for="phone">Mobile Number</label>
					</div>

					<div class="md-form md-outline">
						<textarea id="address" name="address" class="form-control rounded"><?=set_value('address')?></textarea>
						<label for="address">Resident Address</label>
					</div>

					<div class="md-form md-outline">
						<input type="password" id="pass" name="password" class="form-control"  value="<?=set_value('password')?>">
						<label for="pass">Password</label>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-success btn-block rounded-pill">
							<b>Register</b>
						</button>
					</div>

					<div class="form-group text-muted text-center">
						<a href="<?=base_url()?>account/login" class="">Already own an account?</a>
					</div>

				</form>
			</div>

		</div>
	</div>
</main>


<?php
	$this->load->view("global/includes/foot");
?>