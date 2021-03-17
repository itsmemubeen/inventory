
<?php 
    echo form_open(base_url() . 'index.php?admin/getVendors/create/' , array(
        'class' => 'form-horizontal form-bordered' , 'data-parsley-validate' => 'true' , 'enctype' => 'multipart/form-data'
    ));
?>

	<!-- <div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Vendor ID
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="customer_code" required
				placeholder="" value="<?php echo substr(md5(rand(100000000, 200000000)), 0, 10);?>" readonly />
		</div>
	</div> -->

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Vendor Name
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="name" required
				placeholder="Vendor Name"/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Vendor CNIC/NTN
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="cnic" required
				placeholder="Vendor CNIC/NTN"/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Vendor SALES
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="sales" required
				placeholder="Vendor SALES"/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Vendor With Holding TAX %
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="whtax" required
				placeholder="Vendor With Holding TAX %"/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Vendor Sales TAX %
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="sales_tax" required
				placeholder="Vendor Sales TAX %"/>
		</div>
	</div>

	<!-- <div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Email
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="email" name="email"
				placeholder="Vendor Email" required/>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Password
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="password" name="password"
				placeholder="Vendor Password" required/>
		</div>
	</div> -->

	<!-- <div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Gender
		</label>
		<div class="col-md-6 col-sm-6">
		    <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-default" name="gender">
                <option value="" selected>Select Gender</option>
                <option value="1">Male</option>
                <option value="2">Female</option>
            </select>
		</div>
	</div> -->

	<!-- <div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Discount
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="discount_percentage" required
				placeholder="Vendor Discount Percentage" />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Image
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="file" name="userfile"
				placeholder="Vendor Image" />
		</div>
	</div> -->

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4"></label>
		<div class="col-md-6 col-sm-6">
			<button type="submit" class="btn btn-success">Save Vendor</button>
		</div>
	</div>

<?php echo form_close();?>

<script type="text/javascript">
	$(".selectpicker").selectpicker();
</script>