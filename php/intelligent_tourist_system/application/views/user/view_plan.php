<?php
	$this->load->view("global/includes/head");
	$this->load->view("global/user/nav_head");
?>

<main class="spaced row" style="background: url(<?=base_url()?>assets/imgs/places.jpg)">

	<?php
		if($plan):
			$day1 = $this->place_act->fetch_places(["id"=>$plan->day1], true);
			$day2 = $this->place_act->fetch_places(["id"=>$plan->day2], true);
			$day3 = $this->place_act->fetch_places(["id"=>$plan->day3], true);
	?>

	<div class="container col-md-6 mb-3">

		<div class="card">
			<div class="card-header">
				<h5><b>Day 1 : <?=$day1->name?></b></h5>
			</div>
			<div class="card-body">
				<div class="mb-3">
					<img class="img-fluid img-thumbnail" src="<?=base_url()?>uploads/places/<?=$day1->image?>">
				</div>
				<div>
					<div class="h5 text-muted text-capitalize"><b><?=$day1->name?></b></div>
					<p><?=$day1->description?></p>
				</div>
				<hr/>
				<div class="w-100 overflow-auto">
					<?=htmlspecialchars_decode(stripslashes($day1->gps))?>
				</div>
			</div>

		</div>
	</div>

	<div class="container col-md-6 mb-3">

		<div class="card">
			<div class="card-header">
				<h5><b>Day 2 : <?=$day2->name?></b></h5>
			</div>
			<div class="card-body">
				<div class="mb-3">
					<img class="img-fluid img-thumbnail" src="<?=base_url()?>uploads/places/<?=$day2->image?>">
				</div>
				<div>
					<div class="h5 text-muted text-capitalize"><b><?=$day2->name?></b></div>
					<p><?=$day2->description?></p>
				</div>
				<hr/>
				<div class="w-100 overflow-auto">
					<?=htmlspecialchars_decode(stripslashes($day2->gps))?>
				</div>
			</div>

		</div>
	</div>

	<div class="container col-md-6 mb-3">

		<div class="card">
			<div class="card-header">
				<h5><b>Day 3 : <?=$day3->name?></b></h5>
			</div>
			<div class="card-body">
				<div class="mb-3">
					<img class="img-fluid img-thumbnail" src="<?=base_url()?>uploads/places/<?=$day3->image?>">
				</div>
				<div>
					<div class="h5 text-muted text-capitalize"><b><?=$day3->name?></b></div>
					<p><?=$day3->description?></p>
				</div>
				<hr/>
				<div class="w-100 overflow-auto">
					<?=htmlspecialchars_decode(stripslashes($day3->gps))?>
				</div>
			</div>

		</div>
	</div>

	<?php
		endif;
	?>

</main>

<?php
	$this->load->view("global/includes/foot");
?>