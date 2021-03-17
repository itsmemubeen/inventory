<?php
$get_employee_type = $this->db->get_where('employee', array(
    'employee_id' => $this->session->userdata('user_id')
))->row()->type;
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $page_title; ?>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>index.php?employee/dashboard">
                    Dashboard
                </a>
            </li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>1</h3>

                        <p></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bell"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php?employee/sale_add" class="small-box-footer">
                        <strong>Create A New Sale</strong>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h3>2</h3>

                        <p></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bullseye"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php?employee/sale_invoice" class="small-box-footer">
                        <strong>View Sale Invoices</strong>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>3</h3>

                        <p></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php?employee/purchase_add" class="small-box-footer">
                        <strong>Add A New Purchase</strong>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3>4</h3>

                        <p></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php?employee/purchase_history" class="small-box-footer">
                        <strong>View Purchase History</strong>
                    </a>
                </div>
            </div>


            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue-gradient">
                    <div class="inner">
                        <h3>5</h3>

                        <p></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-comment"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php?employee/message" class="small-box-footer">
                        <strong>Messages</strong>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-maroon">
                    <div class="inner">
                        <h3>6</h3>

                        <p></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php?employee/profile_settings" class="small-box-footer">
                        <strong>Update profile</strong>
                    </a>
                </div>
            </div>

        </div>


    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->