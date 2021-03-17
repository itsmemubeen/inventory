<?php
$payment_for_order = $this->db->get_where('purchase', array(
    'purchase_id' => $purchase_id
))->result_array();
foreach ($payment_for_order as $row):
    ?>
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $page_title;?>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url();?>index.php?admin/dashboard">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="<?php echo base_url();?>index.php?admin/purchase_add">
                    Create New Purchase
                </a>
            </li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="box box-primary">
                        <div class="box-header">
                            
                            <h4 class="box-title"><?php echo 'Purchase Code' . ': ' . $row['purchase_code'];?></h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <td><strong>#</strong></td>
                                        <td><strong>Serial Number</strong></td>
                                        <td><strong>Name</strong></td>
                                        <td><strong>Quantity</strong></td>
                                        <td><strong>Unit Price</strong></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    $total_price = 0;
                                    $products = json_decode($row['purchase_entries']);
                                    foreach ($products as $product):
                                        ?>
                                        <tr>
                                            <td><?php echo $count++;?></td>
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
                                            <td><?php echo $product->quantity;?></td>
                                            <td><?php echo $currency . ' ' . $product->purchase_price;?></td>
                                            <?php $total_price += $product->purchase_price * $product->quantity;?>
                                        </tr>
                                    <?php endforeach;?>
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
                    <div class="box box-primary">
                        <div class="box-header">

                            <h4 class="box-title">Make Payment</h4>
                        </div>
                        <div class="box-body">
                            <?php
                            echo form_open(base_url() . 'index.php?admin/give_purchase_payment/make_payment/' . $row['purchase_id'], array(
                                'class' => 'form-horizontal', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
                            ));
                            ?>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3">
                                    Payment
                                </label>

                                <div class="col-md-6 col-sm-6">
                                    <input type="hidden" name="supplier_id" value="<?php echo $row['supplier_id'];?>"/>
                                    <input type="text" class="form-control" name="amount" data-parsley-required="true"
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
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3"></label>

                                <div class="col-md-6 col-sm-6">
                                    <button type="submit"
                                            class="btn btn-danger">Make Payment</button>
                                </div>
                            </div>

                            <?php echo form_close();?>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <div class="col-md-6">
                    <!-- begin panel -->
                    <div class="box box-primary">
                        <div class="box-header">

                            <h4 class="box-title">Amount</h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                    <tr>
                                        <td><strong>Paid</strong></td>
                                        <td><?php echo $currency . ' ' . $total_price; ?></td>
                                        <td><strong>Due</strong></td>
                                        <td><?php echo $currency . ' ' . round($row['due'], 2);?></td>
                                    </tr>
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
<?php endforeach; ?>