
<?php 
    echo form_open(base_url() . 'index.php?employee/customer/create/' , array(
        'class' => 'form-horizontal form-bordered' , 'data-parsley-validate' => 'true' , 'enctype' => 'multipart/form-data'
    ));
?>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Customer Code
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="customer_code" required
				placeholder="" value="<?php echo substr(md5(rand(100000000, 200000000)), 0, 10);?>" readonly />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Customer Name
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="name" required
				placeholder="Customer Name" />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Email
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="email" name="email"
				placeholder="Customer Email" />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Password
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="password" name="password"
				placeholder="Customer Password" />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Gender
		</label>
		<div class="col-md-6 col-sm-6">
		    <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" name="gender">
                <option value="" selected>Select Gender</option>
                <option value="1">Male</option>
                <option value="2">Female</option>
            </select>
		</div>
	</div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
        	Address
        </label>
        <div class="col-md-6 col-sm-6">
            <textarea class="form-control" name="address" placeholder="Customer Address" rows="3"></textarea>
        </div>
    </div>

    <div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Phone
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="phone"
				placeholder="Customer Phone Number" />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Discount
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="discount_percentage" required
				placeholder="Customer Discount Percentage" />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Image
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="file" name="userfile"
				placeholder="Customer Image" />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4"></label>
		<div class="col-md-6 col-sm-6">
			<button type="submit" class="btn btn-success">Add New Customer</button>
		</div>
	</div>

<?php echo form_close();?>

