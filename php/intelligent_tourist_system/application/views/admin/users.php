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
				<h5><b>Users</b></h5>
			</div>
			<div>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>id</th>
							<th>Name</th>
							<th>Email Address</th>
							<th>Contact No</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
						<?php
							if($usrs):
								// print_r($usrs);
								foreach($usrs as $usr):
						?>
						<tr>
							<td><?=$usr->id?></td>
							<td><?=$usr->name?></td>
							<td><?=$usr->email?></td>
							<td><?=$usr->phone?></td>
							<td title="<?=$usr->address?>">
								<?=substr($usr->address, 0, 20)?>...
							</td>
							<td>
								<a class="btn btn-block btn-danger btn-sm" href="#" confirm="You are about to 'DELETE' a User from your records?" confirm-href="<?=base_url()?>admin/users/delete/<?=$usr->id?>">
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