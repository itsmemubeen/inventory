<!-- Content Wrapper. Contains page content -->
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
                <a href="<?php echo base_url(); ?>index.php?admin/add_a_new_order">
                    Place New Order
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php?admin/view_all_orders">
                    All Orders
                </a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills">
                    <li class="active">
                        <a href="#nav-pills-tab-1" data-toggle="tab">
                            <i class=" fa fa-spinner"></i> Partially Paid
                        </a>
                    </li>
                    <li>
                        <a href="#nav-pills-tab-2" data-toggle="tab">
                            <i class=" fa fa-thumbs-up"></i> Approved
                        </a>
                    </li>
                    <li>
                        <a href="#nav-pills-tab-3" data-toggle="tab">
                            <i class=" fa fa-thumbs-down"></i> Rejected
                        </a>
                    </li>
                    <li>
                        <a href="#nav-pills-tab-4" data-toggle="tab">
                            <i class=" fa fa-spinner"></i> Product Sent Full Payment Due
                        </a>
                    </li>
                </ul>
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-header">All Orders</div>
                        <div class="box-body">
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="nav-pills-tab-1">
                                    <div class="table-responsive">

                                        <table id="data-table" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order Code</th>
                                                <th>Customer</th>
                                                <th>Email</th>
                                                <th>Shipping Address</th>
                                                <th>Date Created</th>
                                                <th>Total Paid</th>
                                                <th>Last Modified</th>
                                                <th>Operations</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $count = 1;
                                            $pending_orders = $this->db->get_where('order', array(
                                                'order_status' => 0
                                            ))->result_array();
                                            foreach ($pending_orders as $row):
                                                ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php echo $row['order_number']; ?></td>
                                                    <td><?php echo $this->db->get_where('customer', array('customer_id' => $row['customer_id']))->row()->name; ?></td>
                                                    <td>
                                                        <?php echo $this->db->get_where('customer', array('customer_id' => $row['customer_id']))->row()->email; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['shipping_address']; ?>
                                                    </td>
                                                    <td><?php echo date('dS M, Y', $row['creating_timestamp']); ?></td>
                                                    <td><?php echo $row['grand_total'] . ' BDT'; ?></td>
                                                    <td><?php if ($row['modifying_timestamp'] != '') echo date('dS M, Y', $row['modifying_timestamp']); ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>index.php?admin/order_edit/<?php echo $row['order_id']; ?>"
                                                           class="btn btn-info btn-xs">
                                                            Change Status
                                                        </a>
                                                        <a href="<?php echo base_url(); ?>index.php?admin/order_invoice_view/<?php echo $row['order_id']; ?>"
                                                           class="btn btn-success btn-xs">
                                                            View Invoice
                                                        </a>
                                                        <?php if ($row['due'] != 0): ?>
                                                            <a href="<?php echo base_url(); ?>index.php?admin/take_order_payment/<?php echo $row['order_id']; ?>"
                                                               class="btn btn-primary btn-xs">
                                                                <i class="fa fa-money"></i> Receive Payment
                                                            </a>
                                                        <?php endif; ?>
                                                        <a href="<?php echo base_url(); ?>index.php?admin/generate_order_invoice/<?php echo $row['order_id']; ?>"
                                                           class="btn btn-dropbox btn-xs">
                                                            <i class="fa fa-download"></i> Download Order Invoice</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade in" id="nav-pills-tab-2">
                                    <div class="table-responsive">

                                        <table id="data-table" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order Code</th>
                                                <th>Customer</th>
                                                <th>Email</th>
                                                <th>Shipping Address</th>
                                                <th>Date Created</th>
                                                <th>Total Paid</th>
                                                <th>Last Modified</th>
                                                <th>Operations</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $count = 1;
                                            $pending_orders = $this->db->get_where('order', array(
                                                'order_status' => 1
                                            ))->result_array();
                                            foreach ($pending_orders as $row):
                                                ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php echo $row['order_number']; ?></td>
                                                    <td><?php echo $this->db->get_where('customer', array('customer_id' => $row['customer_id']))->row()->name; ?></td>
                                                    <td>
                                                        <?php echo $this->db->get_where('customer', array('customer_id' => $row['customer_id']))->row()->email; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['shipping_address']; ?>
                                                    </td>
                                                    <td><?php echo date('dS M, Y', $row['creating_timestamp']); ?></td>
                                                    <td><?php echo $row['grand_total'] . ' BDT'; ?></td>
                                                    <td><?php if ($row['modifying_timestamp'] != '') echo date('dS M, Y', $row['modifying_timestamp']); ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>index.php?admin/order_edit/<?php echo $row['order_id']; ?>"
                                                           class="btn btn-info btn-xs">
                                                            Change Status
                                                        </a>
                                                        <a href="<?php echo base_url(); ?>index.php?admin/order_invoice_view/<?php echo $row['order_id']; ?>"
                                                           class="btn btn-success btn-xs">
                                                            View Invoice
                                                        </a>
                                                        <?php if ($row['due'] != 0): ?>
                                                            <a href="<?php echo base_url(); ?>index.php?admin/take_order_payment/<?php echo $row['order_id']; ?>"
                                                               class="btn btn-primary btn-xs">
                                                                <i class="fa fa-money"></i> Receive Payment
                                                            </a>
                                                        <?php endif; ?>
                                                        <a href="<?php echo base_url(); ?>index.php?admin/generate_order_invoice/<?php echo $row['order_id']; ?>"
                                                           class="btn btn-dropbox btn-xs">
                                                            <i class="fa fa-download"></i> Download Order Invoice
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade in" id="nav-pills-tab-3">
                                    <div class="table-responsive">

                                        <table id="data-table" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order Code</th>
                                                <th>Customer</th>
                                                <th>Email</th>
                                                <th>Shipping Address</th>
                                                <th>Date Created</th>
                                                <th>Total Paid</th>
                                                <th>Last Modified</th>
                                                <th>Operations</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $count = 1;
                                            $pending_orders = $this->db->get_where('order', array(
                                                'order_status' => 2
                                            ))->result_array();
                                            foreach ($pending_orders as $row):
                                                ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php echo $row['order_number']; ?></td>
                                                    <td><?php echo $this->db->get_where('customer', array('customer_id' => $row['customer_id']))->row()->name; ?></td>
                                                    <td>
                                                        <?php echo $this->db->get_where('customer', array('customer_id' => $row['customer_id']))->row()->email; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['shipping_address']; ?>
                                                    </td>
                                                    <td><?php echo date('dS M, Y', $row['creating_timestamp']); ?></td>
                                                    <td><?php echo $row['grand_total'] . ' BDT'; ?></td>
                                                    <td><?php if ($row['modifying_timestamp'] != '') echo date('dS M, Y', $row['modifying_timestamp']); ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>index.php?admin/order_edit/<?php echo $row['order_id']; ?>"
                                                           class="btn btn-info btn-xs">
                                                            Change Status
                                                        </a>
                                                        <a href="<?php echo base_url(); ?>index.php?admin/order_invoice_view/<?php echo $row['order_id']; ?>"
                                                           class="btn btn-success btn-xs">
                                                            View Invoice
                                                        </a>
                                                        <?php if ($row['due'] != 0): ?>
                                                            <a href="<?php echo base_url(); ?>index.php?admin/take_order_payment/<?php echo $row['order_id']; ?>"
                                                               class="btn btn-primary btn-xs">
                                                                <i class="fa fa-money"></i> Receive Payment
                                                            </a>
                                                        <?php endif; ?>
                                                        <a href="<?php echo base_url(); ?>index.php?admin/generate_order_invoice/<?php echo $row['order_id']; ?>"
                                                           class="btn btn-dropbox btn-xs">
                                                            <i class="fa fa-download"></i>Download Order Invoice
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade in" id="nav-pills-tab-4">
                                    <div class="table-responsive">

                                        <table id="data-table" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order Code</th>
                                                <th>Customer</th>
                                                <th>Email</th>
                                                <th>Shipping Address</th>
                                                <th>Date Created</th>
                                                <th>Total Paid</th>
                                                <th>Last Modified</th>
                                                <th>Operations</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $count = 1;
                                            $pending_orders = $this->db->get_where('order', array(
                                                'order_status' => 3
                                            ))->result_array();
                                            foreach ($pending_orders as $row):
                                                ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php echo $row['order_number']; ?></td>
                                                    <td><?php echo $this->db->get_where('customer', array('customer_id' => $row['customer_id']))->row()->name; ?></td>
                                                    <td>
                                                        <?php echo $this->db->get_where('customer', array('customer_id' => $row['customer_id']))->row()->email; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['shipping_address']; ?>
                                                    </td>
                                                    <td><?php echo date('dS M, Y', $row['creating_timestamp']); ?></td>
                                                    <td><?php echo $row['grand_total'] . ' BDT'; ?></td>
                                                    <td><?php if ($row['modifying_timestamp'] != '') echo date('dS M, Y', $row['modifying_timestamp']); ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>index.php?admin/order_edit/<?php echo $row['order_id']; ?>"
                                                           class="btn btn-info btn-xs">
                                                            Change Status
                                                        </a>
                                                        <a href="<?php echo base_url(); ?>index.php?admin/order_invoice_view/<?php echo $row['order_id']; ?>"
                                                           class="btn btn-success btn-xs">
                                                            View Invoice
                                                        </a>
                                                        <?php if ($row['due'] != 0): ?>
                                                            <a href="<?php echo base_url(); ?>index.php?admin/take_order_payment/<?php echo $row['order_id']; ?>"
                                                               class="btn btn-primary btn-xs">
                                                                <i class="fa fa-money"></i> Receive Payment
                                                            </a>
                                                        <?php endif; ?>
                                                        <a href="<?php echo base_url(); ?>index.php?admin/generate_order_invoice/<?php echo $row['order_id']; ?>"
                                                           class="btn btn-dropbox btn-xs">
                                                            <i class="fa fa-download"></i> Download Order Invoice
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    jQuery(document).ready(function () {
        jQuery("#data-table").DataTable();
        jQuery("#data-table1").DataTable();
        jQuery("#data-table2").DataTable();
        jQuery("#data-table3").DataTable();
    });
</script>