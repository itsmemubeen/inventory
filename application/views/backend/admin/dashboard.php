<?php

/**
 * Get current stock amount.
 */
$date = strtotime(date("m/d/Y"));
$first_day = strtotime(date('m/01/Y'));


$query = "SELECT (amount * stock_quantity) AS 'total_price' FROM product WHERE stock_quantity > 0;";
//$results = $this->db->query($query)->result_array();


$max_product_count = $this->db->query("SELECT * FROM product ORDER BY stock_quantity DESC;")->row();

$total_price = 0;

foreach ($this->db->query($query)->result_array() as $price):
    $total_price += $price['total_price'];

endforeach;

$zero_quantity = $this->db->query("SELECT name FROM product WHERE stock_quantity=0;")->result_array();


$total_due_purchase = 0;

foreach ($this->db->query("select due from purchase WHERE TIMESTAMP BETWEEN  $first_day AND $date;")->result_array() as $due):
    $total_due_purchase += $due['due'];
endforeach;

$latest_order = $this->db->query('select * from `order` order by order_id DESC limit 7;')->result_array();

$latest_products = $this->db->query('select * from product order by product_id desc limit 4;')->result_array();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><strong>Total Customers</strong></span>
                        <span class="info-box-number"><?php echo $this->db->count_all('customer'); ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><strong>Total Due (Sale + Order) In This Month</strong></span>
                        <span class="info-box-number">
                                <?php

                                /**
                                 * Invoices Dues
                                 */
                                $dues_invoice = $this->db->query("select * from invoice WHERE TIMESTAMP BETWEEN  $first_day AND $date;")->result_array();
                                $total_invoice_due = 0;
                                foreach ($dues_invoice as $row) {
                                    $total_invoice_due += $row['due'];
                                }
                                //echo '{ Sell:}  ' . $total_invoice_due;

                                /**
                                 * Order Dues
                                 */

                                $dues_order = $this->db->query("select * from `order` WHERE CREATING_TIMESTAMP BETWEEN  $first_day AND $date AND order_status <> 2;")->result_array();
                                $total_order_due = 0;
                                foreach ($dues_order as $row) {
                                    $total_order_due += $row['due'];
                                }

                                //echo '{ Order: } ' . $total_order_due;
                                ?>
                                <?php echo $total_invoice_due . ' + ' . $total_order_due . ' = ' . $currency . ' ' . ($total_invoice_due + $total_order_due); ?>

                            </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><strong>Total Income Amount In This Month</strong></span>
                        <span class="info-box-number"><?php

                            $incomes = $this->db->query("select * from payment where type='income' and TIMESTAMP BETWEEN  $first_day AND $date;")->result_array();
                            //var_dump($this->db->queries[110]);
                            $total_income = 0;
                            foreach ($incomes as $row) {
                                $total_income += $row['amount'];
                            }
                            echo $currency . ' ' . $total_income; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><strong>Total Purchase Amount In This Month</strong></span>
                        <span class="info-box-number"><?php
                            $expenses = $this->db->query("select * from payment where type='expense' and TIMESTAMP BETWEEN  $first_day AND $date;")->result_array();

                            //var_dump($expenses);
                            $total_expense = 0;
                            foreach ($expenses as $row) {
                                $total_expense += $row['amount'];
                            }
                            echo $currency . ' ' . $total_expense;
                            ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $currency . ' ' . $total_price; ?></h3>

                        <strong><p>Current Stock Amount</p></strong>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bars"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php?admin/currentStock" class="small-box-footer">
                        <strong>View Current Stock</strong> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php if (!empty($max_product_count)) {
                                echo $max_product_count->name;
                            } else {
                                echo "No Product Available in the stock.";
                            } ?></h3>

                        <strong><p>Highest stocked product</p></strong>
                    </div>
                    <div class="icon">
                        <i class="fa fa-arrow-up"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php?admin/getAllProducts" class="small-box-footer">
                        <strong>View All Products</strong> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php $zero_stock_product = $this->db->query('SELECT count(name) as `number`  FROM `product` WHERE stock_quantity =0;')->result_array();
                            echo($zero_stock_product[0]['number']);
                            ?></h3>

                        <strong><p>Zero Stock Quantity Products</p></strong>
                    </div>
                    <div class="icon">
                        <i class="fa fa-arrow-down"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php?admin/product_oos" class="small-box-footer">
                        <strong>View All</strong> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $currency . ' ' . $total_due_purchase; ?></h3>

                        <strong><p>Total Due Purchase In This Month</p></strong>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calculator"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php?admin/view_all_purchase_history"
                       class="small-box-footer">
                        <strong>View All Purchase</strong> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Recent Customer Payment History</h3>

                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <div id="customer_bar_diagram" style="height: 400px; width: 100%;"></div>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4 col-xs-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-green"><i
                                            class="fa fa-caret-up"></i> %</span>
                                    <h5 class="description-header"><?php
                                        $incomes = $this->db->query("select * from payment where type='income';")->result_array();
                                        $total_income = 0;
                                        foreach ($incomes as $row) {
                                            $total_income += $row['amount'];
                                        }
                                        echo $currency . number_format($total_income); ?></h5>
                                    <span class="description-text">LIFETIME INCOME</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 col-xs-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> %</span>
                                    <h5 class="description-header"><?php
                                        $expenses = $this->db->query("select * from payment where type='expense';")->result_array();

                                        //var_dump($expenses);
                                        $total_expense = 0;
                                        foreach ($expenses as $row) {
                                            $total_expense += $row['amount'];
                                        }
                                        echo $currency . ' ' . number_format($total_expense);
                                        ?></h5>
                                    <span class="description-text">LIFETIME PURCHASE</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 col-xs-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-green"><i
                                            class="fa fa-caret-up"></i> %</span>
                                    <h5 class="description-header"><?php

                                        $incomes = $this->db->query("select * from payment where type='income';")->result_array();
                                        $total_income = 0;
                                        foreach ($incomes as $row) {
                                            $total_income += $row['amount'];
                                        }
                                        $expenses = $this->db->query("select * from payment where type='expense';")->result_array();

                                        //var_dump($expenses);
                                        $total_expense = 0;
                                        foreach ($expenses as $row) {
                                            $total_expense += $row['amount'];
                                        }

                                        echo $currency . ' ' . number_format(($total_income - $total_expense)); ?></h5>
                                    <span class="description-text">LIFETIME PROFIT</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-8">


                <!-- TABLE: LATEST ORDERS -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Latest Orders</h3>

                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Item</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($latest_order as $order): ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo base_url(); ?>index.php?admin/order_invoice_view/<?php echo $order['order_id']; ?>"><?php echo $order['order_number']; ?></a>
                                        </td>
                                        <td>
                                            <?php $products = json_decode($order['order_entries']); ?>
                                            <?php foreach ($products as $product): ?>
                                                <?php echo $this->db->get_where('product', array('product_id' => $product->product_id))->row()->name; ?>
                                            <?php endforeach; ?>
                                        </td>
                                        <td><?php if ($order['order_status'] == 0) { ?>
                                                <span class="label label-primary">Partially Paid</span>
                                            <?php } else if ($order['order_status'] == 1) { ?>
                                                <span class="label label-success">Approved</span>
                                            <?php } else if ($order['order_status'] == 2) { ?>
                                                <span class="label label-danger">Rejected</span>
                                            <?php } else if ($order['order_status'] == 3) { ?>
                                                <span class="label label-warning">Full Due</span>
                                            <?php } ?></td>
                                    </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <a href="<?php echo base_url(); ?>index.php?admin/add_a_new_order"
                           class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                        <a href="<?php echo base_url(); ?>index.php?admin/view_all_orders"
                           class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

            <div class="col-md-4">
                <!-- PRODUCT LIST -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Recently Added Products</h3>

                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="products-list product-list-in-box">
                            <?php foreach ($latest_products as $product): ?>
                                <li class="item">
                                    <div class="product-img">
                                        <img src="uploads/product_image/<?php echo $product['product_id'] . '.jpg'; ?>"
                                             alt="Product Image">
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript::;"
                                           onclick="showMessageModal('<?php echo base_url(); ?>index.php?modal/popup/product_detail/<?php echo $product['product_id']; ?>');"
                                           class="product-title"><?php echo $product['name']; ?>
                                            <span
                                                class="label label-danger pull-right"><?php echo $currency . ' ' . $product['amount']; ?></span></a>
                        <span class="product-description">
                          <!-- <?php echo $product['note']; ?> -->
                        </span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                            <!-- /.item -->
                        </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <a href="javascript::;" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/product_add');"
                           class="btn btn-sm btn-info btn-flat pull-left">Add New Product</a>
                        <a href="<?php echo base_url(); ?>index.php?admin/getAllProducts"
                           class="btn btn-sm btn-default btn-flat pull-right">View All Products</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product Stock Report</h3>

                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <div id="stock_bar_diagram" style="height: 600px; width: 100%"></div>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->

                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>


    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->


