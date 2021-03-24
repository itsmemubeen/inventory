<?php
$customers = $this->db->get_where('customer',array('softDelete' => 0))->result_array();
$suppliers = $this->db->get_where('supplier', array('softDelete' => 0))->result_array();
$products = $this->db->get_where('product', array('softDelete' => 0))->result_array();
$employees = $this->db->get('employee')->result_array();
$orders = $this->db->get('order')->result_array();
$sales = $this->db->get('invoice')->result_array();
$purchase = $this->db->get('purchase')->result_array();
?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $this->crud_model->get_image_url($logged_in_user_type, $logged_in_user_id); ?>"
                     class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('name'); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <?php echo form_open(base_url() . 'index.php?admin/searchAnything', array('class' => 'sidebar-form')); ?>

        <div class="input-group">
            <input type="text" name="search_key" class="form-control" placeholder="Search anything...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
        <?php echo form_close(); ?>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?>">
                <a href="<?php echo base_url(); ?>index.php?admin/dashboard">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>

            </li>
            <li class="treeview <?php if (($page_name == 'add_pop') || ($page_name == 'edit_pop') || ($page_name == 'd_pop')) echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>POP</span>
                    <i class="fa fa-angle-left pull-right"></i><span
                        class="label bg-purple"><!-- <?php if (!empty($customers)) echo count($customers); ?> --></span>


                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($page_name == 'add_pop') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/add_pop"><i class="fa fa-users"></i>
                            Add POP</a></li>
                    <li class="<?php if ($page_name == 'edit_pop') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/ed_pop"><i class="fa fa-edit"></i>
                            Edit POP</a></li>
                    <!-- <li class="<?php if ($page_name == 'd_pop') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/del_pop"><i class="fa fa-remove"></i>
                            Delete POP</a></li> -->        

                </ul>
            </li>
            <li class="treeview <?php if (($page_name == 'customer') || ($page_name == 'deleted_customers')) echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Clients</span>
                    <i class="fa fa-angle-left pull-right"></i><span
                        class="label bg-purple"><?php if (!empty($customers)) echo count($customers); ?></span>


                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($page_name == 'customer') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/getClients"><i class="fa fa-users"></i>
                            Clients List</a></li>
                    <li class="<?php if ($page_name == 'deleted_customers') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/dcustomer"><i class="fa fa-eye-slash"></i>Deleted
                            Clients</a></li>

                </ul>
            </li>
            <li class="treeview <?php if (($page_name == 'vendors') || ($page_name == 'deleted_vendors')) echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Vendors</span>
                    <i class="fa fa-angle-left pull-right"></i><span
                        class="label bg-purple"></span>


                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($page_name == 'vendors') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/getVendors"><i class="fa fa-users"></i>
                            Vendors List</a></li>
                    <li class="<?php if ($page_name == 'deleted_vendors') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/dvendors"><i class="fa fa-eye-slash"></i>Deleted
                            Clients</a></li>

                </ul>
            </li>
         <!--    <li class="treeview <?php if (($page_name == 'supplier') || ($page_name == 'deleted_suppliers')) echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-truck"></i>
                    <span>Suppliers</span>
                    <i class="fa fa-angle-left pull-right"></i><span
                        class="label bg-yellow"><?php if (!empty($suppliers)) echo count($suppliers); ?></span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($page_name == 'supplier') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/getSuppliers">
                            <i class="fa fa-truck"></i>
                            <span>Suppliers List</span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'deleted_suppliers') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/dsupplier"><i class="fa fa fa-eye-slash"></i>
                            Deleted Suppliers</a></li>
                </ul>
            </li> -->
            <li class="treeview <?php if ($page_name == 'product' || $page_name == 'product_out_stock' ||
                $page_name == 'product_low_stock' || $page_name == 'damaged_product' ||
                $page_name == 'deleted_products' || $page_name == 'product_category' || $page_name == 'product_sub_category'
            ) echo 'active'; ?> ">
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Products</span>
                    <i class="fa fa-angle-left pull-right"></i><span
                        class="label bg-green"><?php if (!empty($products)) echo count($products); ?></span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($page_name == 'product') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/getAllProducts"><i class="fa fa-list"></i>
                            Product Lists</a></li>
                    <li class="<?php if ($page_name == 'product_category') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/add_product_category"><i
                                class="fa fa-circle-o"></i> Make A Category</a></li>
                    <li class="<?php if ($page_name == 'product_sub_category') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/add_product_sub_category"><i
                                class="fa fa-circle-o"></i> Make A Sub Category</a></li>
                    <li class="<?php if ($page_name == 'deleted_products') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/dproduct"><i class="fa fa-remove"></i>
                            Deleted Products</a></li>
                    <li class="<?php if ($page_name == 'damaged_product') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/all_damaged_product"><i
                                class="fa fa-circle-o"></i> Damaged Products</a></li>
                    <li class="<?php if ($page_name == 'product_out_stock') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/product_oos"><i class="fa fa-circle-o"></i>
                            Out Of Stock</a></li>
                    <li class="<?php if ($page_name == 'product_low_stock') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/product_ls"><i class="fa fa fa-warning"></i>Low
                            In Stock</a></li>
                </ul>
            </li>

            <li class="treeview <?php if ($page_name == 'employee') echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Employyee</span>
                    <i class="fa fa-angle-left pull-right"></i><span
                        class="label bg-teal"><?php if (!empty($employees)) echo count($employees); ?></span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($page_name == 'employee') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/employee"><i
                                class="fa fa-circle-o"></i>Add Employee</a></li>
                </ul>
            </li>


            <li class="treeview <?php if ($page_name == 'order_add' || $page_name == 'orders') echo 'active'; ?>">

                <a href="#">
                    <i class="fa fa-edit"></i> <span>Orders</span>
                    <i class="fa fa-angle-left pull-right"></i><span
                        class="label bg-blue"><?php if (!empty($orders)) echo count($orders); ?></span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($page_name == 'order_add') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/add_a_new_order"><i
                                class="fa fa-circle-o"></i>
                            Place New Order</a></li>
                    <li class="<?php if ($page_name == 'orders') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/view_all_orders"><i
                                class="fa fa-circle-o"></i> List
                            All Order</a></li>

                </ul>
            </li>
            
            <li class="<?php if ($page_name == 'enterinstallationinfo') echo 'active'; ?>">

                <a href="<?php echo base_url(); ?>index.php?admin/add_a_new_installation">
                    <i class="fa fa-edit"></i> <span>Enter Installation Info</span>
                    <i class="fa fa-angle-left pull-right"></i><span
                        class="label bg-blue"></span>
                </a>
            </li>
            <li class="<?php if ($page_name == 'enterinstallationinfo') echo 'active'; ?>">

                <a href="<?php echo base_url(); ?>index.php?admin/add_back_inventory">
                    <i class="fa fa-edit"></i> <span>Inventory Back Form</span>
                    <i class="fa fa-angle-left pull-right"></i><span
                        class="label bg-blue"></span>
                </a>
            </li>

            <li class="<?php if ($page_name == 'purchase_add') echo 'active'; ?>">
                <a href="<?php echo base_url(); ?>index.php?admin/add_new_purchase">
                    <i class="fa fa-table"></i> <span>Inventory Receive Form</span>
                    <i class="fa fa-angle-left pull-right"></i><span
                        class="label bg-blue"><?php if (!empty($purchase)) echo count($purchase); ?></span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($page_name == 'purchase_add') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/add_new_purchase"><i
                                class="fa fa-circle-o"></i>
                            Make New Purchase</a></li>
                    <li class="<?php if ($page_name == 'purchase_history') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/view_all_purchase_history"><i
                                class="fa fa-circle-o"></i> Purchase History</a></li>
                                <li class="<?php if ($page_name == 'purchase_history') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/view_all_purchase_history"><i
                                class="fa fa-circle-o"></i> Return From Employee</a></li>
                </ul>
            </li>
            <li class="treeview <?php if ($page_name == 'sale_add' || $page_name == 'sale_invoice') echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-dollar"></i> <span>Sales</span>
                    <i class="fa fa-angle-left pull-right"></i><span
                        class="label bg-red"><?php if (!empty($sales)) echo count($sales); ?></span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($page_name == 'sale_add') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/add_a_new_sale"><i
                                class="fa fa-circle-o"></i>Make
                            A
                            Sale</a></li>
                    <li class="<?php if ($page_name == 'sale_invoice') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>index.php?admin/view_all_sale_invoices"><i
                                class="fa fa-circle-o"></i>Sales
                            Invoice History</a></li>
                </ul>
            </li>

            <li class="treeview <?php if ($page_name == 'report_product' || $page_name == 'report_profit' || $page_name == 'report_profit_sale' || $page_name == 'report_purchase' || $page_name == 'report_customer') echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-bar-chart-o"></i> <span>Reports</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($page_name == 'report_product') echo 'active'; ?>">
                        <a
                            href="<?php echo base_url(); ?>/index.php?admin/report/product"><i
                                class="fa fa-circle-o"></i> Stock Report</a></li>
                    <li class="<?php if ($page_name == 'report_purchase') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>/index.php?admin/report/purchase"><i
                                class="fa fa-circle-o"></i> Supplier Purchase
                            Report</a></li>
                    <li class="<?php if ($page_name == 'report_customer') echo 'active'; ?>">
                        <a href="<?php echo base_url(); ?>index.php?admin/report/customer"><i
                                class="fa fa-circle-o"></i> Customer Payment Report</a>
                    </li>
                    <li class="<?php if ($page_name == 'report_profit') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>/index.php?admin/report/profit"><i
                                class="fa fa-circle-o"></i>
                            Profit Report - Order</a></li>
                    <li class="<?php if ($page_name == 'report_profit_sale') echo 'active'; ?>"><a
                            href="<?php echo base_url(); ?>/index.php?admin/report/profit_sale"><i
                                class="fa fa-circle-o"></i>
                            Profit Report - Sale</a></li>
                </ul>
            <li class="treeview <?php if ($page_name == 'message_new') echo 'active'; ?>"><a
                    href="<?php echo base_url(); ?>index.php?admin/write_a_new_message"><i
                        class="fa fa-paper-plane"></i><span>Messages</span></a></li>

            <!--            <li class="treeview -->
            <?php //if ($page_name == 'shop_summary') echo 'active'; ?><!--"><a-->
            <!--                    href="--><?php //echo base_url(); ?><!--index.php?admin/shopSummary"><i-->
            <!--                        class="fa fa-sitemap"></i><span>Daily Summary</span></a></li>-->
            <!--            </li>-->

            <li class="treeview <?php if ($page_name == 'settings') echo 'active'; ?>"><a
                    href="<?php echo base_url(); ?>index.php?admin/settings"><i
                        class="fa fa-cogs"></i><span>Application
                    Settings</span></a></li>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>