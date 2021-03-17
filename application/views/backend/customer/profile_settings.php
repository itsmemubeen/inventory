<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $page_title; ?>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>index.php?customer/dashboard">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php?customer/profile_settings">
                    Profile Settings
                </a>
            </li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <!-- begin panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h4 class="panel-title">
                            Basic Information
                        </h4>
                    </div>
                    <div class="panel-body">
                        <?php
                        echo form_open(base_url() . 'index.php?customer/profile_settings/update/', array(
                            'class' => 'form-horizontal form-bordered', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
                        ));
                        ?>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3">
                                Image
                            </label>

                            <div class="col-md-9 col-sm-9">
                                <img style="height: 50% ; width: 50%;"
                                     src="<?php echo $this->crud_model->get_image_url($logged_in_user_type, $logged_in_user_id); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3">
                                Name
                            </label>

                            <div class="col-md-9 col-sm-9">
                                <input class="form-control" type="text" name="name" data-parsley-required="true"
                                       placeholder="Your Name"
                                       value="<?php echo $logged_in_user_name; ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3">
                                Email
                            </label>

                            <div class="col-md-9 col-sm-9">
                                <input class="form-control" type="text" name="email" data-parsley-required="true"
                                       placeholder="Your Email"
                                       value="<?php echo $this->db->get_where($logged_in_user_type, array(
                                           $logged_in_user_type . '_id' => $logged_in_user_id
                                       ))->row()->email; ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3">
                                Image
                            </label>

                            <div class="col-md-9 col-sm-9">
                                <input class="form-control" type="file" name="userfile"
                                       placeholder="Your Image"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3"></label>

                            <div class="col-md-9 col-sm-9">
                                <button type="submit" class="btn btn-github">Update Profile</button>
                            </div>
                        </div>

                        <?php echo form_close(); ?>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <div class="col-md-6">
                <!-- begin panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h4 class="panel-title">
                            Change Password
                        </h4>
                    </div>
                    <div class="panel-body">
                        <?php
                        echo form_open(base_url() . 'index.php?customer/profile_settings/change_password/', array(
                            'class' => 'form-horizontal form-bordered', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
                        ));
                        ?>

                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-5">
                                Current Password
                            </label>

                            <div class="col-md-7 col-sm-7">
                                <input class="form-control" type="password" name="previous_password"
                                       data-parsley-required="true"
                                       placeholder="Current Password"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-5">
                                New Password
                            </label>

                            <div class="col-md-7 col-sm-7">
                                <input class="form-control" type="password" name="new_password"
                                       data-parsley-required="true"
                                       placeholder="New Password"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-5">
                                Conform Password
                            </label>

                            <div class="col-md-7 col-sm-7">
                                <input class="form-control" type="password" name="confirm_password"
                                       data-parsley-required="true"
                                       placeholder="Conform Password"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-5"></label>

                            <div class="col-md-7 col-sm-7">
                                <button type="submit" class="btn btn-facebook">Update Password</button>
                            </div>
                        </div>

                        <?php echo form_close(); ?>
                    </div>
                </div>
                <!-- end panel -->
            </div>
        </div>


    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->