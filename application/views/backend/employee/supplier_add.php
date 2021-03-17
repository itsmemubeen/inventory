
<?php 
    echo form_open(base_url() . 'index.php?employee/supplier/create/' , array(
        'class' => 'form-horizontal form-bordered' , 'data-parsley-validate' => 'true' , 'enctype' => 'multipart/form-data'
    ));
?>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Company Name
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="company"
				placeholder="Supplier Company Name" />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Supplier Name
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="name" required
				placeholder="Supplier Name" />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Email
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="email" name="email"
				placeholder="Supplier Email" />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Phone
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="phone"
				placeholder="Supplier Phone Number" />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Image
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="file" name="userfile"
				placeholder="Supplier Image" />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4"></label>
		<div class="col-md-6 col-sm-6">
			<button type="submit" class="btn btn-success">Create Supplier</button>
		</div>
	</div>

<?php echo form_close();?>