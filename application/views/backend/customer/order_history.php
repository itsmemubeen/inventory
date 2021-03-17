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
                <a href="<?php echo base_url(); ?>index.php?customer/order_add">
                    Place An Order
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php?customer/order_history">
                    Order History
                </a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-title"></div>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <ul class="nav nav-pills">
                            <li class="active">
                                <a href="#nav-pills-tab-1" data-toggle="tab">
                                    <i class=" fa fa-spinner"></i> Pending
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
                        </ul>
                        <hr>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="nav-pills-tab-1">
                                <div class="table-responsive">

                                    <table id="data-table" class="table table-striped table-bordered nowrap display"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Order Code</th>
                                            <th>Date Created</th>
                                            <th>Last Modified</th>
                                            <th>Operations</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count = 1;
                                        $pending_orders = $this->db->get_where('order', array(
                                            'order_status' => 0, 'customer_id' => $this->session->userdata('user_id')
                                        ))->result_array();
                                        foreach ($pending_orders as $row):
                                            ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $row['order_number']; ?></td>
                                                <td><?php echo date('dS M, Y', $row['creating_timestamp']); ?></td>
                                                <td><?php if ($row['modifying_timestamp'] != '') echo date('dS M, Y', $row['modifying_timestamp']); ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>index.php?customer/order_invoice_view/<?php echo $row['order_number']; ?>"
                                                       class="btn btn-success btn-xs">
                                                        View Invoice
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-pills-tab-2">
                                <div class="table-responsive">

                                    <table id="data-table" class="table table-striped table-bordered nowrap display"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Order Code</th>
                                            <th>Date Created</th>
                                            <th>Last Modified</th>
                                            <th>Operations</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count = 1;
                                        $approved_orders = $this->db->get_where('order', array(
                                            'order_status' => 1, 'customer_id' => $this->session->userdata('user_id')
                                        ))->result_array();
                                        foreach ($approved_orders as $row):
                                            ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $row['order_number']; ?></td>
                                                <td><?php echo date('dS M, Y', $row['creating_timestamp']); ?></td>
                                                <td><?php if ($row['modifying_timestamp'] != '') echo date('dS M, Y', $row['modifying_timestamp']); ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>index.php?customer/order_invoice_view/<?php echo $row['order_number']; ?>"
                                                       class="btn btn-success btn-xs">
                                                        View Invoice
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-pills-tab-3">
                                <div class="table-responsive">

                                    <table id="data-table" class="table table-striped table-bordered nowrap display"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Order Code</th>
                                            <th>Date Created</th>
                                            <th>Last Modified</th>
                                            <th>Operations</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count = 1;
                                        $rejected_orders = $this->db->get_where('order', array(
                                            'order_status' => 2, 'customer_id' => $this->session->userdata('user_id')
                                        ))->result_array();
                                        foreach ($rejected_orders as $row):
                                            ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $row['order_number']; ?></td>
                                                <td><?php echo date('dS M, Y', $row['creating_timestamp']); ?></td>
                                                <td><?php if ($row['modifying_timestamp'] != '') echo date('dS M, Y', $row['modifying_timestamp']); ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>index.php?customer/order_invoice_view/<?php echo $row['order_number']; ?>"
                                                       class="btn btn-success btn-xs">
                                                        View Invoice
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


    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->