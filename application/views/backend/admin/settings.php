<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $page_title; ?>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>index.php?admin/dashboard">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php?admin/settings">
                    Application Settings
                </a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-7">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Software Information</h4>
                    </div>
                    <div class="panel-body">
                        <?php
                        echo form_open(base_url() . 'index.php?admin/settings/update/', array(
                            'class' => 'form-horizontal form-bordered', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
                        ));
                        ?>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3">
                                Company Name
                            </label>

                            <div class="col-md-9 col-sm-9">
                                <input class="form-control" type="text" name="company_name" data-parsley-required="true"
                                       placeholder="Company Name"
                                       value="<?php echo $this->db->get_where('settings', array('type' => 'company_name'))->row()->description; ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3">
                                Company Email
                            </label>

                            <div class="col-md-9 col-sm-9">
                                <input class="form-control" type="text" name="company_email"
                                       data-parsley-required="true"
                                       placeholder="Company Email"
                                       value="<?php echo $this->db->get_where('settings', array('type' => 'company_email'))->row()->description; ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3">
                                <?php echo('address'); ?>
                            </label>

                            <div class="col-md-9 col-sm-9">
                                <input class="form-control" type="text" name="address" placeholder="Address"
                                       value="<?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description; ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3">
                                <?php echo('phone'); ?>
                            </label>

                            <div class="col-md-9 col-sm-9">
                                <input class="form-control" type="text" name="phone" placeholder="Phone"
                                       value="<?php echo $this->db->get_where('settings', array('type' => 'phone'))->row()->description; ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3">
                                <?php echo('currency'); ?>
                            </label>

                            <div class="col-md-9 col-sm-9">
                                <input class="form-control" type="text" name="currency" placeholder="Currency"
                                       value="<?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description; ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3">
                                VAT percentage
                            </label>

                            <div class="col-md-9 col-sm-9">
                                <input class="form-control" type="text" name="vat_percentage"
                                       placeholder="VAT percentage"
                                       value="<?php echo $this->db->get_where('settings', array('type' => 'vat_percentage'))->row()->description; ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3">
                                Select Theme
                            </label>

                            <div class="col-md-9 col-sm-9">
                                <?php $theme_name = ucwords(str_replace('-', ' ', $this->db->get_where('settings', array('type' => 'theme'))->row()->description)); ?>
                                <select class="form-control" data-size="10" data-live-search="true"
                                        data-style="btn-white" name="theme">
                                    <option
                                        selected="<?php echo $this->db->get_where('settings', array('type' => 'theme'))->row()->description; ?>">
                                        <?php echo substr(strstr($theme_name, " "), 1); ?></option>
                                    <option value="skin-blue">Blue</option>
                                    <option value="skin-black">Black</option>
                                    <option value="skin-purple">Purple</option>
                                    <option value="skin-green">Green</option>
                                    <option value="skin-red">Red</option>
                                    <option value="skin-yellow">Yellow</option>
                                    <option value="skin-blue-light">Blue Light</option>
                                    <option value="skin-black-light">Black Light</option>
                                    <option value="skin-purple-light">Purple Light</option>
                                    <option value="skin-green-light">Green Light</option>
                                    <option value="skin-red-light">Red Light</option>
                                    <option value="skin-yellow-light">Yellow Light</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                <img class="img-circle" style="height: 20% ; width: 20%;"
                                     src="<?php echo base_url(); ?>uploads/logo/logo.png">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                <input class="form-control" type="file" name="userfile"
                                       placeholder="System Logo"/>
                            </div>
                        </div>

<!--                        <hr>-->
<!--                        <h3>Email Settings</h3>-->
<!---->
<!--                        <div class="form-group">-->
<!--                            <label class="control-label col-md-3 col-sm-3">-->
<!--                                SMTP Host-->
<!--                            </label>-->
<!---->
<!--                            <div class="col-md-9 col-sm-9">-->
<!--                                <input class="form-control" type="text" name="smtp_host" placeholder="SMTP host"-->
<!--                                       value="--><?php //echo $this->db->get_where('settings', array('type' => 'smtp_host'))->row()->description; ?><!--"/>-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="form-group">-->
<!--                            <label class="control-label col-md-3 col-sm-3">-->
<!--                                SMTP Port-->
<!--                            </label>-->
<!---->
<!--                            <div class="col-md-9 col-sm-9">-->
<!--                                <input class="form-control" type="text" name="smtp_port" placeholder="SMTP Port"-->
<!--                                       value="--><?php //echo $this->db->get_where('settings', array('type' => 'smtp_port'))->row()->description; ?><!--"/>-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="form-group">-->
<!--                            <label class="control-label col-md-3 col-sm-3">-->
<!--                                SMTP User-->
<!--                            </label>-->
<!---->
<!--                            <div class="col-md-9 col-sm-9">-->
<!--                                <input class="form-control" type="text" name="smtp_user" placeholder="SMTP User"-->
<!--                                       value="--><?php //echo $this->db->get_where('settings', array('type' => 'smtp_user'))->row()->description; ?><!--"/>-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="form-group">-->
<!--                            <label class="control-label col-md-3 col-sm-3">-->
<!--                                SMTP Password-->
<!--                            </label>-->
<!---->
<!--                            <div class="col-md-9 col-sm-9">-->
<!--                                <input class="form-control" type="password" name="smtp_pass" placeholder="SMTP Password"-->
<!--                                       value="--><?php //echo $this->db->get_where('settings', array('type' => 'smtp_pass'))->row()->description; ?><!--"/>-->
<!--                            </div>-->
<!--                        </div>-->

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3"></label>

                            <div class="col-md-9 col-sm-9">
                                <button type="submit" class="btn btn-facebook">Update</button>
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


<script type="text/javascript">
    $(".selectpicker").selectpicker();
</script>