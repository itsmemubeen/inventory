<div class="content-wrapper">
    <section class="content-header">
        <h1 class="page-header"><?php echo $page_title; ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?admin/dashboard"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active"><a href="<?php echo base_url(); ?>index.php?admin/getpop">POP</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-body">
    <?php 
    echo form_open(base_url() . 'index.php?admin/getpop/create/' , array(
        'class' => 'form-horizontal form-bordered' , 'data-parsley-validate' => 'true' , 'enctype' => 'multipart/form-data'
    ));
?>
    <!-- <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Client ID
        </label>
        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="customer_code" required
                placeholder="" value="<?php echo substr(md5(rand(100000000, 200000000)), 0, 10);?>" readonly />
        </div>
    </div> -->

    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Form ID
        </label>
        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="form_id" required
                placeholder="Form ID"/>
        </div>
    </div>
<div class="form-group">
        <label class="control-label col-md-4 col-sm-4">
            Product ID
        </label>
        <div class="col-md-6 col-sm-6">
            <input class="form-control" type="text" name="product_id" required
                placeholder="Product ID"/>
        </div>

        <input type="hidden" name="create" value="admin">
    </div>
    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4"></label>
        <div class="col-md-2 col-sm-2">
            <button type="info" class="btn btn-success">Show Detail</button>
        </div>
        <div class="col-md-2 col-sm-2">
            <button type="submit" class="btn btn-success">Back Product</button>
        </div>
    </div>
<?php echo form_close();?>
</div>
</div>
</div>
</div>
</section>
</div>