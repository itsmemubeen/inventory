
<?php
	$update	=	$this->db->get_where('supplier' , array(
					'supplier_id' => $param2
				))->result_array();
	foreach ($update as $row):
?>

<?php 
    echo form_open(base_url() . 'index.php?employee/supplier/edit/' . $row['supplier_id'] , array(
        'class' => 'form-horizontal form-bordered' , 'data-parsley-validate' => 'true' , 'enctype' => 'multipart/form-data'
    ));
?>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Image
		</label>
		<div class="col-md-6 col-sm-6">
			<img style="height: 50% ; width: 50%;" src="<?php echo $this->crud_model->get_image_url('supplier' , $row['supplier_id']);?>">
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Company Name
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="company"
				placeholder="Supplier Company Name" value="<?php echo $row['company'];?>" />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Supplier Name
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="name" required
				placeholder="Supplier Name" value="<?php echo $row['name'];?>" />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Supplier Email
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="email" name="email" required
				placeholder="Supplier Email" value="<?php echo $row['email'];?>" />
		</div>
	</div>

    <div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Supplier Phone
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="phone"
				placeholder="Supplier Phone" value="<?php echo $row['phone'];?>" />
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
			<button type="submit" class="btn btn-info">Update Supplier Information</button>
		</div>
	</div>

<?php echo form_close();?>
<?php endforeach;?>
