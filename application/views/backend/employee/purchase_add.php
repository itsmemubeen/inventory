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
            <li>
                <a href="<?php echo base_url(); ?>index.php?employee/purchase_add">
                    New Purchase
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php?employee/purchase_history">
                    Purchase History
                </a>
            </li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php
        echo form_open(base_url() . 'index.php?employee/purchase_add/create/', array(
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
                                    Purchase Code
                                </label>

                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="purchase_code"
                                           data-parsley-required="true"
                                           value="<?php echo substr(md5(rand(100000000, 200000000)), 0, 10); ?>"
                                           readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3">
                                    Supplier
                                </label>

                                <div class="col-md-9 col-sm-9">
                                    <select class="form-control selectpicker" data-size="10" data-live-search="true"
                                            data-style="btn-default" data-parsley-required="true" name="supplier_id">
                                        <option value="" selected>Choose Supplier</option>
                                        <?php
                                        $suppliers = $this->db->get_where('supplier', array('softDelete' => 0))->result_array();
                                        foreach ($suppliers as $row):
                                            ?>
                                            <option value="<?php echo $row['supplier_id']; ?>">
                                                <?php echo $row['name']; ?> - [ <?php echo $row['company']; ?> ]
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
                                    <input type="text" class="form-control" id="datepicker-autoClose" name="timestamp"
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
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h4 class="panel-title">Purchase Product</h4>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-3">

                            <div class="form-group">
                                <div class="col-md-12 col-sm-12">
                                    <select onchange="return add_product_for_purchase(this.value)"
                                            class="form-control selectpicker" data-size="10" data-live-search="true"
                                            data-style="btn-default" name="product_id">
                                        <option value="" selected>Add A Product</option>
                                        <?php
                                        $products = $this->db->query('select * from product where softDelete = 0 and stock_quantity >0;')->result_array();
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
                                        <th>Serial</th>
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
                                    <td>Grand Total</td>
                                    <td class="text-right" id="grand_total"></td>
                                </tr>
                                <tr>
                                    <td>Payment</td>
                                    <td>
                                        <input class="form-control" type="text" name="amount" id="" value=""
                                               placeholder="Enter Payment Amount"
                                               data-parsley-required="true">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Method</td>
                                    <td>
                                        <select class="form-control" name="method">
                                            <option value=""
                                                    selected>Select payment Method
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
                                        class="btn btn-success">Make A New Purchase
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
</div>


<script type="text/javascript">

    var total_number = 0;
    function add_product_for_purchase(product_id) {

        total_number++;

        $.ajax({
            url: '<?php echo base_url();?>index.php?employee/get_product_for_purchase/' + product_id + '/' + total_number,
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

        $("#grand_total").html(grand_total);
    }

</script>