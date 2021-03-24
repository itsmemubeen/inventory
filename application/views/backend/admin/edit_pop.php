<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="page-header"><?php echo $page_title; ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?admin/dashboard"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active"><a href="<?php echo base_url(); ?>index.php?admin/getClients">Clients</a></li>
        </ol>
    </section>
    <section class="content">
        <!-- Main content -->
        <div class="row">

            <!-- begin col-12 -->
            <div class="col-xs-12">
                <!-- begin panel -->
                <div class="box box-info">
                    <div class="box-header">

                        <h4 class="panel-title">All POP</h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">

                            <table id="data-table" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>POP ID</th>
                                    <th>POP Name</th>
                                    <th>Pop Location</th>
                                    <th>Created By</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                 $pop = $this->db->query('select * from pop ;')->result_array();
                                foreach ($pop as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $row['pop_id']; ?></td>
                                        <td><?php echo $row['pop_name']; ?></td>
                                        <td><?php echo $row['pop_location']; ?></td>
                                        <td><?php echo $row['created_by']; ?></td>
                                        <td><?php echo $row['date']; ?></td>
                                        <td>
                                            <!-- <button
                                                onclick="showMessageModal('<?php echo base_url(); ?>index.php?modal/popup/customer_profile/<?php echo $row['pop_id']; ?>');"
                                                class="btn btn-info btn-icon btn-circle btn-sm">
                                                <i class="fa fa-user"></i>
                                            </button> -->
                                            <button
                                                onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/edit_pop_form/<?php echo $row['pop_id']; ?>');"
                                                class="btn btn-success btn-icon btn-circle btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button
                                                onclick="showDeleteModal('<?php echo base_url(); ?>index.php?admin/getPop/delete/<?php echo $row['pop_id']; ?>');"
                                                class="btn btn-warning btn-icon btn-circle btn-sm">
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
        <!-- /.content --></section>

</div>

<script>
    jQuery(document).ready(function () {
        jQuery("#data-table").dataTable();
    });
</script>

