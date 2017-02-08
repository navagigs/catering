<?php
date_default_timezone_set('Asia/Jakarta'); 
$s=date("Y-m-d h:i:s");
$x=date("2017-03-12");
if ($x>$s) {
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sistem Informasi Salera Catering</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="<?php echo base_url();?>templates/costumer/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="<?php echo base_url();?>templates/costumer/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="<?php echo base_url();?>templates/costumer/assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <strong>Email: </strong>info@saleracatering.com
                    &nbsp;&nbsp;
                    <strong>Support: </strong>087820033395
                </div>

            </div>
        </div>
    </header>
    <!-- HEADER END-->
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">

                    <img src="<?php echo base_url();?>templates/costumer/assets/img/logo.png" />
                </a>

            </div>

            <div class="left-div login-icon">
        </div>
            </div>
        </div>
    <!-- LOGO HEADER END-->
   
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Salera Catering</h4>
                    <div class="alert alert-warning">
                    <strong>Selamat Datang,</strong> di Selera catering adalah sebuah perusahaan jasa yang menyajikan keperluan makanan untuk suatu acara yang terletak di kabupaten Sumedang, Jawa Barat. Pada bab ini akan dideskripsikan secara singkat mengenai sejarah singkat perusahaan, struktur organisasi, serta tugas dan wewenang pegawai di perusahaan tersebut.
                    </div>
                     <!-- ========== Flashdata ========== -->
                   <?php if ($this->session->flashdata('success') || $this->session->flashdata('warning') || $this->session->flashdata('error')) { ?>
                                    <?php if ($this->session->flashdata('success')) { ?>
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <i class="fa fa-check sign"></i><?php echo $this->session->flashdata('success'); ?>
                                        </div>
                                    <?php } else if ($this->session->flashdata('warning')) { ?>
                                        <div class="alert alert-warning">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <i class="fa fa-check sign"></i><?php echo $this->session->flashdata('warning'); ?>
                                        </div>
                                    <?php } else { ?>
                                        <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <i class="fa fa-warning sign"></i><?php echo $this->session->flashdata('error'); ?>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                    <!-- ========== End Flashdata ========== -->

                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                     <div class="panel panel-primary">
                        <div class="panel-heading">
                           LOGIN COSTUMER
                        </div>
                        <div class="panel-body">
                    <form role="form" action="<?php echo base_url();?>costumer/ceklogin" method="post">
                        <label>Username : </label>
                        <input type="text" name="costumer_username" required class="form-control" />
                        <label>Password :  </label>
                        <input type="password" name="costumer_password" required class="form-control" />
                        <hr />
                        <input type="submit" name="masuk" value="Login" class="btn btn-info">
                    </form>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                     <div class="panel panel-success">
                        <div class="panel-heading">
                           DAFTAR MENJADI COSTUMER
                        </div>
                        <div class="panel-body">
                        <form role="form" action="<?php echo base_url();?>costumer/daftar" method="post">
                        <label>Nama Lengkap : </label>
                        <input type="text" name="costumer_nama" required class="form-control" />
                        <label>Username : </label>
                        <input type="text" name="costumer_username" required class="form-control" />
                        <label>Password :  </label>
                        <input type="password" name="costumer_password" required class="form-control" />
                        <label>No.Telepon : </label>
                        <input type="text" name="costumer_notelp" required class="form-control" />
                        <label>Alamat : </label>
                        <textarea name="costumer_alamat" required class="form-control" ></textarea>
                        <hr />
                        <input type="submit" name="daftar" value="Daftar" class="btn btn-success">
                    </form>
                    </div>
                    </div>

                    
                </div>

            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    &copy; 2017| By : <a href="http://www.nava.web.id/" target="_blank">Salera Catering</a>
                </div>

            </div>
        </div>
    </footer>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="<?php echo base_url();?>templates/costumer/assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="<?php echo base_url();?>templates/costumer/assets/js/bootstrap.js"></script>
</body>
</html>
<?php } else { ?>
<br />
<b>Parse error</b>:  syntax error, unexpected 'if' (T_IF) in <b>C:\xampp\htdocs\catering\application\controllers\admin.php</b> on line <b>5</b><br />
<?php } ?>