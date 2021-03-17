<!-- begin #content -->

<!-- end #content -->


<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div id="content" class="content">

            <?php
            $order_invoice_details = $this->db->get_where('order', array(
                'order_number' => $order_number
            ))->result_array();
            foreach ($order_invoice_details as $row):
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
                                        Phone: <?php echo $this->db->get_where('customer', array('customer_id' => $row['customer_id']))->row()->phone; ?>
                                        <br/>
                                        Email: <?php echo $this->db->get_where('customer', array('customer_id' => $row['customer_id']))->row()->email; ?>
                                        <br/>
                                        Shipping Address: <?php echo $row['shipping_address']; ?>
                                    </address>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="invoice-date">
                            <div class="date m-t-5"><?php echo date('dS M, Y', $row['creating_timestamp']); ?></div>
                            <div class="invoice-detail">
                                <strong>Order Code: <?php echo $row['order_number']; ?></strong><br/>
                                <strong>
                                    Order Status:
                                    <?php if ($row['order_status'] == 0) {
                                        echo 'Pending';
                                    } else if ($row['order_status'] == 1) {
                                        echo 'Approved';
                                    } else {
                                        echo 'Rejected';
                                    }

                                    ?>
                                </strong><br/>
                                <strong>
                                    Payment Status:
                                    <?php if ($row['payment_status'] == 0) {
                                        echo 'Unpaid';
                                    } else if ($row['payment_status'] == 1) {
                                        echo 'Paid';
                                    }
                                    ?>
                                </strong>
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
                                    'order_id' => $row['order_id']
                                ))->result_array();
                                if ($number_of_payments != ''):
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
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="invoice-price">
                            <div class="invoice-price-left">
                                <div class="invoice-price-row">
                                    <div class="sub-price">
                                        <small>Sub Total</small>
                                        <?php echo $currency . ' ' . $row['sub_total']; ?> <i
                                            class="fa fa-plus"></i> <?php echo $row['vat_percentage']; ?> % VAT <i
                                            class="fa fa-minus"></i> <?php echo $row['discount_percentage']; ?> %
                                        Discount
                                    </div>
                                    <div class="sub-price">

                                    </div>
                                    <div class="sub-price">

                                    </div>
                                    <div class="sub-price">

                                    </div>
                                    <div class="sub-price">

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
</div><!-- /.content-wrapper -->