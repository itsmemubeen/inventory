<?php
$update = $this->db->get_where('customer', array(
    'customer_id' => $param2
))->result_array();
foreach ($update as $row):
    ?>

    <?php
    echo form_open(base_url() . 'index.php?employee/customer/edit/' . $row['customer_id'], array(
        'class' => 'form-horizontal form-bordered', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
    ));
    ?>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Image
        </label>

        <div class="col-md-6 col-sm-6">
            <img style="height: 50% ; width: 50%;"
                 src="<?php echo $this->crud_model->get_image_url('customer', $row['customer_id']); ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Customer Code
        </label>

        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="customer_code" required
                   placeholder="" value="<?php echo $row['customer_code']; ?>" readonly/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Customer Name
        </label>

        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="name" required
                   placeholder="Customer Name" value="<?php echo $row['name']; ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Email
        </label>

        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="email" name="email"
                   placeholder="Customer Email" value="<?php echo $row['email']; ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Gender
        </label>

        <div class="col-md-6 col-sm-6">
            <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-default"
                    name="gender">
                <option value="" selected>Select Gender</option>
                <option value="1" <?php if ($row['gender'] == 1) echo 'selected'; ?>>
                    Male
                </option>
                <option value="2" <?php if ($row['gender'] == 2) echo 'selected'; ?>>
                    Female
                </option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Address
        </label>

        <div class="col-md-6 col-sm-6">
            <textarea class="form-control" name="address" placeholder="Customer Address"
                      rows="3"><?php echo $row['address']; ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Phone
        </label>

        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="phone"
                   placeholder="Customer Phone Number" value="<?php echo $row['phone']; ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Discount
        </label>

        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="discount_percentage" required
                   value="<?php echo $row['discount_percentage']; ?>"
                   placeholder="Customer Discount Percentage"/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Image
        </label>

        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="file" name="userfile"
                   placeholder="Customer Image"/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4"></label>

        <div class="col-md-6 col-sm-6">
            <button type="submit" class="btn btn-success">Update Customer Information</button>
        </div>
    </div>

    <?php echo form_close(); ?>
<?php endforeach; ?>

<script type="text/javascript">
    $(".selectpicker").selectpicker();
</script>