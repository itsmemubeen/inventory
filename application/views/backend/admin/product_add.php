

<?php 
    echo form_open(base_url() . 'index.php?admin/getAllProducts/create/' , array(
        'class' => 'form-horizontal form-bordered' , 'data-parsley-validate' => 'true' , 'enctype' => 'multipart/form-data'
    ));
?>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Serial No
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="serial_number" required
				placeholder="" value="" />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Product Name
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="name" required
				placeholder="Product Amount" />
		</div>
	</div>

	<!-- <div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Category
		</label>
		<div class="col-md-6 col-sm-6">
		    <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-default" name="category_id">
                <option value="" selected>Select Product Category</option>
                <?php 
                	$categories	=	$this->db->get('category')->result_array();
                	foreach ($categories as $row):
                ?>
                	<option value="<?php echo $row['category_id'];?>"><?php echo $row['name'];?></option>
            	<?php endforeach;?>
            </select>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Sub Category
		</label>
		<div class="col-md-6 col-sm-6">
		    <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-default" name="sub_category_id">
                <option value="" selected>Select Product Sub Category</option>
                <?php 
                	$sub_categories	=	$this->db->get('sub_category')->result_array();
                	foreach ($sub_categories as $row):
                ?>
                	<option value="<?php echo $row['sub_category_id'];?>"><?php echo $row['name'];?></option>
            	<?php endforeach;?>
            </select>
		</div>
	</div> -->

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Amount
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="amount" required
				placeholder="Product Purchase Price" />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Type
		</label>
		<div class="col-md-6 col-sm-6">
			<select name="type" class="form-control">
				<option>Inch</option>
				<option>Ft</option>
				<option>Qty</option>
			</select>
		</div>
	</div>

   <!--  <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
        	Note
        </label>
        <div class="col-md-6 col-sm-6">
            <textarea class="form-control" name="note" rows="3"></textarea>
        </div>
    </div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Image
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="file" name="userfile"
				placeholder="Product Image" />
		</div>
	</div> -->

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4"></label>
		<div class="col-md-6 col-sm-6">
			<button type="submit" class="btn btn-success">Save Product</button>
		</div>
	</div>

<?php echo form_close();?>

<script type="text/javascript">
	$(".selectpicker").selectpicker();
</script>