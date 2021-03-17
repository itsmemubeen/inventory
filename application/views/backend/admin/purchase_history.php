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
                    New Purchase
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php?admin/view_all_purchase_history">
                    Purchase History
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

                        <h4 class="box-title">Purchase History</h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">

                            <table id="data-table" class="table table-striped table-bordered nowrap display"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Supplier</th>
                                    <th>Date</th>
                                    <th>Operations</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                foreach ($purchases as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $row['purchase_code']; ?></td>
                                        <td>
                                            <?php echo $this->db->get_where('vendors', array('id' => $row['supplier_id']))->row()->name; ?>
                                        </td>
                                        <td><?php echo date('dS M, Y', $row['timestamp']); ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>index.php?admin/purchase_invoice_view/<?php echo $row['purchase_id']; ?>"
                                               class="btn btn-success btn-xs">
                                                <i class="fa fa-eye"></i>
                                                View Purchase Invoice
                                            </a> <?php if ($row['due'] != 0): ?>
                                                <a href="<?php echo base_url(); ?>index.php?admin/make_purchase_payment/<?php echo $row['purchase_id']; ?>"
                                                   class="btn btn-adn btn-xs">
                                                    <i class="fa fa-money"></i>
                                                    Make Payment
                                                </a>
                                            <?php endif; ?>
<!--                                            <a href="--><?php //echo base_url(); ?><!--index.php?admin/generate_purchase_invoice/--><?php //echo $row['purchase_id']; ?><!--"-->
<!--                                               class="btn btn-bitbucket btn-xs">-->
<!--                                                <i class="fa fa-download"></i>-->
<!--                                                Download Purchase Invoice-->
<!--                                            </a>-->
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