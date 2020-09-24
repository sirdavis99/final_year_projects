<?php
	$this->load->view("global/includes/head");
	$this->load->view("global/admin/nav_head");
?>

<main class="spaced" style="background: url(<?=base_url()?>assets/imgs/places.jpg)">

	<div class="container col-md-10">
		<?php $this->load->view('global/includes/alerts'); ?>
	</div>

	<div class="container col-md-10 mb-3">
		<div class="card">
			<div class="card-header">
				<h5><b>Feedbacks</b></h5>
			</div>
			<div>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>id</th>
							<th>Comments</th>
							<th>User</th>
							<th>Date</th>
							<th>Time</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
						<?php
							if($feeds):
								// print_r($usrs);
								foreach($feeds as $feed):
									$user = $this->usr->fetch_users_info(["uid"=>$feed->uid], true);
									$email = isset($user->email) ? $user->email : "no-email@error.com";
						?>
						<tr>
							<td><?=$feed->id?></td>
							<td title="<?=$feed->comment?>">
								<?=substr($feed->comment, 0, 30) ?>...
							</td>
							<td><?=$email?></td>
							<td><?=$feed->reg_date?></td>
							<td><?=$feed->reg_time?></td>
							
							<td>
								<a class="btn btn-block btn-danger btn-sm" href="#" confirm="You are about to 'DELETE' a Feedback from your records?" confirm-href="<?=base_url()?>admin/feedbacks/delete/<?=$feed->id?>">
									Delete
								</a>
							</td>
						</tr>
						<?php
								endforeach;
							else:
						?>
						<tr>
							<td class="text-center" colspan="6">No records found!</td>
						</tr>
						<?php
							endif;
						?>
					</tbody>
					
				</table>
			</div>

		</div>
	</div>


</main>

<?php
	$this->load->view("global/includes/foot");
?>