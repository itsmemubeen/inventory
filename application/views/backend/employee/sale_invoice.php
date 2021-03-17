<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $page_title; ?>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url();?>index.php?employee/dashboard">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="<?php echo base_url();?>index.php?employee/sale_add">
                    New Sale
                </a>
            </li>
            <li>
                <a href="<?php echo base_url();?>index.php?employee/sale_invoice">
                    Sale Invoices
                </a>
            </li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title">Sale Invoices</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">

                            <table id="data-table" class="table table-striped table-bordered nowrap display" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Operations</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count	=	1;
                                foreach ($invoices as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $count++;?></td>
                                        <td><?php echo $row['invoice_code'];?></td>
                                        <td>
                                            <?php echo $this->db->get_where('customer' , array('customer_id' => $row['customer_id']))->row()->name;?>
                                        </td>
                                        <td><?php echo date('dS M, Y' , $row['timestamp']);?></td>
                                        <td>
                                            <a href="<?php echo base_url();?>index.php?employee/sale_invoice_view/<?php echo $row['invoice_code'];?>"
                                               class="btn btn-success btn-xs">
                                                <i class="fa fa-eye"></i>
                                                View Sale Invoices
                                            </a>
                                            <?php if ($row['due'] != 0):?>
                                                <a href="<?php echo base_url();?>index.php?employee/take_sale_payment/<?php echo $row['invoice_code'];?>"
                                                   class="btn btn-info btn-xs">
                                                    <i class="fa fa-money"></i>
                                                    Receive Payment
                                                </a>
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-12 -->
        </div>
    </section>
    <!-- /.content -->
</div>