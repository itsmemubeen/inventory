<?php
$update = $this->db->get_where('vendors', array(
    'id' => $param2
))->result_array();
foreach ($update as $row):
    ?>

    <?php
    echo form_open(base_url() . 'index.php?admin/getVendors/edit/' . $row['id'], array(
        'class' => 'form-horizontal form-bordered', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
    ));
    ?>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Image
        </label>

        <div class="col-md-6 col-sm-6">
            <img style="height: 50% ; width: 50%;"
                 src="<?php echo $this->crud_model->get_image_url('employee', $row['id']); ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Vendor Name
        </label>
        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="name" required
                placeholder="Vendor Name" value="<?php echo $row['name']; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Vendor CNIC/NTN
        </label>
        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="cnic/ntn" required
                placeholder="Vendor CNIC/NTN" value="<?php echo $row['cnic/ntn']; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Vendor SALES
        </label>
        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="sales" required
                placeholder="Vendor SALES" value="<?php echo $row['sales']; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Vendor With Holding TAX %
        </label>
        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="whtax" required
                placeholder="Vendor With Holding TAX %" value="<?php echo $row['whtax']; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Vendor Sales TAX %
        </label>
        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="sales_tax" required
                placeholder="Vendor Sales TAX %" value="<?php echo $row['whtax']; ?>"/>
        </div>
    </div>
    <!-- <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Address
        </label>

        <div class="col-md-6 col-sm-6">
            <textarea class="form-control" name="address" placeholder="Stuff Address"
                      rows="3"><?php echo $row['address']; ?></textarea>
        </div>
    </div> -->

    <!-- <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Image
        </label>

        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="file" name="userfile"
                   placeholder="Stuff Image"/>
        </div>
    </div> -->

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4"></label>
        <div class="col-md-6 col-sm-6">
            <button type="submit" class="btn btn-success">Update User</button>
        </div>
    </div>

    <?php echo form_close(); ?>
<?php endforeach; ?>
