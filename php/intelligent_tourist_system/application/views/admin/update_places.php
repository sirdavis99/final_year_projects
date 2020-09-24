<?php
	$this->load->view("global/includes/head");
	$this->load->view("global/admin/nav_head");
	$setval = false;
?>

<main class="spaced" style="background: url(<?=base_url()?>assets/imgs/places.jpg)">

	<div class="container col-md-10">
		<?php $this->load->view('global/includes/alerts'); ?>
	</div>

	<div class="container col-md-10 mb-3">
		<div class="card">
			<div class="card-header">
				<h5> <b>Edit Places</b> </h3>
			</div>
			<div class="card-body">
				
				<form action="<?=base_url()?>admin/places/edit/<?=$place->id?>" method="post" id="edit" enctype="multipart/form-data">

					<div class="md-form md-outline">
						<input type="text" id="nop" name="name" class="form-control" value="<?=!empty(set_value('name')) ? $setval : $place->name;?>">
						<label for="nop">Name of Place</label>
					</div>

					<div class="md-form md-outline">
						<textarea id="desc" name="description" class="form-control rounded"><?=!empty(set_value('description')) ? $setval : $place->description;?></textarea>
						<label for="desc">Description</label>
					</div>
					<div class="form-row">
						<div class="md-form md-outline mt-0 mb-3 col-md-6">
							<input type="text" id="area" name="area" class="form-control" value="<?=!empty(set_value('area')) ? $setval : $place->area;?>">
							<label for="area">Area</label>
						</div>
						<div class="md-form md-outline mt-0 mb-3 col-md-6">
							<input type="text" id="tag" name="tags" class="form-control" value="<?=!empty(set_value('tags')) ? $setval : $place->tag;?>">
							<label for="tag">Tags</label>
						</div>
						
					</div>

					<div class="md-form md-outline mt-0">
						<textarea id="addr" name="address" class="form-control rounded"><?=!empty(set_value('address')) ? $setval : $place->address;?></textarea>
						<label for="addr">Address</label>
					</div>

					<div class="md-form md-outline mt-0">
						<input type="text" id="gps" name="gps" class="form-control" value="<?=!empty(set_value('gps')) ? $setval : $place->gps;?>">
						<label for="gps">GPS Coordinates</label>
					</div>

					<div class="form-group">

						<div class="custom-control custom-checkbox mb-2">
						    <input type="checkbox"  class="custom-control-input" id="updt" name="updateimage" togdis="#uploadproof">
						    <label class="custom-control-label" for="updt">Update Image</label>
						</div>

						<div class="custom-file text-sm">
                            <input type="file" name="places" class="custom-file-input" id="uploadproof" accept="image/*" onchange="$('form [type=submit]').removeAttr('disabled')" disabled/>
                            <label class="custom-file-label hide-long-text" for="uploadproof">
                                <b>
                                	<?=!empty($place->image) ? $place->image : "Choose Images (Only .jpg, .png )";?>
                                </b>
                            </label>
                        </div>
					</div>

					<div class="form-group">
						<button class="btn btn-success rounded-pill" type="submit">
							<b>Update</b>
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