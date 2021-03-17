
<?php 
	$update	=	$this->db->get_where('category' , array(
					'category_id' => $param2
				))->result_array();
	foreach ($update as $row):
?>

<?php 
    echo form_open(base_url() . 'index.php?admin/add_product_category/edit/' . $row['category_id'] , array(
        'class' => 'form-horizontal form-bordered' , 'data-parsley-validate' => 'true' , 'enctype' => 'multipart/form-data'
    ));
?>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Name
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="name" required
				placeholder="Name" value="<?php echo $row['name'];?>" />
		</div>
	</div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
        	Description
        </label>
        <div class="col-md-6 col-sm-6">
            <textarea class="form-control" name="description" placeholder="Category Description" rows="3"><?php echo $row['description'];?></textarea>
        </div>
    </div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4"></label>
		<div class="col-md-6 col-sm-6">
			<button type="submit" class="btn btn-success">Update</button>
		</div>
	</div>

<?php echo form_close();?>
<?php endforeach;?>
