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
            <li>
                <a href="<?php echo base_url(); ?>index.php?customer/message">
                    Private Messages
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
                <blockquote>
                    <p>
                        Select A Message To Read
                    </p>
                </blockquote>

            </div>
        </div>


    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->


