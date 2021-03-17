<?php
$income = 0;
$expense = 0;

$total_purchase_price = 0;
$total_selling_price = 0;

$result = $this->db->query("
                  SELECT p.amount,p.method, p.timestamp, i.invoice_entries, c.name as 'customer_name' FROM payment p
                  INNER JOIN `invoice` i ON p.invoice_id=i.invoice_id
                  INNER JOIN customer c ON i.customer_id = c.customer_id WHERE p.`type`='income';")->result_array();


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Report Of Profit Sale
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
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <br>

        <div class="row">
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-default" data-sortable-id="ui-widget-1">
                    <div class="panel-heading">

                        <h4 class="panel-title">
                            Select Date Range
                        </h4>
                    </div>
                    <div class="panel-body">
                        <?php
                        echo form_open(base_url() . 'index.php?admin/report/' . $report_type, array(
                            'class' => 'form-horizontal form-bordered', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
                        ));
                        ?>

                        <div class="form-group">
                            <label class="col-md-3">Select Date Range</label>

                            <div class="col-md-8">
                                <div class="input-group input-daterange">
                                    <input type="text" class="form-control" name="start"
                                           value="<?php echo date('m/d/Y', $timestamp_start); ?>"/>
                                    <span class="input-group-addon">To</span>
                                    <input type="text" class="form-control" name="end"
                                           value="<?php echo date('m/d/Y', $timestamp_end); ?>"/>
                                </div>
                                <br/>
                            </div>


                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-sm-3"></label>

                            <div class="col-md-8 col-sm-8">
                                <button type="submit" class="btn btn-success">Show Report</button>
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
                <!-- begin panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h4 class="panel-title">Payments</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">

                            <table id="data-table" class="table table-bordered nowrap display" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Name</th>
                                    <th>Date</th>
                                    <th>Customer Purchase Amount</th>
                                    <th>Order Details</th>
                                    <th>Method</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                foreach ($result as $row):?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $row['customer_name']; ?></td>
                                        <td><?php echo date("d F, Y", $row['timestamp']); ?></td>

                                        <td><?php echo $currency . ' ' . $row['amount']; ?></td>
                                        <td>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Purchase Price</th>
                                                    <th>Sell Price</th>
                                                    <th>Quantity</th>
                                                    <th>Gross Purchase Price</th>
                                                    <th>Gross Sell Price</th>
                                                    <th>Profit</th>
                                                </tr>



                                            <?php $product_information = json_decode($row['invoice_entries']); ?>
                                            <?php foreach ($product_information as $product): ?>


                                                    <tr>
                                                        <td><?php echo $this->db->get_where('product', array('product_id' => $product->product_id))->row()->name; ?></td>
                                                        <td><?php echo $this->db->get_where('product', array('product_id' => $product->product_id))->row()->purchase_price; ?></td>
                                                        <td><?php echo $this->db->get_where('product', array('product_id' => $product->product_id))->row()->selling_price; ?></td>
                                                        <td><?php echo $product->total_number; ?></td>
                                                        <td><?php echo $this->db->get_where('product', array('product_id' => $product->product_id))->row()->purchase_price * $product->total_number; ?></td>
                                                        <td><?php echo $this->db->get_where('product', array('product_id' => $product->product_id))->row()->selling_price * $product->total_number; ?></td>
                                                        <td><?php echo ($row['amount'] * $product->total_number) -
                                                                ($this->db->get_where('product', array('product_id' => $product->product_id))->row()->purchase_price * $product->total_number); ?></td>
                                                    </tr>

                                            <?php endforeach; ?>
                                            </table>
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
</div><!-- /.content-wrapper -->





















