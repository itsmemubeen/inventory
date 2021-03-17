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
                <a href="<?php echo base_url(); ?>index.php?admin/message">
                    Message
                </a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <a href="<?php echo base_url(); ?>index.php?admin/write_a_new_message"
                   class="btn btn-success p-l-40 p-r-40 btn-sm">
                    Write A Message
                </a>
                <br><br>
                <ul class="nav nav-pills nav-stacked nav-sm">
                    <?php
                    $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('user_id');

                    $this->db->where('sender', $current_user);
                    $this->db->or_where('receiver', $current_user);
                    $message_threads = $this->db->get('message_thread')->result_array();
                    foreach ($message_threads as $row):
                        if ($row['sender'] == $current_user)
                            $user_to_show = explode('-', $row['receiver']);
                        if ($row['receiver'] == $current_user)
                            $user_to_show = explode('-', $row['sender']);

                        $user_to_show_type = $user_to_show[0];
                        $user_to_show_id = $user_to_show[1];
                        $message_thread_code = $row['message_thread_code'];

                        ?>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php?admin/message_read/<?php echo $message_thread_code; ?>">
                                <i class="fa fa-fw m-r-5 fa-circle text-success"></i>
                                <?php echo $this->db->get_where($user_to_show_type, array($user_to_show_type . '_id' => $user_to_show_id))->row()->name; ?>
                                <span class="label label-default f-s-10" style="margin-left: 15px;">
                			<?php echo $user_to_show_type; ?>
                		</span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>



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