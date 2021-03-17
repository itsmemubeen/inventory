<?php
$this->db->select_sum('amount');
$this->db->group_by('customer_id');
$this->db->order_by('timestamp', 'desc');
$this->db->select('timestamp, customer_id, method, type');

$this->db->where('timestamp >=', $timestamp_start);
$this->db->where('timestamp <=', $timestamp_end);
$this->db->where('customer_id !=', 0);
$payments = $this->db->get('payment')->result_array();
?>
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
                <a href="<?php echo base_url(); ?>index.php?admin/report/payment">
                    Payments
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php?admin/report/customer">
                    Customer Payments
                </a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <!-- begin panel -->
                <div class="panel panel-default" data-sortable-id="ui-widget-1">
                    <div class="panel-heading">

                        <h4 class="panel-title">
                            Select Date range
                        </h4>
                    </div>
                    <div class="panel-body">
                        <?php
                        echo form_open(base_url() . 'index.php?admin/report/' . $report_type, array(
                            'class' => 'form-horizontal form-bordered', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
                        ));
                        ?>

                        <div class="form-group">
                            <label class="col-md-3">Date Range</label>

                            <div class="col-md-8">
                                <div class="input-group input-daterange">
                                    <input type="text" class="form-control" name="start"
                                           value="<?php echo date('m/d/Y', $timestamp_start); ?>"/>
                                    <span class="input-group-addon">To</span>
                                    <input type="text" class="form-control" name="end"
                                           value="<?php echo date('m/d/Y', $timestamp_end); ?>"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-sm-3"></label>

                            <div class="col-md-8 col-sm-8">
                                <button type="submit" class="btn btn-success">Go</button>
                            </div>
                        </div>

                        <?php echo form_close(); ?>
                    </div>
                </div>
                <!-- end panel -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="widget-chart bg-black">
                    <div class="">
                        <h4 class="chart-title">

                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Customer Payments</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">

                            <table id="data-table" class="table table-striped table-bordered nowrap display"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Customer</th>
                                    <th>Type</th>
                                    <th>Method</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                foreach ($payments as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo date("d F, Y", $row['timestamp']); ?></td>
                                        <td><?php echo $currency . ' ' . $row['amount']; ?></td>
                                        <td>
                                            <?php echo $this->db->get_where('customer', array(
                                                'customer_id' => $row['customer_id']
                                            ))->row()->name; ?>
                                        </td>
                                        <td>
                                            <?php if ($row['type'] == 'income') {
                                                echo 'Income';
                                            } else {
                                                echo 'Expense';
                                            } ?>
                                        </td>
                                        <td>
                                            <?php if ($row['method'] == 1) {
                                                echo 'Cash';
                                            } else if ($row['method'] == 2) {
                                                echo 'Check';
                                            } else {
                                                echo 'Card';
                                            } ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end panel -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>























