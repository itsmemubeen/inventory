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
                <a href="<?php echo base_url(); ?>index.php?admin/add_a_new_order">
                    Place New Order
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

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills">
                    <li class="active">
                        <a href="#nav-pills-tab-1" data-toggle="tab">
                            <i class=" fa fa-spinner"></i> Partially Paid
                        </a>
                    </li>
                    <li>
                        <a href="#nav-pills-tab-2" data-toggle="tab">
                            <i class=" fa fa-thumbs-up"></i> Approved
                        </a>
                    </li>
                    <li>
                        <a href="#nav-pills-tab-3" data-toggle="tab">
                            <i class=" fa fa-thumbs-down"></i> Rejected
                        </a>
                    </li>
                    <li>
                        <a href="#nav-pills-tab-4" data-toggle="tab">
                            <i class=" fa fa-spinner"></i> Product Sent Full Payment Due
                        </a>
                    </li>
                </ul>
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-header">All Orders</div>
                        <div class="box-body">
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="nav-pills-tab-1">
                                    <div class="table-responsive">

                                        <table id="data-table" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Form Code</th>
                                    <th>Employee ID</th>
                                    <!-- <th>Email</th> -->
                                    <th>Solution Type</th>
                                    <th>Product</th>
                                    <th>Issue Date</th>
                                    <th>Operation</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                foreach ($inventory as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $row['customer_code']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <!-- <td><?php echo $row['email']; ?></td> -->
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><?php echo $row['client_pop']; ?></td>
                                        <td>
                                            <button
                                                onclick="showMessageModal('<?php echo base_url(); ?>index.php?modal/popup/customer_profile/<?php echo $row['customer_id']; ?>');"
                                                class="btn btn-info btn-icon btn-circle btn-sm">
                                                <i class="fa fa-user"></i>
                                            </button>
                                            <button
                                                onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/customer_edit/<?php echo $row['customer_id']; ?>');"
                                                class="btn btn-success btn-icon btn-circle btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <!-- <button
                                                onclick="showDeleteModal('<?php echo base_url(); ?>index.php?admin/getClients/delete/<?php echo $row['customer_id']; ?>');"
                                                class="btn btn-warning btn-icon btn-circle btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button> -->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                                    </div>
                                </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    jQuery(document).ready(function () {
        jQuery("#data-table").DataTable();
        jQuery("#data-table1").DataTable();
        jQuery("#data-table2").DataTable();
        jQuery("#data-table3").DataTable();
    });
</script>