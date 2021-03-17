<?php
$update = $this->db->get_where('product', array(
    'product_id' => $param2
))->result_array();
foreach ($update as $row):
    ?>

    <?php
    echo form_open(base_url() . 'index.php?admin/getAllProducts/edit/' . $row['product_id'], array(
        'class' => 'form-horizontal form-bordered', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
    ));
    ?>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Image
        </label>

        <div class="col-md-6 col-sm-6">
            <img style="height: 50% ; width: 50%;"
                 src="<?php echo $this->crud_model->get_image_url('product', $row['product_id']); ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Product Code
        </label>

        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="serial_number" required
                   placeholder="" value="<?php echo $row['serial_number']; ?>" readonly/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Product Name
        </label>

        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="name" required
                   placeholder="Product Name" value="<?php echo $row['name']; ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Category
        </label>

        <div class="col-md-6 col-sm-6">
            <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-default"
                    name="category_id">
                <option value="" selected>Select Product Category</option>
                <?php
                $categories = $this->db->get('category')->result_array();
                foreach ($categories as $row2):
                    ?>
                    <option value="<?php echo $row2['category_id']; ?>"
                        <?php if ($row['category_id'] == $row2['category_id'])
                            echo 'selected'; ?>>
                        <?php echo $row2['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Sub Category
        </label>

        <div class="col-md-6 col-sm-6">
            <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-default"
                    name="sub_category_id">
                <option value="" selected>Select Product Sub Category</option>
                <?php
                $sub_categories = $this->db->get('sub_category')->result_array();
                foreach ($sub_categories as $row3):
                    ?>
                    <option value="<?php echo $row3['sub_category_id']; ?>"
                        <?php if ($row['sub_category_id'] == $row3['sub_category_id'])
                            echo 'selected'; ?>>
                        <?php echo $row3['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Purchase Price
        </label>

        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="number" name="purchase_price" required
                   placeholder="Product Purchase Price" value="<?php echo $row['purchase_price']; ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Selling Price
        </label>

        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="number" name="selling_price" required
                   placeholder="Product Selling Price" value="<?php echo $row['selling_price']; ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Notes
        </label>

        <div class="col-md-6 col-sm-6">
            <textarea class="form-control" name="note" rows="3"><?php echo $row['note']; ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Image
        </label>

        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="file" name="userfile"
                   placeholder="Product Image"/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4"></label>

        <div class="col-md-6 col-sm-6">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </div>

    <?php echo form_close(); ?>
<?php endforeach; ?>


<script type="text/javascript">
    $(".selectpicker").selectpicker();
</script>