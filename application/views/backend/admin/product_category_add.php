


<?php 
    echo form_open(base_url() . 'index.php?admin/add_product_category/create/' , array(
        'class' => 'form-horizontal form-bordered' , 'data-parsley-validate' => 'true' , 'enctype' => 'multipart/form-data'
    ));
?>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Name
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="name" required
				placeholder="Name" />
		</div>
	</div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
        	Description
        </label>
        <div class="col-md-6 col-sm-6">
            <textarea class="form-control" name="description" placeholder="Category Description" rows="3"></textarea>
        </div>
    </div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4"></label>
		<div class="col-md-6 col-sm-6">
			<button type="submit" class="btn btn-success">Save Category</button>
		</div>
	</div>

<?php echo form_close();?>
