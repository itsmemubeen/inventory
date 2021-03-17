<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Search Results
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?admin/dashboard"><i class="fa fa-dashboard"></i>
                    Dashboard</a>
            </li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-2"></div>

            <?php echo form_open(base_url() . 'index.php?admin/searchAnything', array('class' => 'search-form', "accept-charset" => "utf-8")); ?>
            <div class="col-md-7">
                <input type="text" id="search_input1" class="form-control input-lg"
                       placeholder="Type Anything To Search ..." name="search_key">
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-info btn-lg">
                    <i class="entypo-search"></i>Search
                </button>
            </div>
            <?php echo form_close(); ?>
            <div class="col-md-2"></div>
        </div>
        <hr>

        <div class="row">


            <div class="col-sm-6">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="entypo-user"></i>
                            Products
                        </div>
                        <div class="panel-options">

                        </div>
                    </div>

                    <div class="panel-body with-table">
                        <?php
                        $this->db->like('name', $search_key);
                        $this->db->or_like('note', $search_key);
                        $this->db->or_like('serial_number', $search_key);
                        $this->db->or_like('purchase_price', $search_key);
                        $this->db->or_like('selling_price', $search_key);
                        $this->db->or_like('stock_quantity', $search_key);
                        $product_query = $this->db->get('product');
                        ?>

                        <?php if ($product_query->num_rows() > 0): ?>
                            <a href="<?php echo base_url(); ?>index.php?admin/getAllProducts"><i class="fa fa-list"></i> View
                                All
                                Products</a>
                        <?php endif; ?>
                        <hr>
                        <table id="data-table" class="table  table-bordered table-hover table-striped">

                            <tbody>
                            <?php
                            if ($product_query->num_rows() > 0):
                                $products = $product_query->result_array();
                                foreach ($products as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-xs"
                                               onclick="showMessageModal('<?php echo base_url(); ?>index.php?modal/popup/product_detail/<?php echo $row['product_id']; ?>');">
                                                <i class="entypo-user"></i> Show
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                            endif;
                            ?>

                            <?php if ($product_query->num_rows() < 1): ?>
                                <td class="text-center">
                                    <strong>Not Found</strong>
                                </td>
                            <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="entypo-user"></i>
                            Customers
                        </div>
                        <div class="panel-options">

                        </div>
                    </div>

                    <div class="panel-body with-table">
                        <?php
                        $this->db->like('name', $search_key);
                        $this->db->like('customer_code', $search_key);
                        $this->db->or_like('email', $search_key);
                        $this->db->or_like('phone', $search_key);
                        $this->db->or_like('address', $search_key);
                        $customer_query = $this->db->get('customer');
                        ?>
                        <?php if ($customer_query->num_rows() > 0): ?>
                            <a href="<?php echo base_url(); ?>index.php?admin/getCustomers"><i class="fa fa-list"></i> View
                                All
                                Customers</a>
                        <?php endif; ?>
                        <hr>
                        <table class="table  table-bordered table-hover table-striped">

                            <tbody>

                            <?php
                            if ($customer_query->num_rows() > 0):
                                $customers = $customer_query->result_array();
                                foreach ($customers as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-xs"
                                               onclick="showMessageModal('<?php echo base_url(); ?>index.php?modal/popup/customer_profile/<?php echo $row['customer_id']; ?>');">
                                                <i class="entypo-user"></i> Show
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                            endif;
                            ?>

                            <?php if ($customer_query->num_rows() < 1): ?>
                                <td class="text-center">
                                    <strong>Not Found</strong>
                                </td>
                            <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">


            <div class="col-sm-6">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="entypo-user"></i>
                            Orders
                        </div>
                        <div class="panel-options">

                        </div>
                    </div>

                    <div class="panel-body with-table">
                        <?php
                        $this->db->like('note', $search_key);
                        $this->db->like('order_number', $search_key);
                        $this->db->or_like('shipping_address', $search_key);
                        $order_query = $this->db->get('order');
                        ?>
                        <?php if ($order_query->num_rows() > 0): ?>
                            <a href="<?php echo base_url(); ?>index.php?admin/view_all_orders"><i class="fa fa-list"></i> View
                                All
                                Orders</a>
                        <?php endif; ?>
                        <hr>
                        <table class="table  table-bordered table-hover table-striped">

                            <tbody>

                            <?php
                            if ($order_query->num_rows() > 0):
                                $orders = $order_query->result_array();
                                foreach ($orders as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $row['order_number']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>index.php?admin/order_invoice_view/<?php echo $row['order_id']; ?>"
                                               class="btn btn-primary btn-xs">
                                                <i class="entypo-user"></i> Show
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                            endif;
                            ?>

                            <?php if ($order_query->num_rows() < 1): ?>
                                <td class="text-center">
                                    <strong>Not Found</strong>
                                </td>
                            <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="entypo-user"></i>
                            Suppliers
                        </div>
                        <div class="panel-options">

                        </div>
                    </div>

                    <div class="panel-body with-table">
                        <?php
                        $this->db->like('name', $search_key);
                        $this->db->or_like('company', $search_key);
                        $this->db->or_like('email', $search_key);
                        $this->db->or_like('phone', $search_key);
                        $supplier_query = $this->db->get('supplier');
                        ?>
                        <?php if ($supplier_query->num_rows() > 0): ?>
                            <a href="<?php echo base_url(); ?>index.php?admin/getSuppliers"><i class="fa fa-list"></i> View
                                All
                                Suppliers</a>
                        <?php endif; ?>
                        <hr>
                        <table class="table  table-bordered table-hover table-striped">

                            <tbody>

                            <?php
                            if ($supplier_query->num_rows() > 0):
                                $suppliers = $supplier_query->result_array();
                                foreach ($suppliers as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-xs"
                                               onclick="showMessageModal('<?php echo base_url(); ?>index.php?modal/popup/supplier_profile/<?php echo $row['supplier_id']; ?>');">
                                                <i class="entypo-user"></i> Show
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                            endif;
                            ?>

                            <?php if ($supplier_query->num_rows() < 1): ?>
                                <td class="text-center">
                                    <strong>Not Found</strong>
                                </td>
                            <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->