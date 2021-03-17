<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <h1 class="page-header"><?php echo $page_title; ?></h1>
        </h1>
        <!-- new product addition link -->
        <div class="row" style="margin-left: 1px;">
            <button onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/product_add');"
                    class="btn btn-success m-r-5">
                <i class="fa fa-plus"></i> Add New Product
            </button>
        </div>

        <br>
        <!-- new product addition link -->
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
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title">All Products</h4>
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
                                    <th>Category</th>
                                    <th>Purchase Price</th>
                                    <th>Selling Price</th>
                                    <th>In Stock</th>
                                    <th>Total Stock Price</th>
                                    <th>Operations</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                foreach ($products as $row):
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
                                        <td><?php echo $row['purchase_price'] * $row['stock_quantity'] . ' ' . $currency; ?></td>
                                        <td>
                                            <button
                                                onclick="showMessageModal('<?php echo base_url(); ?>index.php?modal/popup/product_detail/<?php echo $row['product_id']; ?>');"
                                                class="btn btn-info btn-icon btn-circle btn-sm">
                                                <i class="fa fa-info"></i>
                                            </button>
                                            <button
                                                onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/product_edit/<?php echo $row['product_id']; ?>');"
                                                class="btn btn-success btn-icon btn-circle btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button
                                                onclick="showDeleteModal('<?php echo base_url(); ?>index.php?admin/product/delete/<?php echo $row['product_id']; ?>');"
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