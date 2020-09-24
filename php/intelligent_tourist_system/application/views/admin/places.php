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
				<h5><b>Add Places</b></h5>
			</div>
			<div class="card-body">
				
				<form action="<?=base_url()?>admin/places/add" method="post" id="add" enctype="multipart/form-data">

					<div class="md-form md-outline">
						<input type="text" id="nop" name="name" class="form-control" value="<?=set_value('name')?>">
						<label for="nop">Name of Place</label>
					</div>

					<div class="md-form md-outline">
						<textarea id="desc" name="description" class="form-control rounded"><?=set_value('description')?></textarea>
						<label for="desc">Description</label>
					</div>
					<div class="form-row">
						<div class="md-form md-outline mt-0 mb-3 col-md-6">
							<input type="text" id="area" name="area" class="form-control" value="<?=set_value('area')?>">
							<label for="area">Area</label>
						</div>
						<div class="md-form md-outline mt-0 mb-3 col-md-6">
							<input type="text" id="tag" name="tags" class="form-control" value="<?=set_value('tags')?>">
							<label for="tag">Tags</label>
						</div>
						
					</div>

					<div class="md-form md-outline mt-0">
						<textarea id="addr" name="address" class="form-control rounded"><?=set_value('address')?></textarea>
						<label for="addr">Address</label>
					</div>

					<div class="md-form md-outline mt-0">
						<input type="text" id="gps" name="gps" class="form-control" value="<?=set_value('gps')?>">
						<label for="gps">GPS Coordinates</label>
					</div>

					<div class="form-group">
						<div class="custom-file text-sm">
                            <input type="file" name="places" class=" custom-file-input" id="uploadproof" accept="image/*" onchange="$('form [type=submit]').removeAttr('disabled')" multiple />
                            <label class="custom-file-label hide-long-text" for="uploadproof">
                                <b>Choose Images (Only .jpg, .png )</b>
                            </label>
                        </div>
					</div>

					<div class="form-group">
						<button class="btn btn-success rounded-pill" type="submit">
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
				<h5><b>Places</b></h5>
			</div>
			<div>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>id</th>
							<th>Image</th>
							<th>Name</th>
							<th>Tags</th>
							<th>Description</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
						<?php
							if($places):
								foreach($places as $place):
						?>
						<tr>
							<td><?=$place->id?></td>
							<td style="max-width: 400px !important;">
								<img class="img-fluid img-thumbnail" src="<?=base_url()?>uploads/places/<?=$place->image?>">
							</th>
							<td><?=$place->name?></td>
							<td><?=$place->tag?></td>
							<td title="<?=$place->description?>">
								<?=substr($place->description, 0, 90)?>...
							</td>
							<td>
								<a class="btn btn-block btn-primary btn-sm mb-2" href="<?=base_url()?>admin/places/edit/<?=$place->id?>">
									Edit
								</a>
								<a class="btn btn-block btn-danger btn-sm" href="#" confirm="You are about to 'DELETE' a place from your records?" confirm-href="<?=base_url()?>admin/places/delete/<?=$place->id?>">
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