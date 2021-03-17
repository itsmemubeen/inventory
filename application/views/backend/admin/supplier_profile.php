

<?php
    $currency_code   =   $this->db->get_where('settings' , array(
                        'type' => 'currency'
                ))->row()->description;
	$supplier_profile	=	$this->db->get_where('supplier' , array(
					'supplier_id' => $param2
				))->result_array();
	foreach ($supplier_profile as $row):
?>

<div class="row">
	<div class="col-md-4 col-sm-4">
		<!-- begin panel -->
        <div class="panel panel-success" data-sortable-id="ui-widget-1">
            <div class="panel-heading">
                <h4 class="panel-title">
                	Basic Information
                </h4>
            </div>
            <div class="panel-body">

                <img class="thumbnail img-responsive"
                     src="<?php echo $this->crud_model->get_image_url('supplier' , $row['supplier_id']);?>">


                <div class="list-group">
                    <a href="#" class="list-group-item active">
                        <?php echo $row['company'];?>
                    </a>
                    <a href="#" class="list-group-item"><i class="fa fa-user"></i>  <?php echo $row['name'];?> </a>
                    <a href="#" class="list-group-item"><i class="fa fa-envelope"></i>  <?php echo $row['email'];?> </a>
                    <a href="#" class="list-group-item"><i class="fa fa-phone"></i>  <?php echo $row['phone'];?></a>

                </div>


            </div>
        </div>
        <!-- end panel -->
	</div>

	<div class="col-md-8 col-sm-8">
		<!-- begin panel -->
        <div class="panel panel-success" data-sortable-id="ui-widget-1">
            <div class="panel-heading">
                <h4 class="panel-title">
                    Purchase History From <?php echo $row['name'];?>
                </h4>
            </div>
            <div class="panel-body">
               <div class="table-responsive">
                   <table class="table table-bordered table-striped">
                       <thead>
                           <tr>
                               <td>#</td>
                               <td>Purchase Code</td>
                               <td>Total Amount</td>
                               <td>Date</td>
                           </tr>
                       </thead>
                       <tbody>
                       <?php 
                            $count = 1;
                            $purchases_from_supplier    =   $this->db->get_where('purchase' , array('supplier_id' => $row['supplier_id']))->result_array();
                            foreach ($purchases_from_supplier as $row2):
                        ?>
                           <tr>
                               <td><?php echo $count++;?></td>
                               <td><?php echo $row2['purchase_code'];?></td>
                               <td>
                                   <?php
                                        echo $currency_code . ' ' . $this->db->get_where('payment' , array('purchase_id' => $row2['purchase_id']))->row()->amount;
                                   ?>
                               </td>
                               <td><?php echo date('dS M, Y' , $row2['timestamp']);?></td>
                           </tr>
                        <?php endforeach;?>
                       </tbody>
                   </table>
               </div> 
            </div>
        </div>
        <!-- end panel -->
	</div>


</div>


<?php endforeach;?>
