<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $page_title; ?>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>index.php?e/dashboard">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php?employee/customer">
                    Customer
                </a>
            </li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row" style="margin-left: 1px;">
            <button onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/customer_add');"
                    class="btn btn-info m-r-5">
                <i class="fa fa-plus"></i> Add New Customer
            </button>
        </div>

        <br>

        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title">All Customers</h4>
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
                                    <th>Operations</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                foreach ($customers as $row):
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
                                                <i class="fa fa-user"></i>
                                            </button>
                                            <button
                                                onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/customer_edit/<?php echo $row['customer_id']; ?>');"
                                                class="btn btn-success btn-icon btn-circle btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button
                                                onclick="showDeleteModal('<?php echo base_url(); ?>index.php?employee/customer/delete/<?php echo $row['customer_id']; ?>');"
                                                class="btn btn-danger btn-icon btn-circle btn-sm">
                                                <i class="fa fa-trash"></i>
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
    </section>
    <!-- /.content -->
</div>