<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url("assets/admin/vendor/fontawesome-free/css/all.min.css"); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url("assets/admin/css/sb-admin-2.min.css"); ?>" rel="stylesheet">

</head>

<body class="bg-gradient-light" style="background-image: url('<?= base_url('assets/image/' . $profile->gambar) ?>');">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img width="75%" style="padding-left: 100px; padding-top: 100px; " src="<?= base_url('assets/image/' . $profile->logo) ?>">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">E-rapor</h1>
                                        <span><?= $profile->title_web ?></span>
                                    </div>
                                    <form class="user" action="<?php echo base_url('login/do_login') ?>" method="post">
                                        <br>
                                        <?php echo $this->session->flashdata('gagal') ?>
                                        <br>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" name="username" placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password" required>
                                        </div>
                                        <br>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Login">

                                        <br>
                                        <br>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url("assets/admin/vendor/jquery/jquery.min.js"); ?>></script>
    <script src=" <?php echo base_url("assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"); ?>></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url("assets/admin/vendor/jquery-easing/jquery.easing.min.js"); ?>></script>

    <!-- Custom scripts for all pages-->
    <script src=" <?php echo base_url("assets/admin/js/sb-admin-2.min.js"); ?>></script>

</body>

</html>