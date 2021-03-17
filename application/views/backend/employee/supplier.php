<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $page_title; ?>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url();?>index.php?admin/dashboard">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="<?php echo base_url();?>index.php?admin/supplier">
                    Suppliers
                </a>
            </li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row" style="margin-left: 1px;">
            <button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/supplier_add');"
                    class="btn btn-success m-r-5">
                <i class="fa fa-plus"></i> Add A Supplier
            </button>
        </div>

        <br>
        <!-- new supplier addition link -->

        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Suppliers List</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">

                            <table id="data-table" class="table table-striped table-bordered nowrap display" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Company</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Operations</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count	=	1;
                                foreach ($suppliers as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $count++;?></td>
                                        <td><?php echo $row['company'];?></td>
                                        <td><?php echo $row['name'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        <td><?php echo $row['phone'];?></td>
                                        <td>
                                            <button onclick="showMessageModal('<?php echo base_url();?>index.php?modal/popup/supplier_profile/<?php echo $row['supplier_id']; ?>');"
                                                    class="btn btn-info btn-icon btn-circle btn-sm">
                                                <i class="fa fa-user"></i>
                                            </button>
                                            <button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/supplier_edit/<?php echo $row['supplier_id']; ?>');"
                                                    class="btn btn-success btn-icon btn-circle btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button onclick="showDeleteModal('<?php echo base_url();?>index.php?employee/supplier/delete/<?php echo $row['supplier_id']; ?>');"
                                                    class="btn btn-danger btn-icon btn-circle btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
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