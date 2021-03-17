<?php
echo form_open(base_url() . 'index.php?admin/all_damaged_product/create/', array(
    'class' => 'form-horizontal form-bordered', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
));
?>

<div class="form-group">
    <label class="control-label col-md-4 col-sm-4">
        Category
    </label>

    <div class="col-md-6 col-sm-6">
        <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white"
                name="product_id">
            <option value="" selected>Select Product</option>
            <?php
            $products = $this->db->get('product')->result_array();
            foreach ($products as $row):
                ?>
                <option value="<?php echo $row['product_id']; ?>"><?php echo $row['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-4 col-sm-4">
        Damage Quantity
    </label>

    <div class="col-md-6 col-sm-6">
        <input class="form-control" type="number" name="quantity" required
               placeholder="Damaged Product Quantity"/>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-4 col-sm-4">
        Notes
    </label>

    <div class="col-md-6 col-sm-6">
        <textarea class="form-control" name="note" rows="3"></textarea>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-4 col-sm-4">
    </label>

    <div class="col-md-6 col-sm-6">
        <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white"
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
        <button type="submit" class="btn btn-success">Save Damaged Product</button>
    </div>
</div>

<?php echo form_close(); ?>

<script type="text/javascript">
    $(".selectpicker").selectpicker();
</script>