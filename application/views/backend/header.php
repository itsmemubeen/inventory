<?php
$logged_in_user_type = $this->session->userdata('login_type');
$logged_in_user_id = $this->session->userdata('user_id');
$logged_in_user_name = $this->session->userdata('name');
$theme = $this->db->get_where('settings', array('type' => 'theme'))->row()->description;

$out_of_stock_product = $this->db->query("SELECT count(*) as 'zero_products' FROM `product` WHERE stock_quantity <=0 and softDelete=0;")->result_array();
if (!empty($out_of_stock_product)) {
    $notification_count = count($out_of_stock_product);
}
?>

<body class="hold-transition <?php echo $theme; ?> sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="<?php echo base_url(); ?>index.php?admin/dashboard" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span
                class="logo-mini"><b><?php echo substr($system_name, 0, 1); ?></b><?php echo strtoupper(substr($system_name, 1, 3)); ?></span>
            <!-- logo for regular state and mobile devices -->
            <span
                class="logo-lg"><b><?php echo substr($system_name, 0, 1); ?></b><?php echo strtoupper(substr($system_name, 1, 9)); ?></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
<!--                    --><?php //if ($logged_in_user_type == 'admin'): ?>
<!--                        <!-- Notifications: style can be found in dropdown.less -->
<!--                        <li class="dropdown notifications-menu">-->
<!--                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
<!--                                --><?php //if (!empty($notification_count)): ?>
<!---->
<!--                                    <i class="fa fa-bell-o"></i>-->
<!--                                    <span class="label label-warning">--><?php //echo $notification_count; ?><!--</span>-->
<!--                                --><?php //endif; ?>
<!--                            </a>-->
<!---->
<!--                            <ul class="dropdown-menu">-->
<!--                                <li>-->
<!--                                    <!-- inner menu: contains the actual data -->
<!--                                    <ul class="menu">-->
<!--                                        --><?php //if (($out_of_stock_product[0]['zero_products'] != 0)): ?>
<!--                                            <li>-->
<!--                                                <a href="--><?php //echo base_url(); ?><!--index.php?admin/product_oos">-->
<!--                                                    <i class="fa fa-users text-aqua"></i> --><?php
//                                                    echo $out_of_stock_product[0]['zero_products']; ?>
<!--                                                    products are out of stock-->
<!--                                                </a>-->
<!--                                            </li>-->
<!--                                        --><?php //endif; ?>
<!--                                        <li>-->
<!--                                            <a href="#">-->
<!--                                                <i class="fa fa-users text-red"></i> 5 new members joined-->
<!--                                            </a>-->
<!--                                        </li>-->
<!--                                        <li>-->
<!--                                            <a href="#">-->
<!--                                                <i class="fa fa-shopping-cart text-green"></i> 25 sales made-->
<!--                                            </a>-->
<!--                                        </li>-->
<!--                                    </ul>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                    --><?php //endif; ?>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img
                                src="<?php echo $this->crud_model->get_image_url($logged_in_user_type, $logged_in_user_id); ?>"
                                class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo $this->session->userdata('name'); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img
                                    src="<?php echo $this->crud_model->get_image_url($logged_in_user_type, $logged_in_user_id); ?>"
                                    class="img-circle" alt="User Image">

                                <p>
                                    <?php echo $this->session->userdata('name'); ?>

                                </p>
                            </li>
                            <!-- Menu Body -->
                            <?php if ($logged_in_user_type == 'admin'): ?>
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="<?php echo base_url(); ?>index.php?admin/profile_settings">Profile</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="<?php echo base_url(); ?>index.php?admin/view_all_sale_invoices">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="<?php echo base_url(); ?>index.php?admin/write_a_new_message">Messages</a>
                                    </div>
                                </li>
                            <?php endif; ?>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <?php if ($logged_in_user_type == 'admin'): ?>
                                    <div class="pull-left">
                                        <a href="<?php echo base_url(); ?>index.php?admin/settings"
                                           class="btn btn-default btn-flat">Application Settings</a>
                                    </div>
                                <?php endif; ?>
                                <div class="pull-right">
                                    <a href="<?php echo base_url(); ?>index.php?login/logout"
                                       class="btn btn-default btn-flat">Sign Out</a>
                                </div>

                            </li>
                        </ul>
                    </li>

                </ul>
            </div>

        </nav>
    </header>
