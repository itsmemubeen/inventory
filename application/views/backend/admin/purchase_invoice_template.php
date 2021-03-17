<div class="container">
    <section class="content">
        <div id="content" class="content">

            <?php
            foreach ($purchase_invoice_details as $row):
                ?>
                <!-- begin invoice -->
                <div class="invoice">
                    <div class="invoice-company">
                        <h3><?php echo $system_name; ?></h3>
                    </div>
                    <hr>
                    <div class="invoice-header">
                        <div class="row">
                            <div class="col-md-8">
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
                                            <strong><?php echo $this->db->get_where('supplier', array('supplier_id' => $row['supplier_id']))->row()->company; ?></strong><br/>
                                            <?php echo $this->db->get_where('supplier', array('supplier_id' => $row['supplier_id']))->row()->name; ?>
                                            <br/>
                                            Phone
                                            : <?php echo $this->db->get_where('supplier', array('supplier_id' => $row['supplier_id']))->row()->phone; ?>
                                            <br/>
                                            Email
                                            : <?php echo $this->db->get_where('supplier', array('supplier_id' => $row['supplier_id']))->row()->email; ?>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="invoice-date">
                            <div class="date m-t-5"><?php echo date('dS M, Y', $row['timestamp']); ?></div>
                            <div class="invoice-detail">
                                <strong>Purchase Code
                                    : <?php echo $row['purchase_code']; ?></strong>
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
                                $products = json_decode($row['purchase_entries']);
                                $total_price = 0;
                                foreach ($products as $product):
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $this->db->get_where('product', array('product_id' => $product->product_id))->row()->serial_number; ?></td>
                                        <td><?php echo $this->db->get_where('product', array('product_id' => $product->product_id))->row()->name; ?></td>
                                        <td><?php echo $currency . ' ' . $product->purchase_price; ?></td>
                                        <td><?php echo $product->quantity; ?></td>
                                        <td><?php echo $currency . ' ' . $product->purchase_price * $product->quantity; ?></td>
                                        <?php $total_price += $product->purchase_price * $product->quantity; ?>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="invoice-price">
                            <div class="invoice-price-left">
                                <div class="col-md-4 col-sm-4">
                                    <div class="widget widget-stats bg-black"><p>GRAND TOTAL :
                                            <?php echo $currency . ' ' . $total_price; ?></p></div>
                                </div>
                                <?php if ($row['due'] != 0): ?>
                                    <div class="col-md-5 col-sm-6">
                                        <div class="widget widget-stats bg-red-lighter"><p>
                                                PAYMENT DUE : <?php echo $currency . ' ' . round($row['due'], 2); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="invoice-price-right">
                                <small>TOTAL PAID :</small>

                                <?php $amount = ($this->db->get_where('payment', array('purchase_id' => $purchase_id))->result_array());
                                $sub_total = 0;
                                $fractions = array();
                                foreach ($amount as $payments):
                                    // echo $payments['amount'] . '+';
                                    $sub_total += $payments['amount'];
                                endforeach;


                                ?>
                                <?php echo $currency . ' ' . $sub_total; ?>
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
</div>

