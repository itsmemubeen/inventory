<?php
$customer_profile = $this->db->get_where('customer', array(
    'customer_id' => $param2
))->result_array();
foreach ($customer_profile as $row):
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4 col-sm-4">
                <!-- begin panel -->
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Basic Information
                        </h4>
                    </div>
                    <div class="panel-body">
                        <img class="thumbnail img-responsive"
                             src="<?php echo $this->crud_model->get_image_url('customer', $row['customer_id']); ?>">


                        <div class="list-group">
                            <a href="#" class="list-group-item active">
                                <?php echo $row['name']; ?>
                            </a>
                            <a href="#" class="list-group-item"><i class="fa fa-paper-plane"></i> <?php echo $row['email']; ?> </a>
                            <a href="#" class="list-group-item"><i class="fa fa-map-marker"></i> <?php echo $row['address']; ?></a>
                            <a href="#" class="list-group-item"><i class="fa fa-phone"></i> <?php echo $row['phone']; ?></a>
                            <a href="#" class="list-group-item">Discount Percentage : <?php echo $row['discount_percentage']; ?></a>
                        </div>

                    </div>
                </div>
                <!-- end panel -->
            </div>

            <div class="col-md-8 col-sm-8">
                <!-- begin panel -->
                <div class="panel panel-default panel-with-tabs" data-sortable-id="ui-widget-9">
                    <div class="panel-heading">
                        <h4 class="panel-title text-left">History</h4>



                    </div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Order History</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Purchase History</a></li>

                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade in active" id="home">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Order Number</td>
                                        <td>Order Status</td>
                                        <td>Payment Status</td>
                                        <td>Date Created</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    $orders_from_customer = $this->db->get_where('order', array(
                                        'customer_id' => $row['customer_id']
                                    ))->result_array();
                                    foreach ($orders_from_customer as $row2):
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $row2['order_number']; ?></td>
                                            <td>
                                                <?php
                                                if ($row2['order_status'] == 0) {
                                                    echo 'Pending';
                                                } else if ($row2['order_status'] == 1) {
                                                    echo 'Approved';
                                                } else {
                                                    echo 'Rejected';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row2['payment_status'] == 0) {
                                                    echo 'Unpaid';
                                                } else {
                                                    echo 'Paid';
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo date('dS M, Y', $row2['creating_timestamp']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Invoice Code</td>
                                        <td>Payment Method</td>
                                        <td>Total Amount</td>
                                        <td>Date</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    $sales_to_customer = $this->db->get_where('invoice', array(
                                        'customer_id' => $row['customer_id']
                                    ))->result_array();
                                    foreach ($sales_to_customer as $row3):
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $row3['invoice_code']; ?></td>
                                            <td>
                                                <?php
                                                $payment_method = $this->db->get_where('payment', array(
                                                    'invoice_id' => $row3['invoice_id']
                                                ))->row()->method;
                                                if ($payment_method == 1)
                                                    echo 'Cash';
                                                else if ($payment_method == 2)
                                                    echo 'Check';
                                                else echo 'Card';
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $system_currency = $this->db->get_where('settings', array(
                                                    'type' => 'currency'
                                                ))->row()->description;
                                                $payments_from_customer = $this->db->get_where('payment', array(
                                                    'invoice_id' => $row3['invoice_id']
                                                ))->result_array();
                                                $total = 0;
                                                foreach ($payments_from_customer as $row4) {
                                                    $total += $row4['amount'];
                                                }
                                                echo $system_currency . ' ' . $total;
                                                ?>
                                            </td>
                                            <td><?php echo date('dS M, Y', $row3['timestamp']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end panel -->
            </div>
        </div>


    </div>


<?php endforeach; ?>
