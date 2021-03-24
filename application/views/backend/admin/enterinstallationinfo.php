Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo "Issue Inventory"; ?>
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
        echo form_open(base_url() . 'index.php?admin/createOrder/create/', array(
            'class' => 'form-horizontal', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
        ));
        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary note-success">
                    <div class="box-header">
                        <h4 class="box-title">Instructions</h4>
                    </div>
                    <div class="box-body">
                        <ul>
                            <li>Check and recheck added products before creating the order. Products added can not be
                                edited
                                later but other informations are editable.
                            </li>
                            <li>You can add multiple products in a single order.</li>
                            <li>If order status and payment status is not selected, they will be automatically counted
                                as
                                pending order with unpaid payment status.
                            </li>
                            <li>The number in parenthesis in product selector represents the present stock quantity of
                                the
                                product.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- begin panel -->
                <div class="box box-primary">
                    <div class="box-header">

                        <h4 class="box-title">Basic Information</h4>
                    </div>
                    <div class="box-body">

                        <div class="col-md-12">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3">
                                    Order Code
                                </label>

                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="order_number"
                                           data-parsley-required="true"
                                           value="<?php echo substr(md5(rand(100000000, 200000000)), 0, 4); ?>"
                                           readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3">
                                    Employee
                                </label>

                                <div class="col-md-9 col-sm-9">
                                    <select class="form-control selectpicker" id="datachange" data-size="10" data-live-search="true"
                                            data-style="btn-default" data-parsley-required="true" name="customer_id"
                                            onchange="return get_customer_discount(this.value)">
                                        <option value="" selected>Select Employee</option>
                                        <?php
                                        $customers = $this->db->get_where('employee')->result_array();
                                        foreach ($customers as $row):
                                            ?>
                                            <option value="<?php echo $row['employee_id']; ?>">
                                                <?php echo $row['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <label class="control-label col-md-3 col-sm-3">
                                    Solution
                                </label>
                                <div class="col-md-9 col-sm-9">
                                    <select class="form-control selectpicker" data-size="10" data-live-search="true"
                                            data-style="btn-default" data-parsley-required="true" name="solution"
                                            onchange="return get_customer_discount(this.value)">
                                            <option selected="">Select Solution</option>
                                        <option>Wireless</option>
                                        <option>Fiber</option>
                                    </select>
                                </div>
                            </div>

                            <script type="text/javascript">
                                $("#datachange").change(function(){
                                    id = $("datachange option:selected").text();;
                                    $(".showdata").html('<select onchange='return add_product_for_order(this.value)'
                                            class='form-control selectpicker' data-size='10' data-live-search='true'
                                            data-style='btn-default' name='product_id'>
                                        <option value='' selected>Add A Product</option>
                                        <?php
                                        $products = $this->db->query('select * from issue_inventory where employee_id = 2;')->result_array();
                                        foreach ($products as $row):
                                            $data = explode("-",$row['products_data']);
                                            $product_name = $this->db->get_where('product', array('product_id' => $data[0]))->result_array();
                                            ?>
                                            <option value="<?php echo $row['employee_id']; ?>">
                                                <?php echo $product_name[0]['name']; ?> ( <?php echo $data[1]; ?> )
                                            </option>
                                        <?php endforeach; ?>
                                    </select>');
                                });
                            </script>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3">
                                    Date
                                </label>

                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control datepicker" id="datepicker-autoClose"
                                           name="creating_timestamp"
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
                                <div class="col-md-12 col-sm-12 showdata">
                                   
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
                        <button type="submit" class="btn btn-success">Create New Order</button>
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
        $("#wysihtml5").wysihtml5();
        $(".datepicker").datepicker({
            autoclose: true
        });
    });

    var total_number = 0;
    function add_product_for_order(product_id) {

        total_number++;

        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_product_for_order/' + product_id + '/' + total_number,
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
        calculate_change_amount();

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

    function get_customer_discount(customer_id) {

        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_customer_discount_percentage/' + customer_id,
            success: function (response) {
                jQuery('#discount_percentage').val(response[0].discount_percentage);
                jQuery('#shipping_address').val((response[0].address));

            }
        });

    }

    function calculate_change_amount() {
        get_grand_total = Number($("#grand_total").val());
        get_payment_amount = Number($("#payment").val());

        if (get_payment_amount > get_grand_total) {

            change_amount = get_payment_amount - get_grand_total;
            change_amount = change_amount.toFixed(2);
            $("#change_amount").attr("value", change_amount);
            get_change_amount = Number($("#change_amount").val());
            net_payable = get_payment_amount - get_change_amount;
            net_payable = net_payable.toFixed(2);
            $("#net_payment").attr("value", net_payable);
            $("#due_amount").attr("value", 0);
        }

        if (get_payment_amount < get_grand_total) {

            $("#change_amount").attr("value", 0);
            $("#net_payment").attr("value", get_payment_amount);
            get_due_amount = get_grand_total - get_payment_amount;
            get_due_amount = get_due_amount.toFixed(2);
            $("#due_amount").attr("value", get_due_amount);
        }

        if (get_payment_amount == get_grand_total) {

            $("#change_amount").attr("value", 0);
            $("#net_payment").attr("value", get_payment_amount);
            $("#due_amount").attr("value", 0);
        }
    }

</script>