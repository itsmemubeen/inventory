<?php
$edit_order = $this->db->get_where('order', array(
    'order_id' => $order_id
))->result_array();
foreach ($edit_order as $row):
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php echo $page_title; ?>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url(); ?>index.php?admin/dashboard">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>index.php?admin/add_a_new_order">
                        Create New Order
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>index.php?admin/view_all_orders">
                        All Orders
                    </a>
                </li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <?php
            echo form_open(base_url() . 'index.php?admin/make_order/edit/' . $row['order_id'], array(
                'class' => 'form-horizontal', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
            ));
            ?>

            <div class="row">
                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="box box-primary">
                        <div class="box-header">

                            <h4 class="box-title">Ordered Products</h4>
                        </div>
                        <div class="box-body">
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
                <div class="col-md-7">
                    <!-- begin panel -->
                    <div class="box box-primary">
                        <div class="box-header">

                            <h4 class="box-title">Status</h4>
                        </div>
                        <div class="box-body">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3">
                                    Order Status
                                </label>

                                <div class="col-md-9 col-sm-9">
                                    <select class="form-control selectpicker" data-size="10" data-live-search="true"
                                            data-style="btn-default" data-parsley-required="true" name="order_status">
                                        <option value=""
                                                selected>Select Order Status
                                        </option>
                                        <option value="0" <?php if ($row['order_status'] == 0) echo 'selected'; ?>>
                                            Partially Paid
                                        </option>
                                        <option
                                            value="1" <?php if ($row['order_status'] == 1) echo 'selected'; ?>>Approved
                                        </option>
                                        <option
                                            value="2" <?php if ($row['order_status'] == 2) echo 'selected'; ?>>Rejected
                                        </option>
                                        <option value="3" <?php if ($row['order_status'] == 3) echo 'selected'; ?>>
                                            Product Sent Full Payment Due
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3">
                                    Payment Status
                                </label>

                                <div class="col-md-9 col-sm-9">
                                    <select class="form-control selectpicker" data-size="10" data-live-search="true"
                                            data-style="btn-default" data-parsley-required="true"
                                            name="payment_status">
                                        <option value=""
                                                selected>Select payment Status
                                        </option>
                                        <option
                                            value="0" <?php if ($row['payment_status'] == 0) echo 'selected'; ?>>Unpaid
                                        </option>
                                        <option
                                            value="1" <?php if ($row['payment_status'] == 1) echo 'selected'; ?>>Paid
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3">
                                    Address
                                </label>

                                <div class="col-md-9 col-sm-9">
                                    <textarea class="form-control" name="shipping_address"
                                              placeholder="Shipping Address"
                                              rows="3"><?php echo $row['shipping_address']; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3">
                                    Note
                                </label>

                                <div class="col-md-9 col-sm-9">
                                    <textarea id="wysihtml5" class="form-control" name="note"
                                              placeholder="Notes"
                                              rows="3"><?php echo $row['note']; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3"></label>

                                <div class="col-md-9 col-sm-9">
                                    <button type="submit"
                                            class="btn btn-success">Update Order
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <div class="col-md-5">
                    <!-- begin panel -->
                    <div class="box box-primary">
                        <div class="box-header">

                            <h4 class="box-title">basic Information</h4>
                        </div>
                        <div class="box-body">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3">
                                    Order Code
                                </label>

                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="order_number"
                                           data-parsley-required="true"
                                           value="<?php echo $row['order_number']; ?>" readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3">
                                    Customer
                                </label>

                                <div class="col-md-9 col-sm-9">
                                    <select class="form-control selectpicker" data-size="10" data-live-search="true"
                                            data-style="btn-default"
                                            data-parsley-required="true" name="customer_id">
                                        <option value="<?php echo $row['customer_id']; ?>">
                                            <?php echo $this->db->get_where('customer', array(
                                                'customer_id' => $row['customer_id']
                                            ))->row()->name; ?>
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3">
                                    Date
                                </label>

                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control" id="datepicker-autoClose"
                                           name="modifying_timestamp"
                                           placeholder="Select Date"
                                           value="<?php echo date('dS M, Y', $row['creating_timestamp']); ?>"/>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end panel -->
                </div>
            </div>
            <?php echo form_close(); ?>
    </div>
<?php endforeach; ?>

</section>
<!-- /.content -->
</div><!-- /.content-wrapper -->


<script>
    $(document).ready(function () {
        $("#wysihtml5").wysihtml5();
    });
</script>