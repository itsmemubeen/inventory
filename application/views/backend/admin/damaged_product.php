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
                <a href="<?php echo base_url(); ?>index.php?admin/damaged_product">
                    Damaged Products
                </a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row" style="margin-left: 1px;">
            <button onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/damaged_product_add');"
                    class="btn btn-success m-r-5">
                <i class="fa fa-plus"></i> Add A Damaged Product
            </button>
        </div>

        <br>

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
                <div class="box box-warning">
                    <div class="box-header">
                        <h4 class="box-title">All Damaged Products</h4>
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
                                    <th>Quantity</th>
                                    <th>Notes</th>
                                    <th>Date</th>
                                    <th>Operations</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                foreach ($damaged_products as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td>
                                            <?php
                                            if ($row['product_id'] > 0)
                                                echo $this->db->get_where('product', array(
                                                    'product_id' => $row['product_id']
                                                ))->row()->serial_number;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row['product_id'] > 0)
                                                echo $this->db->get_where('product', array(
                                                    'product_id' => $row['product_id']
                                                ))->row()->name;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row['product_id'] > 0) {
                                                $product_category_id = $this->db->get_where('product', array(
                                                    'product_id' => $row['product_id']
                                                ))->row()->category_id;

                                                echo $this->db->get_where('category', array(
                                                    'category_id' => $product_category_id
                                                ))->row()->name;


                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row['product_id'] > 0)
                                                echo $currency . ' ' . $this->db->get_where('product', array(
                                                        'product_id' => $row['product_id']
                                                    ))->row()->purchase_price;
                                            ?>
                                        </td>
                                        <td><?php echo $row['quantity']; ?></td>
                                        <td><?php echo $row['note']; ?></td>
                                        <td><?php echo date('d/m/Y', $row['timestamp']); ?></td>
                                        <td>
                                            <button
                                                onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/damaged_product_edit/<?php echo $row['damaged_product_id']; ?>');"
                                                class="btn btn-success btn-icon btn-circle btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button
                                                onclick="showDeleteModal('<?php echo base_url(); ?>index.php?admin/all_damaged_product/delete/<?php echo $row['damaged_product_id']; ?>');"
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
</div><!-- /.content-wrapper -->