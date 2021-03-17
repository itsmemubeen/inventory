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
                <a href="<?php echo base_url(); ?>index.php?admin/add_a_new_sale">
                    Make A Sale
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php?admin/view_all_sale_invoices">
                    All Sales Invoice
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
                <div class="box box-primary">
                    <div class="box-header">

                        <h4 class="box-title">Sales Invoice</h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">

                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Code</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Operations</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                foreach ($invoices as $row):
                                    ?>
                                    <tr class="text-center">
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $row['invoice_code']; ?></td>
                                        <td>
                                            <?php echo $this->db->get_where('customer', array('customer_id' => $row['customer_id']))->row()->name; ?>
                                        </td>
                                        <td><?php echo date('dS M, Y', $row['timestamp']); ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>index.php?admin/sale_invoice_view/<?php echo $row['invoice_id']; ?>"
                                               class="btn btn-success btn-xs">
                                                <i class="fa fa-eye"></i>
                                                View Sales Invoice
                                            </a>
                                            <?php if ($row['due'] != 0): ?>
                                                <a href="<?php echo base_url(); ?>index.php?admin/take_sale_payment/<?php echo $row['invoice_id']; ?>"
                                                   class="btn btn-info btn-xs">
                                                    <i class="fa fa-money"></i>
                                                    Take Payment
                                                </a>
                                            <?php endif; ?>

                                            <a href="<?php echo base_url(); ?>index.php?admin/generate_sales_invoice/<?php echo $row['invoice_id']; ?>"
                                               class="btn btn-microsoft btn-xs">
                                                <i class="fa fa-download"></i>
                                                Download Sales Invoice
                                            </a>
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
            <!-- end col-12 -->
        </div>


    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    jQuery(document).ready(function () {
        jQuery("#data-table").dataTable();
    });
</script>