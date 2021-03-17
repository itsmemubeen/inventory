<?php
$result = $this->db->query("select * from purchase WHERE TIMESTAMP BETWEEN $timestamp_start AND $timestamp_end;")->result_array();
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
                <a href="<?php echo base_url(); ?>index.php?admin/report/payment">
                    Payments
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php?admin/report/customer">
                    Customer Payment
                </a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <br>

        <div class="row">
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-default" data-sortable-id="ui-widget-1">
                    <div class="panel-heading">

                        <h4 class="panel-title">
                            Select Date Range
                        </h4>
                    </div>
                    <div class="panel-body">
                        <?php
                        echo form_open(base_url() . 'index.php?admin/report/' . $report_type, array(
                            'class' => 'form-horizontal form-bordered', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
                        ));
                        ?>

                        <div class="form-group">
                            <label class="col-md-3">Date Range</label>

                            <div class="col-md-8">
                                <div class="input-group input-daterange">
                                    <input type="text" class="form-control" name="start"
                                           value="<?php echo date('m/d/Y', $timestamp_start); ?>"/>
                                    <span class="input-group-addon">To</span>
                                    <input type="text" class="form-control" name="end"
                                           value="<?php echo date('m/d/Y', $timestamp_end); ?>"/>
                                </div>
                                <br/>
                            </div>


                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-sm-3"></label>

                            <div class="col-md-8 col-sm-8">
                                <button type="submit" class="btn btn-success">Go</button>
                            </div>
                        </div>

                        <?php echo form_close(); ?>
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

                        <h4 class="panel-title">Purchase History</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">

                            <table id="data-table" class="table table-bordered nowrap display" width="100%">
                                <thead>
                                <tr class="text-center">
                                    <th class="text-center">#</th>
                                    <th class="text-center">Supplier Name</th>
                                    <th class="text-center">Supplier Company Name</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Purchase Details </th>                   
                                   <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                foreach ($result as $row):?>
                                    <tr class="text-center">
                                        <td><?php echo $count++;?></td>
                                        <td><?php echo $this->db->get_where('supplier', array('supplier_id' => $row['supplier_id']))->row()->name;?></td>
                                        <td><?php echo $this->db->get_where('supplier', array('supplier_id' => $row['supplier_id']))->row()->company;?></td>
                                        <td><?php echo date("d F, Y", $row['timestamp']);?></td>
                                        <td>
                                           <table class="table table-bordered">
                                                <tr>
                                         <th class="text-center">Product Name</th>
                                    <th class="text-center">Purchase Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Total Purchase Amount</th>
                                                </tr>

                                      
                                        <?php $product_information = json_decode($row['purchase_entries']);
                                        foreach ($product_information as $product):?>
                                          <tr>
                                            <td><?php echo $this->db->get_where('product', array('product_id' => $product->product_id))->row()->name;?></td>
                                            <td><?php echo $this->db->get_where('product', array('product_id' => $product->product_id))->row()->purchase_price;?></td>
                                            <td><?php echo $product->quantity;?></td>
                                            <td><?php echo ($this->db->get_where('product', array('product_id' => $product->product_id))->row()->purchase_price * $product->quantity) . ' ' . $currency;?></td>
                                            </tr>
                                        <?php endforeach;?>
      </table>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url();?>index.php?admin/purchase_invoice_view/<?php echo $row['purchase_id'];?>"
                                               class="btn btn-success btn-xs">
                                                <i class="fa fa-eye"></i>
                                                View Purchase Invoices
                                            </a>                                        <?php if ($row['due'] != 0): ?>
                                                <a href="<?php echo base_url(); ?>index.php?admin/make_purchase_payment/<?php echo $row['purchase_id']; ?>"
                                                   class="btn btn-info btn-xs">
                                                    <i class="fa fa-money"></i>
                                                    Make Payment
                                                </a>
                                            <?php endif;?>
                                        </td>
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

    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->
























