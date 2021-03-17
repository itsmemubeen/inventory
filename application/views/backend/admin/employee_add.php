<?php
echo form_open(base_url() . 'index.php?admin/employee/create/', array(
    'class' => 'form-horizontal form-bordered', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
));
?>

<div class="form-group">
    <label class="control-label col-md-4 col-sm-4">
        Name
    </label>

    <div class="col-md-6 col-sm-6">
        <input class="form-control" type="text" name="name" required
               placeholder="Stuff Name"/>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-4 col-sm-4">
        Email
    </label>

    <div class="col-md-6 col-sm-6">
        <input class="form-control" type="email" name="email" required
               placeholder="Stuff Email"/>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-4 col-sm-4">
        Department
    </label>

    <div class="col-md-6 col-sm-6">
        <input class="form-control" type="text" name="department" required
               placeholder="Staff Department"/>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-4 col-sm-4">
        Phone No
    </label>

    <div class="col-md-6 col-sm-6">
        <input class="form-control" type="text" name="pno" required
               placeholder="Staff Phone No"/>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-4 col-sm-4">
        Designation
    </label>

    <div class="col-md-6 col-sm-6">
        <input class="form-control" type="text" name="designation"
               placeholder="Staff Designation"/>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-4 col-sm-4"></label>

    <div class="col-md-6 col-sm-6">
        <button type="submit" class="btn btn-info">Create Employee</button>
    </div>
</div>

<?php echo form_close(); ?>
