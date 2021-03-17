<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <h1 class="page-header"><?php echo $page_title; ?></h1>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>index.php?admin/dashboard">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php?admin/product">
                    Product
                </a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <?php if ($this->session->flashdata('flash_message')): ?>
                    <script>
                        swal({
                            title: "Done",
                            text: "<?php echo $this->session->flashdata('flash_message'); ?>",
                            timer: 1500,
                            showConfirmButton: false,
                            type: 'success'
                        });
                    </script>
                <?php endif; ?>
                <!-- begin panel -->
                <div class="box box-danger">
                    <div class="box-header">

                        <h4 class="box-title">All Products</h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">

                            <table id="data-table" class="table table-striped table-bordered nowrap display"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Purchase Price</th>
                                    <th>Selling Price</th>
                                    <th>In Stock</th>
                                    <th>Operations</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                foreach ($deleted_products as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $row['serial_number']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td>
                                            <?php
                                            if ($row['category_id'] > 0)
                                                echo $this->db->get_where('category', array(
                                                    'category_id' => $row['category_id']
                                                ))->row()->name;
                                            ?>
                                        </td>
                                        <td><?php echo $currency . ' ' . $row['purchase_price']; ?></td>
                                        <td><?php echo $currency . ' ' . $row['selling_price']; ?></td>
                                        <td><?php echo $row['stock_quantity']; ?></td>
                                        <td>
                                            <button
                                                onclick="showMessageModal('<?php echo base_url(); ?>index.php?modal/popup/product_detail/<?php echo $row['product_id']; ?>');"
                                                class="btn btn-info btn-icon btn-circle btn-sm">
                                                <i class="fa fa-info"></i>
                                            </button>
                                            <a class="btn btn-success btn-icon btn-circle btn-sm"
                                               href="<?php echo base_url(); ?>index.php?admin/dproduct/restore/<?php echo $row['product_id']; ?>">
                                                <i class="fa fa-refresh fa-spin"></i> Restore</a>
                                            <button
                                                onclick="showDeleteModal('<?php echo base_url(); ?>index.php?admin/dproduct/delete/<?php echo $row['product_id']; ?>');"
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


    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->