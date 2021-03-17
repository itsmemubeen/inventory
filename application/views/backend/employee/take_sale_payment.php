<?php
$payment_for_invoice = $this->db->get_where('invoice', array(
    'invoice_code' => $invoice_code
))->result_array();
foreach ($payment_for_invoice as $row):
    ?>

    <!-- begin #content -->


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php echo $page_title; ?>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url(); ?>index.php?employee/dashboard">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>index.php?employee/sale_add">
                        New Sale
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>index.php?employee/sale_invoice">
                        Sales Invoice
                    </a>
                </li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div id="content" class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- begin panel -->
                        <div class="panel panel-inverse">
                            <div class="panel-heading">

                                <h4 class="panel-title"><?php echo 'Invoice Code' . ': ' . $row['invoice_code']; ?></h4>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Product Code</td>
                                            <td>Name</td>
                                            <td>Quantity</td>
                                            <td>Unit Price</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count = 1;
                                        $products = json_decode($row['invoice_entries']);
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
                                                <td><?php echo $product->total_number; ?></td>
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
                                echo form_open(base_url() . 'index.php?employee/sale_payment/take_payment/' . $row['invoice_id'], array(
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
                                            <option value="" selected>Choose A Payment Method</option>
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
                                               name="timestamp" data-parsley-required="true"
                                               placeholder="Select Date" required/>
                                    </div>
                                </div>

                                <input type="hidden" name="customer_id" value="<?php echo $row['customer_id']; ?>">
                                <input type="hidden" name="invoice_id" value="<?php echo $row['invoice_id']; ?>">

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
                                            <td>Total</td>
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
        </section>
        <!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php endforeach; ?>