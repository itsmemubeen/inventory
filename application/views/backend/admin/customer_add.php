
<?php 
    echo form_open(base_url() . 'index.php?admin/getClients/create/' , array(
        'class' => 'form-horizontal form-bordered' , 'data-parsley-validate' => 'true' , 'enctype' => 'multipart/form-data'
    ));
?>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Client ID
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="customer_code" required
				placeholder="" value="<?php echo substr(md5(rand(100000000, 200000000)), 0, 10);?>" readonly />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Client Name
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="name" required
				placeholder="Client Name"/>
		</div>
	</div>

	<!-- <div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Email
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="email" name="email"
				placeholder="Client Email" required/>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Password
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="password" name="password"
				placeholder="Client Password" required/>
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

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
        	Address
        </label>
        <div class="col-md-6 col-sm-6">
            <textarea class="form-control" name="address" placeholder="Client Address" rows="3"></textarea>
        </div>
    </div>

    <div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Phone
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="phone"
				placeholder="Client Phone number" />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Client/Pop
		</label>
		<div class="col-md-6 col-sm-6">
			<select id="clientselec" name="client_pop" class="form-control">
				<option value="client">Client</option>
				<option value="pop">Pop</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Pop
		</label>
		<div class="col-md-6 col-sm-6">
			<select onchange="return add_product_for_order(this.value)"
                                            class="form-control selectpicker" data-size="10" data-live-search="true"
                                            data-style="btn-default" name="pop_id">
                                        <option value="" selected>Add A Product</option>
                                        <?php
                                        $products = $this->db->query('select * from pop;')->result_array();
                                        foreach ($products as $row):
                                            ?>
                                            <option value="<?php echo $row['pop_id']; ?>">
                                                <?php echo $row['pop_name']; ?> ( <?php echo $row['pop_location']; ?> )
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
		</div>
	</div>

	<script type="text/javascript">
		$("#clientselec").change(function(){
			
			$val = $("#clientselec").val();

			if($val == "pop"){
				$("#popvalue").prop("disabled",false);
			}
			else{
				$("#popvalue").prop("disabled",true);
			}
		});
	</script>

	<!-- <div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Discount
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="text" name="discount_percentage" required
				placeholder="Client Discount Percentage" />
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4">
			Image
		</label>
		<div class="col-md-6 col-sm-6">
			<input class="form-control" type="file" name="userfile"
				placeholder="Client Image" />
		</div>
	</div> -->

	<div class="form-group">
		<label class="control-label col-md-4 col-sm-4"></label>
		<div class="col-md-6 col-sm-6">
			<button type="submit" class="btn btn-success">Save Client</button>
		</div>
	</div>

<?php echo form_close();?>

<script type="text/javascript">
	$(".selectpicker").selectpicker();
</script>