<?php
	$this->load->view("global/includes/head");
	$this->load->view("global/admin/nav_head");
?>

<main class="spaced d-flex" style="background: url(<?=base_url()?>assets/imgs/places.jpg)">

	<div class="container col-md-10 mb-3 align-self-center">
		<div class="card">
			<div class="card-header">
				<h5><b>Feedback</b></h5>
			</div>

			<div class="card-body">

				<?php $this->load->view('global/includes/alerts'); ?>

				<form method="post" id="add">
					
					<div class="md-form mt-0 md-outline">
						<textarea rows="5" id="feed" name="comment" class="form-control rounded"><?=set_value('comment')?></textarea>
						<label for="feed">Write a comment</label>
					</div>

					<div class="form-group">
						<button class="btn btn-success btn-block rounded-pill" type="submit" >
							<b>Submit</b>
						</button>
					</div>
				</form>
			</div>

		</div>
	</div>


</main>

<?php
	$this->load->view("global/includes/foot");
?>