<style type="text/css">
    body {
        font-size: 12px;
    }

    .table-bordered {
        border: 1px solid #f4f4f4;
    }

    .table-bordered {
        border: 1px solid #ddd;
    }

    .table {
        margin-bottom: 20px;
        max-width: 100%;
        width: 100%;
    }

    table {
        background-color: transparent;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
        border-bottom-width: 2px;
    }

    .table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
        border: 1px solid #ddd;
    }

    .table > thead > tr > th {
        border-bottom: 2px solid #ddd;
        vertical-align: bottom;
    }

    .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
        border-top: 1px solid #ddd;
        line-height: 1.42857;
        padding: 8px;
        vertical-align: top;
    }

    .table-condensed > tbody > tr > td, .table-condensed > tbody > tr > th, .table-condensed > tfoot > tr > td, .table-condensed > tfoot > tr > th, .table-condensed > thead > tr > td, .table-condensed > thead > tr > th {
        padding: 5px;
    }

    .table > tbody > tr.active > td, .table > tbody > tr.active > th, .table > tbody > tr > td.active, .table > tbody > tr > th.active, .table > tfoot > tr.active > td, .table > tfoot > tr.active > th, .table > tfoot > tr > td.active, .table > tfoot > tr > th.active, .table > thead > tr.active > td, .table > thead > tr.active > th, .table > thead > tr > td.active, .table > thead > tr > th.active {
        background-color: #f5f5f5;
    }

    th {
        text-align: left;
    }

    td, th {
        padding: 0;
    }

    hr {
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        border-color: #eee -moz-use-text-color -moz-use-text-color;
        border-image: none;
        border-style: solid none none;
        border-width: 1px 0 0;
        margin-bottom: 20px;
        margin-top: 20px;
    }

    hr {
        box-sizing: content-box;
        height: 0;
    }

    .text-center {
        text-align: center;
    }

    .small, small {
        font-size: 85%;
    }

    .invoice-from, .invoice-to {
        padding: 5px;
        font-size: 14px;
    }

    .red-color {
        color: #F00;
    }

    .text-lead {
        font-size: 18px;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div id="content" class="content">
            <?php
            foreach ($order_invoice_details as $row):
                ?>
                <!-- begin invoice -->
                <div class="invoice">
                    <div class="invoice-company"> <?php echo $system_name; ?> </div>
                    <hr>
                    <div class="invoice-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <table width="100%" border="0" cellspacing="2" cellpadding="2">
                                    <tr class="active">
                                        <td bgcolor="#EEE" width="50%">
                                            <div class="invoice-from"><strong>From</strong>
                                                <address class="m-t-5 m-b-5">
                                                    <strong
                                                        class="red-color text-lead"><?php echo $system_name; ?></strong><br/>
                                                    <?php echo $system_address; ?><br/>
                                                    <?php echo 'Phone'; ?>: <?php echo $system_phone; ?><br/>
                                                    <?php echo 'Email'; ?>: <?php echo $system_email; ?>
                                                </address>
                                            </div>
                                        </td>
                                        <td bgcolor="#EEE" width="50%">
                                            <div class="invoice-to"><strong>To</strong>
                                                <address class="m-t-5 m-b-5">
                                                    <strong
                                                        class="red-color text-lead"><?php echo $this->db->get_where('customer', array('customer_id' => $row['customer_id']))->row()->name; ?></strong><br/>
                                                    Phone
                                                    : <?php echo $this->db->get_where('customer', array('customer_id' => $row['customer_id']))->row()->phone; ?>
                                                    <br/>
                                                    Email
                                                    : <?php echo $this->db->get_where('customer', array('customer_id' => $row['customer_id']))->row()->email; ?>
                                                    <br/>
                                                    Shipping Address: <?php echo $row['shipping_address']; ?>
                                                </address>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!--col-sm-12-->

                        </div>
                        <hr>
                        <div class="invoice-date">
                            <div class="date m-t-5"><?php echo date('dS M, Y', $row['creating_timestamp']); ?></div>
                            <div class="invoice-detail"><strong><?php echo 'Order Code'; ?>
                                    :</strong> <?php echo $row['order_number']; ?><br/>
                                <strong> <?php echo 'Order Status'; ?>: </strong>
                                <?php if ($row['order_status'] == 0) {
                                    echo "Partially Paid";
                                } else if ($row['order_status'] == 1) {
                                    echo 'Approved';
                                } else if ($row['order_status'] == 2) {
                                    echo 'Rejected';
                                } else {
                                    echo "Product Sent Full Payment Due";
                                }

                                ?>
                                <br/>
                                <strong> <?php echo 'Payment Status'; ?>: </strong>
                                <?php if ($row['payment_status'] == 0) {
                                    echo 'Unpaid';
                                } else if ($row['payment_status'] == 1) {
                                    echo 'Paid';
                                }
                                ?>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="invoice-content">
                        <div class="table-responsive">
                            <table class="table table-invoice table-bordered table-condensed">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Serial No</th>
                                    <th>Products</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
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
                                        <td><?php echo $this->db->get_where('product', array('product_id' => $product->product_id))->row()->serial_number; ?></td>
                                        <td><?php echo $this->db->get_where('product', array('product_id' => $product->product_id))->row()->name; ?></td>
                                        <td><?php echo $currency . ' ' . $product->selling_price; ?></td>
                                        <td><?php echo $product->quantity; ?></td>
                                        <td><?php echo $currency . ' ' . $product->selling_price * $product->quantity; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Grand Total</strong></td>
                                    <td class="text-right"><?php echo $currency . ' ' . $row['grand_total']; ?></td>
                                </tr>
                                <?php if ($row['due'] != 0): ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><strong>Due</strong></td>
                                        <td class="text-right"><?php echo $currency . ' ' . round($row['due'], 2); ?></td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-invoice table-bordered table-condensed">
                                <thead>
                                <tr>
                                    <th>Payments</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                $number_of_payments = $this->db->get_where('payment', array(
                                    'order_id' => $row['order_id']
                                ))->result_array();
                                foreach ($number_of_payments as $row2):
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo date('dS M, Y', $row2['timestamp']); ?></td>
                                        <td><?php echo $currency . ' ' . $row2['amount']; ?></td>
                                        <td><?php
                                            if ($row2['method'] == 2) {
                                                echo 'Cash';
                                            } else if ($row2['method'] == 3) {
                                                echo 'Check';
                                            } else {
                                                echo 'Card';
                                            }
                                            ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="invoice-price">
                            <div class="invoice-price-left">
                                <div class="invoice-price-row">
                                    <div class="sub-price">
                                        <small><?php echo 'Sub Total'; ?></small> <?php echo $currency . ' ' . $row['sub_total']; ?>
                                        + <?php echo $row['vat_percentage']; ?> % VAT
                                        - <?php echo $row['discount_percentage']; ?> %
                                        discount
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-price-right">
                                <small>Total Paid</small>
                                <?php
                                $payments = $this->db->get_where('payment', array(
                                    'order_id' => $row['order_id']
                                ))->result_array();
                                $total_payment = 0;
                                foreach ($payments as $payment) {
                                    $total_payment += $payment['amount'];
                                }
                                echo $currency . ' ' . $total_payment;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-footer text-muted">
                        <p class="text-center m-b-5"> Thank you for your business with us ! </p>
                        <p class="text-center"><span class="m-r-10"><i
                                    class="fa fa-globe"></i> <?php echo $system_name; ?></span> <span class="m-r-10"><i
                                    class="fa fa-phone"></i> <?php echo $system_phone; ?></span> <span class="m-r-10"><i
                                    class="fa fa-envelope"></i> <?php echo $system_email; ?></span></p>
                    </div>
                </div>
                <!-- end invoice -->
            <?php endforeach; ?>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->