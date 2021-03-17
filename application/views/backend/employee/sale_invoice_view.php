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

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div id="content" class="content">

            <?php
            $sale_invoice_details = $this->db->get_where('invoice', array(
                'invoice_code' => $invoice_code
            ))->result_array();
            foreach ($sale_invoice_details as $row):
                ?>
                <!-- begin invoice -->
                <div class="invoice">
                    <div class="invoice-company">
            <span class="pull-right hidden-print">
            <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i
                    class="fa fa-print m-r-5"></i> Print</a>
            </span>
                        <?php echo $system_name; ?>
                    </div>
                    <hr>
                    <div class="invoice-header">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="invoice-from">
                                    <small>From</small>
                                    <address class="m-t-5 m-b-5">
                                        <strong><?php echo $system_name; ?></strong><br/>
                                        <?php echo $system_address; ?><br/>
                                        Phone: <?php echo $system_phone; ?><br/>
                                        Email: <?php echo $system_email; ?>
                                    </address>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="invoice-to">
                                    <small>To</small>
                                    <address class="m-t-5 m-b-5">
                                        <strong><?php echo $this->db->get_where('customer', array('customer_id' => $row['customer_id']))->row()->name; ?></strong><br/>
                                        Address: <?php echo $this->db->get_where('customer', array('customer_id' => $row['customer_id']))->row()->address; ?>
                                        <br/>
                                        Phone: <?php echo $this->db->get_where('customer', array('customer_id' => $row['customer_id']))->row()->phone; ?>
                                        <br/>
                                        Email: <?php echo $this->db->get_where('customer', array('customer_id' => $row['customer_id']))->row()->email; ?>
                                    </address>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="invoice-date">
                            <div class="date m-t-5"><?php echo date('dS M, Y', $row['timestamp']); ?></div>
                            <div class="invoice-detail">
                                <strong>Invoice Code: <?php echo $row['invoice_code']; ?></strong><br/>
                                <?php
                                $payment_method = $this->db->get_where('payment', array(
                                    'invoice_id' => $row['invoice_id']
                                ))->row()->method;
                                ?>
                                <?php if ($payment_method == 1): ?>
                                    <strong>Payment Method: Cash</strong>
                                <?php endif; ?>
                                <?php if ($payment_method == 2): ?>
                                    <strong>Payment Method: Check</strong>
                                <?php endif; ?>
                                <?php if ($payment_method == 3): ?>
                                    <strong><strong>Payment Method: Card</strong></strong>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="invoice-content">
                        <div class="table-responsive">
                            <table class="table table-invoice table-bordered">
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
                                $products = json_decode($row['invoice_entries']);
                                foreach ($products as $product):
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $this->db->get_where('product', array('product_id' => $product->product_id))->row()->serial_number; ?></td>
                                        <td><?php echo $this->db->get_where('product', array('product_id' => $product->product_id))->row()->name; ?></td>
                                        <td><?php echo $currency . ' ' . $product->selling_price; ?></td>
                                        <td><?php echo $product->total_number; ?></td>
                                        <td><?php echo $currency . ' ' . $product->selling_price * $product->total_number; ?></td>
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
                            <table class="table table-invoice table-bordered">
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
                                    'invoice_id' => $row['invoice_id']
                                ))->result_array();
                                foreach ($number_of_payments as $row2):
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo date('dS M, Y', $row2['timestamp']); ?></td>
                                        <td><?php echo $currency . ' ' . $row2['amount']; ?></td>
                                        <td>
                                            <?php
                                            if ($row2['method'] == 1) {
                                                echo 'Cash';
                                            } else if ($row2['method'] == 2) {
                                                echo 'Check';
                                            } else {
                                                echo 'Card';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="invoice-price">
                            <div class="invoice-price-left">
                                <div class="invoice-price-row">
                                    <div class="sub-price">
                                        <small>Sub Total</small>
                                        <?php echo $currency . ' ' . $row['sub_total']; ?> <i class="fa fa-plus"></i> <?php echo $row['vat_percentage']; ?> % VAT <i class="fa fa-minus"></i> <?php echo $row['discount_percentage']; ?> % Discount
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-price-right">
                                <small>Total Paid</small>
                                <?php
                                $payments = $this->db->get_where('payment', array(
                                    'invoice_id' => $row['invoice_id']
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
                        <p class="text-center m-b-5">

                        </p>

                        <p class="text-center">
                            <span class="m-r-10"><i class="fa fa-globe"></i> <?php echo $system_name; ?></span>
                            <span class="m-r-10"><i class="fa fa-phone"></i> <?php echo $system_phone; ?></span>
                            <span class="m-r-10"><i class="fa fa-envelope"></i> <?php echo $system_email; ?></span>
                        </p>
                    </div>
                </div>
                <!-- end invoice -->
            <?php endforeach; ?>
        </div>
    </section>
    <!-- /.content -->
</div>