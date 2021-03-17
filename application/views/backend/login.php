<?php
$system_name = $this->db->get_where('settings', array('type' => 'company_name'))->row()->description;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title><?php echo $system_name; ?> | Login</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="public/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!--    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
    <!-- Theme style -->
    <link rel="stylesheet" href="public/dist/css/AdminLTE.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="public/bootstrap/css/animate.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="public/plugins/iCheck/square/blue.css">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="public/plugins/sweetalert/sweetalert.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box animated bounceIn">
    <div class="login-logo">
        <?php echo $system_name; ?>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to get started</p>
        <?php
        echo form_open(base_url() . 'index.php?login/do_login/', array(
            'class' => 'margin-bottom-0'
        ));
        ?>
        <div class="form-group has-feedback">
            <input type="email" name="email" class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="login-buttons">
            <button type="submit"
                    class="btn btn-success btn-block btn-lg">Sign Me In
            </button>
        </div>
        <div class="m-t-20">
            <a href="<?php echo base_url(); ?>index.php?login/forgot_password">Forgot Password ?</a>
        </div>
        <?php echo form_close(); ?>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.1.4 -->
<script src="public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- SweetAlert -->
<script type="text/javascript" src="public/plugins/sweetalert/sweetalert.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="public/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="public/plugins/iCheck/icheck.min.js"></script>

<?php if ($this->session->flashdata('flash_message') != ""): ?>
    <script>
        swal({
            title: "Error",
            text: "<?php echo $this->session->flashdata('flash_message'); ?>",
            timer: 2000,
            showConfirmButton: false,
            type: 'error'
        });
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('flash_message_pass_reset') != ""): ?>
    <script>
        swal({
            title: "Password Reset !",
            text: "<?php echo $this->session->flashdata('flash_message_pass_reset'); ?>",
            timer: 2000,
            showConfirmButton: false,
            type: 'info'
        });
    </script>
<?php endif; ?>


<script>

    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>