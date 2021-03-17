<?php
$income = 0;
$expense = 0;

$total_purchase_price = 0;
$total_selling_price = 0;

$result = $this->db->query("
                  SELECT p.amount,p.method, p.timestamp,o.order_entries,
                  o.note,o.deal_code, c.name as 'customer_name' FROM payment p
                  INNER JOIN `order` o ON p.order_id=o.order_id
                  INNER JOIN customer c ON o.customer_id = c.customer_id WHERE p.`type`='income' and TIMESTAMP BETWEEN $timestamp_start AND $timestamp_end;")->result_array();


?>

<!-- begin #content -->
<div id="content" class="content">

    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
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
                Customer Pauments
            </a>
        </li>
    </ol>
    <!-- end breadcrumb -->

    <!-- begin page-header -->
    <h1 class="page-header"><?php echo $page_title; ?></h1>
    <!-- end page-header -->
    <br>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="ui-widget-1">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                           data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                           data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
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
                        <label class="col-md-3">Date Range</label>

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
                            <button type="submit" class="btn btn-success">Go</button>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <div class="col-md-3">
            <div class="alert alert-info fade in m-b-15">
                <strong>
                    <?php echo date("d M, Y", $timestamp_start) . " - " . date("d M, Y", $timestamp_end); ?>
                </strong>
                <br/>
                <br/>
                <strong>
                    Total Purchase Price = <?php echo $total_purchase_price . ' ' . $currency; ?>
                </strong>
                <strong>
                    Total Selling Price = <?php echo $total_selling_price . ' ' . $currency; ?>
                </strong>

                <strong>
                    Total Gross Profit = <?php echo $total_selling_price - $total_purchase_price . ' ' . $currency; ?>
                </strong>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
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
                                <th>Product Name</th>
                                <th>Purchase Price</th>
                                <th>Sell Price</th>
                                <th>Quantity</th>
                                <th>Gross Purchase Price</th>
                                <th>Gross Sell Price</th>
                                <th>Profit</th>
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
                                    <?php $product_information = json_decode($row['order_entries']);
                                    foreach ($product_information as $product):?>

                                        <td><?php echo $this->db->get_where('product', array('product_id' => $product->product_id))->row()->name; ?></td>
                                        <td><?php echo $this->db->get_where('product', array('product_id' => $product->product_id))->row()->purchase_price; ?></td>
                                        <td><?php echo $this->db->get_where('product', array('product_id' => $product->product_id))->row()->selling_price; ?></td>
                                        <td><?php echo $product->quantity; ?></td>
                                        <!--                                        --><?php
//                                        $total_purchase_price =+ $this->db->get_where('product', array('product_id' => $product->product_id))->row()->purchase_price * $product->quantity;
//
//                                        var_dump($total_purchase_price);
//                                        $total_selling_price += $this->db->get_where('product', array('product_id' => $product->product_id))->row()->selling_price * $product->quantity;
//
                                        ?>
                                        <td><?php echo $this->db->get_where('product', array('product_id' => $product->product_id))->row()->purchase_price * $product->quantity; ?></td>
                                        <td><?php echo $this->db->get_where('product', array('product_id' => $product->product_id))->row()->selling_price * $product->quantity; ?></td>
                                        <td><?php echo ($row['amount'] * $product->quantity) -
                                                ($this->db->get_where('product', array('product_id' => $product->product_id))->row()->purchase_price * $product->quantity); ?></td>
                                    <?php endforeach; ?>
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

</div>
























