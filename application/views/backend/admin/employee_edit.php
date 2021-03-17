<?php
$update = $this->db->get_where('employee', array(
    'employee_id' => $param2
))->result_array();
foreach ($update as $row):
    ?>

    <?php
    echo form_open(base_url() . 'index.php?admin/employee/edit/' . $row['employee_id'], array(
        'class' => 'form-horizontal form-bordered', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
    ));
    ?>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Image
        </label>

        <div class="col-md-6 col-sm-6">
            <img style="height: 50% ; width: 50%;"
                 src="<?php echo $this->crud_model->get_image_url('employee', $row['employee_id']); ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Stuff Name
        </label>

        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="name"
                   placeholder="Stuff Name" value="<?php echo $row['name']; ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Stuff Email
        </label>

        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="email"
                   placeholder="Stuff Email" value="<?php echo $row['email']; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Phone
        </label>

        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="phone"
                   placeholder="Stuff Phone Number" value="<?php echo $row['phone']; ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Address
        </label>

        <div class="col-md-6 col-sm-6">
            <textarea class="form-control" name="address" placeholder="Stuff Address"
                      rows="3"><?php echo $row['address']; ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Image
        </label>

        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="file" name="userfile"
                   placeholder="Stuff Image"/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4"></label>

        <div class="col-md-6 col-sm-6">
            <button type="submit" class="btn btn-success">Update User</button>
        </div>
    </div>

    <?php echo form_close(); ?>
<?php endforeach; ?>
