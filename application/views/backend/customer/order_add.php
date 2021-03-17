<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $page_title; ?>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>index.php?customer/dashboard">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php?customer/order_add">
                    Place A New Order
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php?customer/order_history">
                    Order History
                </a>
            </li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php
        echo form_open(base_url() . 'index.php?customer/order/create/', array(
            'class' => 'form-horizontal', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
        ));
        ?>
        <div class="row">
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title">Basic Information</h4>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3">
                                    Order Code
                                </label>

                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="order_number"
                                           data-parsley-required="true"
                                           value="<?php echo substr(md5(rand(100000000, 200000000)), 0, 10); ?>"
                                           readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3">
                                    Date
                                </label>

                                <div class="col-md-9 col-sm-9">
                                    <input onclick="return get_customer_discount()" type="text" class="form-control"
                                           id="datepicker-autoClose" name="creating_timestamp"
                                           placeholder="Select Date" required/>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end panel -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title">Purchase A Product</h4>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-3">

                            <div class="form-group">
                                <div class="col-md-12 col-sm-12">
                                    <select onchange="return add_product_for_order(this.value)"
                                            class="form-control selectpicker" data-size="10" data-live-search="true"
                                            data-style="btn-default" name="product_id">
                                        <option value="">Select A Product</option>
                                        <?php
                                        $products = $this->db->get('product')->result_array();
                                        foreach ($products as $row):
                                            ?>
                                            <option value="<?php echo $row['product_id']; ?>">
                                                <?php echo $row['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Serial</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Total</th>
                                        <th><i class="fa fa-trash"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody id="order_entry_holder">

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end panel -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-7">
                <!-- begin panel -->
                <div class="panel panel-default" data-sortable-id="ui-widget-10">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Order Information
                        </h4>
                    </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3">
                                Address
                            </label>

                            <div class="col-md-9 col-sm-9">
                                <textarea class="form-control" name="shipping_address" placeholder="Shipping Address"
                                          rows="3"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3">
                                Notes
                            </label>

                            <div class="col-md-9 col-sm-9">
                                <textarea class="form-control" name="note" placeholder="Notes" rows="3"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end panel -->
            </div>
            <div class="col-md-5">
                <!-- begin panel -->
                <div class="panel panel-default" data-sortable-id="ui-widget-10">
                    <div class="panel-heading">

                        <h4 class="panel-title">
                            Payment
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td>Sub Total</td>
                                    <td>
                                        <input type="text" class="form-control text-right" id="sub_total" value=""
                                               name="sub_total" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Discount</td>
                                    <td>
                                        <input type="text" class="form-control text-right" id="discount_percentage"
                                               value="<?php echo $this->db->get_where('customer', array(
                                                   'customer_id' => $this->session->userdata('user_id')
                                               ))->row()->discount_percentage; ?>"
                                               name="discount_percentage" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>VAT</td>
                                    <td>
                                        <input class="form-control text-right" type="text" name="vat_percentage"
                                               id="vat_percentage" onkeyup="calculate_grand_total()"
                                               value="<?php echo $this->db->get_where('settings', array('type' => 'vat_percentage'))->row()->description; ?>"
                                               placeholder="VAT percentage"
                                               data-parsley-required="true" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Grand Total</td>
                                    <td>
                                        <input type="text" class="form-control text-right" id="grand_total" value=""
                                               name="grand_total" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Due</td>
                                    <td>
                                        <input type="text" class="form-control text-right" value="" id="due_amount"
                                               name="due" readonly>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="form-group col-md-10">
                                <button type="submit" class="btn btn-success">Place An Order</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end panel -->
            </div>
        </div>

        <?php echo form_close(); ?>


    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->


<script type="text/javascript">

    var total_number = 0;
    function add_product_for_order(product_id) {

        total_number++;

        $.ajax({
            url: '<?php echo base_url();?>index.php?customer/get_product_for_order/' + product_id + '/' + total_number,
            success: function (response) {
                jQuery('#order_entry_holder').append(response);
                calculate_grand_total();
            }
        });
    }

    function calculate_single_entry_sum(entry_number) {

        quantity = $("#single_entry_quantity_" + entry_number).val();
        selling_price = $("#single_entry_selling_price_" + entry_number).val();
        single_entry_total = quantity * selling_price;
        $("#single_entry_total_" + entry_number).html(single_entry_total);
        calculate_grand_total();

    }

    function calculate_grand_total() {

        // calculating subtotal
        sub_total = 0;
        for (var i = 1; i <= total_number; i++) {
            sub_total += Number($("#single_entry_total_" + i).html());

        }
        $("#sub_total").attr("value", sub_total);

        // calculating grand total
        discount_percentage = Number($("#discount_percentage").val());
        vat_percentage = Number($("#vat_percentage").val());

        sub_total = sub_total - (sub_total * (discount_percentage / 100));
        grand_total = sub_total + (sub_total * (vat_percentage / 100));

        grand_total = grand_total.toFixed(2);
        $("#grand_total").attr("value", grand_total);
        $("#due_amount").attr("value", grand_total);
    }

    function delete_row(entry_number) {

        $("#entry_row_" + entry_number).remove();

        for (var i = entry_number; i < total_number; i++) {

            $("#serial_" + (i + 1)).attr("id", "serial_" + i);
            $("#serial_" + (i)).html(i);

            $("#single_entry_quantity_" + (i + 1)).attr("id", "single_entry_quantity_" + i);
            $("#single_entry_quantity_" + (i)).attr({
                onkeyup: "calculate_single_entry_sum(" + i + ")",
                onclick: "calculate_single_entry_sum(" + i + ")"
            });

            $("#single_entry_selling_price_" + (i + 1)).attr("id", "single_entry_selling_price_" + i);
            $("#single_entry_selling_price_" + (i)).attr({
                onkeyup: "calculate_single_entry_sum(" + i + ")",
                onclick: "calculate_single_entry_sum(" + i + ")"
            });

            $("#delete_button_" + (i + 1)).attr("id", "delete_button_" + i);
            $("#delete_button_" + (i)).attr("onclick", "delete_row(" + i + ")");

            $("#entry_row_" + (i + 1)).attr("id", "entry_row_" + i);
        }

        total_number--;
        calculate_grand_total();
    }

</script>