<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $this->crud_model->get_image_url($logged_in_user_type , $logged_in_user_id);?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">

            <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?>">
                <a href="<?php echo base_url(); ?>index.php?customer/dashboard">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>

            </li>

            <li class="treeview <?php if ($page_name == 'order_add' || $page_name == 'order_history') echo 'active'; ?>">

                <a href="#">
                    <i class="fa fa-edit"></i> <span>Orders</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($page_name == 'order_add') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?customer/order_add"><i
                                class="fa fa-circle-o"></i>
                            Place New Order</a></li>
                    <li class="<?php if ($page_name == 'order_history') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?customer/order_history"><i
                                class="fa fa-circle-o"></i> Order History</a></li>

                </ul>
            </li>


            <li class="<?php if ($page_name == 'purchase_history' || $page_name == 'purchase_invoice_view') echo 'active'; ?>">
                <a href="<?php echo base_url(); ?>index.php?customer/purchase_history">
                    <i class="fa fa-dollar"></i> <span>Purchase History</span>
                </a>

            </li>

            <li class="<?php if ($page_name == 'message' ||
                $page_name == 'message_new' ||
                $page_name == 'message_read'
            )
                echo 'active'; ?>">
                <a href="<?php echo base_url(); ?>index.php?customer/message">
                    <i class="fa fa-paper-plane"></i>
                    <span><?php echo('messaging'); ?></span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
