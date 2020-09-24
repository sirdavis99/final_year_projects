<?php
	$this->load->view("global/includes/head");
	$this->load->view("global/user/nav_head");
?>

<main class="spaced row" style="background: url(<?=base_url()?>assets/imgs/places.jpg)">

	<?php 
		if($places): 
			foreach ($places as $place):
	?>
	<div class="col-md-6 mb-3">

		<div class="card">
			<div class="card-header">
				<h5><b><?=$place->area?> : <?=$place->name?></b></h5>
			</div>
			<div class="card-body">
				<div class="mb-3">
					<img class="img-fluid img-thumbnail" src="<?=base_url()?>uploads/places/<?=$place->image?>">
				</div>
				<div>
					<div class="h5 text-muted text-capitalize"><b><?=$place->name?></b></div>
					<p><?=$place->description?></p>
				</div>
				<hr/>
				<div class="w-100 overflow-auto">
					<?=htmlspecialchars_decode(stripslashes($place->gps))?>
				</div>
			</div>

		</div>
	</div>
	<?php 
			endforeach;
		else:
	?>
		<div class="container text-center p-4 card">
			<h4 class="text-muted">No record yet</h4>
		</div>
	<?php
		endif;
	?>

</main>

<?php
	$this->load->view("global/includes/foot");
?>