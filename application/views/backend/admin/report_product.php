<?php

$products = $this->db->query("select name, purchase_price, selling_price, stock_quantity from product")->result_array();
$stock_sum = $this->db->query("select sum(stock_quantity) as 'stock' from product")->row();
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
                    Customer Payments
                </a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info fade in m-b-15">
                    <strong>
                        Product Available In Stock: <?php echo $stock_sum->stock; ?>
                    </strong>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Product Summary</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">

                            <table id="data-table" class="table table-striped table-bordered nowrap display"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Purchase Price</th>
                                    <th>Selling Price</th>
                                    <th>Stock Quantity</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                foreach ($products as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['purchase_price']; ?></td>
                                        <td><?php echo $row['selling_price']; ?></td>
                                        <td><?php echo $row['stock_quantity']; ?></td>
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





















