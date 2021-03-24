<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="page-header"><?php echo $page_title; ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?admin/dashboard"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active"><a href="<?php echo base_url(); ?>index.php?admin/customer">Customer</a></li>
        </ol>
    </section>
    <section class="content">
        <!-- Main content -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title">All Deleted Customers</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">

                            <table id="data-table" class="table table-striped table-bordered nowrap display"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Operation</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                foreach ($deleted_customers as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $row['customer_code']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td>
                                            <button
                                                onclick="showMessageModal('<?php echo base_url(); ?>index.php?modal/popup/customer_profile/<?php echo $row['customer_id']; ?>');"
                                                class="btn btn-info btn-icon btn-circle btn-sm">
                                                <i class="fa fa-user"></i> View
                                            </button>
                                            <a class="btn btn-success btn-icon btn-circle btn-sm"
                                               href="<?php echo base_url(); ?>index.php?admin/dcustomer/restore/<?php echo $row['customer_id']; ?>">
                                                <i class="fa fa-refresh fa-spin"></i> Restore</a>
                                            <button
                                                onclick="showDeleteModal('<?php echo base_url(); ?>index.php?admin/dcustomer/delete/<?php echo $row['customer_id']; ?>');"
                                                class="btn btn-danger btn-icon btn-circle btn-sm">
                                                <i class="fa fa-trash"></i> Delete Permanently
                                            </button>
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
        <!-- /.content -->
    </section>

</div>

<script>
    jQuery(document).ready(function () {
        jQuery("#data-table").dataTable();
    });
</script>