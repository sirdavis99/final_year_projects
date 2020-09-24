<?php
	$this->load->view("global/includes/head");
	$this->load->view("global/admin/nav_head");
?>

<main class="spaced" style="background: url(<?=base_url()?>assets/imgs/places.jpg)">

	<div class="container col-md-10 mb-3">
		<div class="card">
			<div class="card-header">
				<h5><b>Select Place</b></h5>
			</div>

			<div class="card-body">

				<?php $this->load->view('global/includes/alerts'); ?>

				<form method="post" id="add">
					
					<div class="form-group">
						<select id="plan_area" name="area" class="custom-select form-control rounded">
							<?php
								if(!empty(set_value('comment'))):
									echo '<option>'.set_value('comment').'</option>';
								endif;
							?>
							<option value="" disabled selected>Select Area</option>
							<?php 
								if($places):
									$areas = array();

									foreach ($places as $place) {
										
										if(!in_array(trim($place->area), $areas)):
											array_push($areas, trim($place->area));
											echo '<option value="'.$place->area.'">'.$place->area.'</option>';
										endif;

									}

								else:
									echo '<option value="" disabled>No record yet</option>';
								endif;
							?>
						</select>
						
					</div>

					<div class="form-group" id="plan_places">
						

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
							<th>Area</th>
							<th>Day 1</th>
							<th>Day 2</th>
							<th>Day 3</th>
							<th>Logged</th>
							<th>Actions</th>
						</tr>
					</thead>

					<tbody>
						<?php
							if($plans):
								// print_r($usrs);
								foreach($plans as $plan):
									$day1 = $this->place_act->fetch_places(["id"=>$plan->day1], true);
									$day2 = $this->place_act->fetch_places(["id"=>$plan->day2], true);
									$day3 = $this->place_act->fetch_places(["id"=>$plan->day3], true);
						?>
						<tr>
							<td><?=$plan->id?></td>
							<td><?=$plan->area?></td>
							<td><?=isset($day1->name) ? $day1->name : "data/error"?></td>
							<td><?=isset($day2->name) ? $day2->name : "data/error"?></td>
							<td><?=isset($day3->name) ? $day3->name : "data/error"?></td>
							<td><?=$plan->logged?></td>
							<td>
								<a class="btn btn-block btn-success" href="<?=base_url()?>plan/view/<?=$plan->id?>">
									view
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