<script>

    var chart = AmCharts.makeChart("customer_bar_diagram", {
        "theme": "light",
        "type": "serial",
        "startDuration": 2,
        "dataProvider": [
            <?php
                $timestamp_start=	strtotime('-29 days', time());
                $timestamp_end	=	strtotime(date("m/d/Y"));
                $this->db->select_sum('amount');
                $this->db->group_by('customer_id');
                $this->db->order_by('timestamp' , 'desc');
                $this->db->select('timestamp, customer_id');
                $this->db->where('customer_id !=' , 0);
                $payments	=	$this->db->get('payment')->result_array();
                foreach ($payments as $row):
                    ?>
            {
                "customer": "<?php echo $this->db->get_where('customer',
										array('customer_id' => $row['customer_id']))->row()->name ;?>",
                "amount": <?php echo $row['amount'];?>,
                "color": "#0D8ECF"
            },
            <?php endforeach;?>
        ],
        "graphs": [{
            "balloonText": "[[category]]: <b>[[value]]</b>",
            "colorField": "color",
            "fillAlphas": 1,
            "lineAlpha": 0.1,
            "type": "column",
            "valueField": "amount"
        }],
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "customer",
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 30
        },
        "pathToImages": "<?php echo base_url();?>public/plugins/amcharts/images/",
        "amExport": {
            "top": 0,
            "right": 0,
            "buttonColor": '',
            "buttonRollOverColor": '#DDDDDD',
            "imageFileName": "Customer Payment Report",
            "exportPNG": true,
            "exportJPG": true,
            "exportPDF": true,
            "exportSVG": true
        }
    });

</script>


<script>

    var chart = AmCharts.makeChart("stock_bar_diagram", {
        "theme": "light",
        "type": "serial",
        "startDuration": 2,
        "dataProvider": [
            <?php
                $products	=	$this->db->get('product')->result_array();
                foreach ($products as $row):
                    ?>
            {
                "product": "<?php echo $row['name'];?>",
                "in_stock": <?php echo $row['stock_quantity'];?>,
                "color": "#3c8dbc"
            },
            <?php endforeach;?>
        ],
        "graphs": [{
            "balloonText": "[[category]]: <b>[[value]]</b>",
            "colorField": "color",
            "fillAlphas": 1,
            "lineAlpha": 0.1,
            "type": "column",
            "valueField": "in_stock"
        }],

        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "product",
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 30
        },
        "pathToImages": "<?php echo base_url();?>public/plugins/amcharts/images/",
        "amExport": {
            "top": 0,
            "right": 0,
            "buttonColor": '',
            "buttonRollOverColor": '#605ca8',
            "imageFileName": "Products in stock",
            "exportPNG": true,
            "exportJPG": true,
            "exportPDF": true,
            "exportSVG": true
        }
    });
</script>