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
                <a href="<?php echo base_url(); ?>index.php?admin/write_a_new_message">
                    Write A Message
                </a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="col-md-12">
                    <a href="<?php echo base_url(); ?>index.php?admin/write_a_new_message"
                       class="btn btn-primary btn-block margin-bottom">Compose</a>

                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">From</h3>

                            <div class="box-tools">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div style="display: block;" class="box-body no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <?php
                                $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('user_id');

                                $this->db->where('sender', $current_user);
                                $this->db->or_where('receiver', $current_user);
                                $message_threads = $this->db->get('message_thread')->result_array();
                                foreach ($message_threads as $row):
                                    // defining the user to show
                                    if ($row['sender'] == $current_user)
                                        $user_to_show = explode('-', $row['receiver']);
                                    if ($row['receiver'] == $current_user)
                                        $user_to_show = explode('-', $row['sender']);

                                    $user_to_show_type = $user_to_show[0];
                                    $user_to_show_id = $user_to_show[1];
                                    $message_thread_code = $row['message_thread_code'];

                                    ?>
                                    <li class="active"><a
                                            href="<?php echo base_url(); ?>index.php?admin/message_read/<?php echo $message_thread_code; ?>"><i
                                                class="fa fa-inbox"></i> <?php echo $this->db->get_where($user_to_show_type, array($user_to_show_type . '_id' => $user_to_show_id))->row()->name; ?>
                                            <span class="label <?php if ($user_to_show_type == 'customer') {
                                                echo 'label-success';
                                            } else {
                                                echo 'label-primary';
                                            } ?> pull-right"><?php echo ucfirst($user_to_show_type); ?></span></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->

                </div>

            </div>
            <div class="col-md-8 col-sm-8">
                <!-- begin panel -->
                <div class="box box-primary">

                    <div class="panel-body">
                        <?php
                        echo form_open(base_url() . 'index.php?admin/write_a_new_message/send_new_message/', array(
                            'class' => 'form-horizontal', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
                        ));
                        ?>

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                <select class="form-control selectpicker" data-size="10" data-live-search="true"
                                        data-style="btn-default" name="receiver" required>
                                    <option value="" selected>Select user</option>
                                    <optgroup label="Customer">
                                        <?php foreach ($customers as $row): ?>
                                            <option value="customer-<?php echo $row['customer_id']; ?>">
                                                <?php echo $row['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="Store Manager">
                                        <?php foreach ($sales_staff as $row): ?>
                                            <option value="employee-<?php echo $row['employee_id']; ?>">
                                                <?php echo $row['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                <textarea class="textarea form-control" id="wysihtml5" name="message_body" rows="15"
                                          required></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-sm-6">
                                <button type="submit" class="btn btn-microsoft">Send</button>
                            </div>
                        </div>

                        <?php echo form_close(); ?>
                    </div>
                </div>
                <!-- end panel -->
            </div>
        </div>


    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    $(document).ready(function () {
        $("#wysihtml5").wysihtml5();
    });
</script>