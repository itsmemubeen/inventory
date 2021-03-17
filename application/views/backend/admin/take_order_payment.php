<?php
$payment_for_order = $this->db->get_where('order', array(
    'order_id' => $order_id
))->result_array(); ?>


<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
        <?php foreach ($payment_for_order as $row):
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
                        <a href="<?php echo base_url(); ?>index.php?admin/order_add">
                            Create New Order
                        </a>
                    </li>
                </ol>
                <!-- end breadcrumb -->

                <!-- begin page-header -->
                <h1 class="page-header"><?php echo $page_title; ?></h1>
                <!-- end page-header -->

                <div class="row">
                    <div class="col-md-12">
                        <!-- begin panel -->
                        <div class="panel panel-default">
                            <div class="panel-heading">

                                <h4 class="panel-title"><?php echo 'Order Number' . ': ' . $row['order_number']; ?></h4>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>product Code</td>
                                            <td>Name</td>
                                            <td>Quantity</td>
                                            <td>Unit Price</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count = 1;
                                        $products = json_decode($row['order_entries']);
                                        foreach ($products as $product):
                                            ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td>
                                                    <?php
                                                    echo $this->db->get_where('product', array(
                                                        'product_id' => $product->product_id
                                                    ))->row()->serial_number;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $this->db->get_where('product', array(
                                                        'product_id' => $product->product_id
                                                    ))->row()->name;
                                                    ?>
                                                </td>
                                                <td><?php echo $product->quantity; ?></td>
                                                <td><?php echo $currency . ' ' . $product->selling_price; ?></td>
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

                <div class="row">
                    <div class="col-md-6">
                        <!-- begin panel -->
                        <div class="panel panel-default">
                            <div class="panel-heading">

                                <h4 class="panel-title">Take Payment</h4>
                            </div>
                            <div class="panel-body">
                                <?php
                                echo form_open(base_url() . 'index.php?admin/order_payment/take_payment/' . $row['order_id'], array(
                                    'class' => 'form-horizontal', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
                                ));
                                ?>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3">
                                        Payment
                                    </label>

                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" class="form-control" name="amount"
                                               data-parsley-required="true"
                                               placeholder="Enter Payment Amount"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3">
                                        Method
                                    </label>

                                    <div class="col-md-6 col-sm-6">
                                        <select class="form-control selectpicker" data-size="10" data-live-search="true"
                                                data-style="btn-default" data-parsley-required="true" name="method">
                                            <option value="" selected>Select Payment Method</option>
                                            <option value="1">Cash</option>
                                            <option value="2">Check</option>
                                            <option value="3">Card</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3">
                                        Date
                                    </label>

                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" class="form-control" id="datepicker-autoClose"
                                               name="modifying_timestamp" data-parsley-required="true"
                                               placeholder="Select Date"/>
                                    </div>
                                </div>

                                <input type="hidden" name="customer_id" value="<?php echo $row['customer_id']; ?>">
                                <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3"></label>

                                    <div class="col-md-6 col-sm-6">
                                        <button type="submit" class="btn btn-success">Take Payment</button>
                                    </div>
                                </div>

                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        <!-- end panel -->
                    </div>
                    <div class="col-md-6">
                        <!-- begin panel -->
                        <div class="panel panel-default">
                            <div class="panel-heading">

                                <h4 class="panel-title">Amount</h4>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                        <tr>
                                            <td>VAT</td>
                                            <td><?php echo $row['vat_percentage']; ?> %</td>
                                        </tr>
                                        <tr>
                                            <td>Discount</td>
                                            <td><?php echo $row['discount_percentage']; ?> %</td>
                                        </tr>
                                        <tr>
                                            <td>Grand Total</td>
                                            <td><?php echo $currency . ' ' . $row['grand_total']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Due</td>
                                            <td><?php echo $currency . ' ' . round($row['due'], 2); ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end panel -->
                    </div>
                </div>

            </div>

        <?php endforeach; ?>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->
