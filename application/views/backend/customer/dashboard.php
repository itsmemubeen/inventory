<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $page_title; ?>
        </h1>
        <ol class="breadcrumb">
            <li class="active"><a href="<?php echo base_url(); ?>index.php?customer/dashboard"><i
                        class="fa fa-dashboard"></i> Dashboard</a></li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>1</h3>

                        <p></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bell"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php?customer/order_add" class="small-box-footer">
                        <strong>Create New Order</strong>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h3>2</h3>

                        <p></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bullseye"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php?customer/order_history" class="small-box-footer">
                        <strong>View Order History</strong>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>3</h3>

                        <p></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php?customer/purchase_history" class="small-box-footer">
                        <strong>Purchase History</strong>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>4</h3>

                        <p></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php?customer/profile_settings" class="small-box-footer">
                        <strong>Profile Settings</strong>
                    </a>
                </div>
            </div>
        </div>


    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->