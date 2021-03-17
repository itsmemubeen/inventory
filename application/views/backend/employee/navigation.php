<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $this->crud_model->get_image_url($logged_in_user_type, $logged_in_user_id); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('name'); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">

            <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?>">
                <a href="<?php echo base_url(); ?>index.php?employee/dashboard">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>

            </li>
            <li class="<?php if ($page_name == 'product') echo 'active'; ?>">
                <a href="<?php echo base_url(); ?>index.php?employee/getProducts">
                    <i class="fa fa-briefcase"></i> <span>Products</span>
                </a>

            </li>
            <li class="<?php if ($page_name == 'supplier') echo 'active'; ?>">
                <a href="<?php echo base_url(); ?>index.php?employee/supplier">
                    <i class="fa fa-dashboard"></i> <span>Supplier</span>
                </a>

            </li>

            <li class="treeview <?php if ($page_name == 'purchase_add' ||
                $page_name == 'purchase_history' ||
                $page_name == 'purchase_invoice_view'
            )
                echo 'active'; ?>">

                <a href="#">
                    <i class="fa fa-edit"></i> <span>Manage Purchase</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($page_name == 'purchase_add') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?employee/purchase_add"><i
                                class="fa fa-circle-o"></i>
                            New Purchase</a></li>
                    <li class="<?php if ($page_name == 'purchase_history') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?employee/purchase_history"><i
                                class="fa fa-circle-o"></i> Purchase History</a></li>

                </ul>
            </li>

            <li class="<?php if ($page_name == 'customer') echo 'active'; ?>">
                <a href="<?php echo base_url(); ?>index.php?employee/customer">
                    <i class="fa fa-dashboard"></i> <span>Customers</span>
                </a>

            </li>

            <li class="treeview <?php if ($page_name == 'sale_add' ||
                $page_name == 'sale_invoice' ||
                $page_name == 'sale_invoice_view' ||
                $page_name == 'take_sale_payment'
            )
                echo 'active'; ?>">

                <a href="#">
                    <i class="fa fa-edit"></i> <span>Manage Sales</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($page_name == 'sale_add') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?employee/sale_add"><i
                                class="fa fa-circle-o"></i>
                            Make A Sale</a></li>
                    <li class="<?php if ($page_name == 'sale_invoice') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?employee/sale_invoice"><i
                                class="fa fa-circle-o"></i> Sale Invoices</a></li>

                </ul>
            </li>
            <li class="<?php if ($page_name == 'message' ||
                $page_name == 'message_new' ||
                $page_name == 'message_read'
            )
                echo 'active'; ?>">
                <a href="<?php echo base_url(); ?>index.php?employee/message">
                    <i class="fa fa-paper-plane"></i>
                    <span>Messages</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
