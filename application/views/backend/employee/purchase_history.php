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
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title">Purchase History</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">

                            <table id="data-table" class="table table-striped table-bordered nowrap display"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Supplier</th>
                                    <th>Date</th>
                                    <th>Operation</th>
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
                                            <?php echo $this->db->get_where('supplier', array('supplier_id' => $row['supplier_id']))->row()->name; ?>
                                        </td>
                                        <td><?php echo date('dS M, Y', $row['timestamp']); ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>index.php?employee/purchase_invoice_view/<?php echo $row['purchase_code']; ?>"
                                               class="btn btn-success btn-xs">
                                                <i class="fa fa-eye"></i>
                                                View Purchase Invoice
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
</div>