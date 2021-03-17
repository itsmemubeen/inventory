<?php
$update = $this->db->get_where('damaged_product', array(
    'damaged_product_id' => $param2
))->result_array();
foreach ($update as $row):
    ?>

    <?php
    echo form_open(base_url() . 'index.php?admin/all_damaged_product/edit/' . $row['damaged_product_id'], array(
        'class' => 'form-horizontal form-bordered', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
    ));
    ?>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Category
        </label>

        <div class="col-md-6 col-sm-6">
            <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-default"
                    name="product_id">
                <option value="" selected>Select Product</option>
                <?php
                $products = $this->db->get('product')->result_array();
                foreach ($products as $row2):
                    ?>
                    <option value="<?php echo $row2['product_id']; ?>"
                        <?php if ($row['product_id'] == $row2['product_id'])
                            echo 'selected'; ?>>
                        <?php echo $row2['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Damaged Quantity
        </label>

        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="number" name="quantity" required
                   placeholder="Damaged product Quantity" value="<?php echo $row['quantity']; ?>"/>
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
        </label>

        <div class="col-md-6 col-sm-6">
            <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-default"
                    name="check">
                <option value="" selected>Decrease From Stock ?</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4"></label>

        <div class="col-md-6 col-sm-6">
            <button type="submit" class="btn btn-success">Update Damaged Product Information</button>
        </div>
    </div>

    <?php echo form_close(); ?>
<?php endforeach; ?>


<script type="text/javascript">
    $(".selectpicker").selectpicker();
</script>