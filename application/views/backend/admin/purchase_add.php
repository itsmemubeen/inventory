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
                <a href="<?php echo base_url(); ?>index.php?admin/add_new_purchase">
                    Purchase New Item
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php?admin/view_all_purchase_history">
                    View Purchase History
                </a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php
        echo form_open(base_url() . 'index.php?admin/add_new_purchase/create/', array(
            'class' => 'form-horizontal', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
        ));
        ?>
        <div class="row">
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="box box-primary">
                    <div class="box-header">

                        <h4 class="box-title">Basic Information</h4>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="note note-success">
                                <h4>Instructions</h4>
                                <ul>
                                    <li>Check and recheck the informations you have given before creating the purchase.
                                        The purchase once made can not be altered.
                                    </li>
                                    <li>You can add multiple products of any amount during the purchase.</li>
                                    <li>The number in parenthesis in product selector represents the present stock
                                        quantity of the product.
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3">
                                    Form #
                                </label>

                                <div class="col-md-9 col-sm-9">
                                    <?php
                                        $suppliers = $this->db->get_where('vendors')->result_array();
                                        ?>
                                    <input class="form-control" type="text" name="purchase_code"
                                           data-parsley-required="true"
                                           value="<?php echo substr(md5(rand(100000000, 200000000)), 0, 4); ?>"
                                           readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3">
                                    Vendor
                                </label>

                                <div class="col-md-9 col-sm-9">
                                    <select class="form-control selectpicker" data-size="10" data-live-search="true"
                                            data-style="btn-default" data-parsley-required="true" name="supplier_id">
                                        <option value="" selected>Select Vendor</option>
                                        <?php
                                        $suppliers = $this->db->get_where('vendors')->result_array();
                                        foreach ($suppliers as $row):
                                            ?>
                                            <option value="<?php echo $row['id']; ?>">
                                                <?php echo $row['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3">
                                    Date
                                </label>

                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control datepicker" id="datepicker-autoClose" name="timestamp"
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
                <div class="box box-primary">
                    <div class="box-header">

                        <h4 class="box-title">Purchase Products</h4>
                    </div>
                    <div class="box-body">
                        <div class="col-md-3">

                            <div class="form-group">
                                <div class="col-md-12 col-sm-12">
                                    <select onchange="return add_product_for_purchase(this.value)"
                                            class="form-control selectpicker" data-size="10" data-live-search="true"
                                            data-style="btn-default" name="product_id">
                                        <option value="" selected>Add A Product</option>
                                        <?php
                                        $products = $this->db->query('select * from product where softDelete =0;')->result_array();
                                        foreach ($products as $row):
                                            ?>
                                            <option value="<?php echo $row['product_id']; ?>">
                                                <?php echo $row['name']; ?> ( <?php echo $row['stock_quantity']; ?> )
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
                                        <th>Serial No</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Total</th>
                                        <th><i class="fa fa-trash"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody id="purchase_entry_holder">

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
            <div class="col-md-7"></div>
            <div class="col-md-5">
                <!-- begin panel -->
                <div class="panel panel-default" data-sortable-id="ui-widget-10">
                    <div class="box-header">

                        <h4 class="box-title">
                            Payment
                        </h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td>Grand Total</td>
                                    <td>
                                        <input type="number" class="form-control text-right" value="" id="net_payment"
                                               name="amount" placeholder="Added Automatically Based On Your Purchase">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Payment</td>
                                    <td>
                                        <input class="form-control text-right" type="number" name="amount" id="payment"
                                               value=""
                                               onkeyup="return calculate_change_amount()"
                                               placeholder="Enter Payment Amount"
                                               data-parsley-required="true">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Due</td>
                                    <td>
                                        <input type="number" placeholder="Due" class="form-control text-right" value=""
                                               id="due_amount"
                                               name="due">
                                    </td>
                                </tr>

                                <tr>
                                    <td>Method</td>
                                    <td>
                                        <select class="form-control" name="method">
                                            <option value=""
                                                    selected>Select Payment Method
                                            </option>
                                            <option value="1">Cash</option>
                                            <option value="2">Check</option>
                                            <option value="3">Card</option>
                                        </select>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="form-group col-md-10">
                                <button type="submit"
                                        class="btn btn-success">Purchase Product(s)
                                </button>
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

    $(document).ready(function () {
        $(".datepicker").datepicker({
            autoclose: true
        });

    });
    //var grand_total = $("#net_payment");
    $('#payment').keyup(function () {
        $("#due_amount").val($('#net_payment').val() - $("#payment").val());
    });


    var total_number = 0;
    function add_product_for_purchase(product_id) {

        total_number++;

        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_product_for_purchase/' + product_id + '/' + total_number,
            success: function (response) {
                jQuery('#purchase_entry_holder').append(response);
                calculate_grand_total_for_purchase();
            }
        });
    }

    function calculate_single_entry_sum(entry_number) {

        quantity = $("#single_entry_quantity_" + entry_number).val();
        purchase_price = $("#single_entry_purchase_price_" + entry_number).val();
        single_entry_total = quantity * purchase_price;
        $("#single_entry_total_" + entry_number).html(single_entry_total);
        calculate_grand_total_for_purchase();
        calculate_change_amount();

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

            $("#single_entry_purchase_price_" + (i + 1)).attr("id", "single_entry_purchase_price_" + i);
            $("#single_entry_purchase_price_" + (i)).attr({
                onkeyup: "calculate_single_entry_sum(" + i + ")",
                onclick: "calculate_single_entry_sum(" + i + ")"
            });

            $("#delete_button_" + (i + 1)).attr("id", "delete_button_" + i);
            $("#delete_button_" + (i)).attr("onclick", "delete_row(" + i + ")");

            $("#entry_row_" + (i + 1)).attr("id", "entry_row_" + i);
        }

        total_number--;
        calculate_grand_total_for_purchase();
    }

    function calculate_grand_total_for_purchase() {

        grand_total = 0;
        for (var i = 1; i <= total_number; i++) {
            grand_total += Number($("#single_entry_total_" + i).html());

        }

        $("#net_payment").val(grand_total);
    }


    function calculate_change_amount() {
        grand_total = Number($("#net_payment").val());
        payment = Number($("#payment").val());
        due = Number($("#due_amount").val());
        if (payment > grand_total) {

            result = payment - grand_total;
            due.val(result);
        }

        if (payment < grand_total) {

            result = grand_total - payment;
            due.val(result);
        }

        if (payment == grand_total) {

            $("#due_amount").attr("value", 0);
        }
    }


</script>