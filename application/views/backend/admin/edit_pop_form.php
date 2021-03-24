<?php
$update = $this->db->get_where('pop', array(
    'pop_id' => $param2
))->result_array();
foreach ($update as $row):
    ?>

    <?php
    echo form_open(base_url() . 'index.php?admin/getpop/edit/' . $row['pop_id'], array(
        'class' => 'form-horizontal form-bordered', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
    ));
    ?>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            POP ID
        </label>
        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="pop_id" required
                placeholder="" value="<?php echo $row['pop_id'];?>" readonly />
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            POP Name
        </label>
        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="name" required
                placeholder="POP Name" value="<?php echo $row['pop_name'] ?>" />
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            POP Location
        </label>
        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="location" required
                placeholder="POP Location" value="<?php echo $row['pop_location'] ?>" />
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            POP Created
        </label>
        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="created" required
                placeholder="POP Created" value="<?php echo $row['created_by'] ?>" />
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Date Created
        </label>
        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="date" required
                placeholder="Date Created" value="<?php echo $row['date'] ?>" />
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4"></label>
        <div class="col-md-6 col-sm-6">
            <button type="submit" class="btn btn-success">Update Client</button>
        </div>
    </div>

<?php echo form_close();?>
<?php endforeach; ?>
