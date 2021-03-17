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
                <a href="<?php echo base_url(); ?>index.php?admin/getAllProducts">
                    Product
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php?admin/add_product_category">
                    Category
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php?admin/add_product_sub_category">
                    Sub Category
                </a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row" style="margin-left: 1px;">
            <button onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/product_sub_category_add');"
                    class="btn btn-success m-r-5">
                <i class="fa fa-plus"></i> Add New Sub Category
            </button>
        </div>

        <br>

        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h4 class="box-title">Product Sub Categories</h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">

                            <table id="data-table" class="table table-striped table-bordered nowrap display"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Operations</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                foreach ($sub_categories as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td>
                                            <?php
                                            if ($row['category_id'] > 0)
                                                echo $this->db->get_where('sub_category', array(
                                                    'sub_category_id' => $row['sub_category_id']
                                                ))->row()->name;
                                            ?>
                                        </td>
                                        <td><?php echo $row['description']; ?></td>
                                        <td>
                                            <button
                                                onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/product_sub_category_edit/<?php echo $row['sub_category_id']; ?>');"
                                                class="btn btn-success btn-icon btn-circle btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button
                                                onclick="showDeleteModal('<?php echo base_url(); ?>index.php?admin/add_product_sub_category/delete/<?php echo $row['sub_category_id']; ?>');"
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