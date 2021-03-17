<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="page-header"><?php echo $page_title; ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?admin/dashboard"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active"><a href="<?php echo base_url(); ?>index.php?admin/getVendors">Vendors</a></li>
        </ol>
    </section>
    <section class="content"><!--    New Clients Add Button-->
        <div class="row" style="margin-left: 1px;">
            <button onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/vendor_add');"
                    class="btn btn-instagram m-r-5">
                <i class="fa fa-plus"></i> Add New Vendors
            </button>
        </div>
        <br>
        <!--End New Clients Add Button-->
        <!-- Main content -->
        <div class="row">

            <!-- begin col-12 -->
            <div class="col-xs-12">
                <!-- begin panel -->
                <div class="box box-info">
                    <div class="box-header">

                        <h4 class="panel-title">All Vendor</h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">

                            <table id="data-table" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <!-- <th>Email</th> -->
                                    <th>CNIC/NTN</th>
                                    <th>Sales</th>
                                    <th>With Holding Tax(%)</th>
                                    <th>Sales Tax(%)</th>
                                    <th>Operation</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                foreach ($vendors as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['cnic/ntn']; ?></td>
                                        <td><?php echo $row['sales']; ?></td>
                                        <td><?php echo $row['whtax']; ?></td>
                                        <td><?php echo $row['sales_tax']; ?></td>
                                        <td>
                                            <button
                                                onclick="showMessageModal('<?php echo base_url(); ?>index.php?modal/popup/vendor_profile/<?php echo $row['id']; ?>');"
                                                class="btn btn-info btn-icon btn-circle btn-sm">
                                                <i class="fa fa-user"></i>
                                            </button>
                                            <button
                                                onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/vendor_edit/<?php echo $row['id']; ?>');"
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
                <!-- end panel -->
            </div>
            <!-- end col-12 -->
        </div>
        <!-- /.content --></section>

</div>

<script>
    jQuery(document).ready(function () {
        jQuery("#data-table").dataTable();
    });
</script>

