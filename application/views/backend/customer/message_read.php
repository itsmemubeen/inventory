<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $page_title; ?>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>index.php?customer/dashboard">
                    Dashboard
                </a>
            </li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4 col-sm-4">


                <div class="col-md-12">
                    <a href="<?php echo base_url(); ?>index.php?customer/message_new"
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
                                            href="<?php echo base_url(); ?>index.php?customer/message_read/<?php echo $message_thread_code; ?>"><i
                                                class="fa fa-inbox"></i> <?php echo $this->db->get_where($user_to_show_type, array($user_to_show_type . '_id' => $user_to_show_id))->row()->name; ?>
                                            <span class="label <?php if ($user_to_show_type == 'customer') {
                                                echo 'label-success';
                                            } else {
                                                echo 'label-primary';
                                            } ?> pull-right"><?php echo $user_to_show_type; ?></span></a>
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
                <div class="panel panel-inverse" data-sortable-id="ui-media-object-4">
                    <div class="panel-heading">

                        <h4 class="panel-title">
                            Messages
                        </h4>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group list-group-lg no-radius list-email">
                            <?php
                            $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
                            foreach ($messages as $row):

                                $sender = explode('-', $row['sender']);
                                $sender_account_type = $sender[0];
                                $sender_id = $sender[1];
                                ?>
                                <li class="list-group-item default">
                                    <a href="#" class="email-user">
                                        <img class="img-circle" height="50" width="50"
                                             src="<?php echo $this->crud_model->get_image_url($sender_account_type, $sender_id); ?>"/>
                                    </a>
                                    <hr>

                                    <div class="email-info">
                                        <span class="email-time"><?php echo date("d M, Y", $row['timestamp']); ?></span>
                                        <h5 class="email-title">
                                            <?php echo $this->db->get_where($sender_account_type, array($sender_account_type . '_id' => $sender_id))->row()->name; ?>
                                        </h5>

                                        <p class="email-desc">
                                            <?php echo $row['message_body']; ?>
                                        </p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <br><br>
                        <?php
                        echo form_open(base_url() . 'index.php?customer/message_reply/' . $message_thread_code, array(
                            'class' => 'form-horizontal', 'data-parsley-validate' => 'true', 'enctype' => 'multipart/form-data'
                        ));
                        ?>

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                <textarea class="textarea form-control" id="wysihtml5" name="message_body" rows="15"
                                          required></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-sm-6">
                                <button type="submit" class="btn btn-success">Reply Message</button>
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