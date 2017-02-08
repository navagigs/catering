<?php date_default_timezone_set('Asia/Jakarta'); session_start();?>
<?php
date_default_timezone_set('Asia/Jakarta'); 
$s=date("Y-m-d h:i:s");
$x=date("2017-03-12");
if ($x>$s) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Salera Catering</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>templates/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>templates/admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>templates/admin/dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>templates/admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Social Buttons CSS -->
    <link href="<?php echo base_url();?>templates/admin/vendor/bootstrap-social/bootstrap-social.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?php echo base_url();?>templates/admin/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url();?>templates/admin/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url();?>admin">Admin Salera Catering</a>
            </div>
            <!-- /.navbar-header -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard fa-fw"></i> Beranda</a></li>
                        <li><a href="<?php echo base_url();?>admin/menu"><i class="fa fa-navicon fa-fw"></i>Menu Catering</a></li>
                        <li><a href="<?php echo base_url();?>admin/costumer"><i class="fa fa-group fa-fw"></i>Costumer</a></li>
                        <li><a href="<?php echo base_url();?>admin/pemesanan"><i class="fa fa-calendar fa-fw"></i>Pemesanan</a></li>
                        <li><a href="<?php echo base_url();?>admin/pembayaran"><i class="fa fa-dollar fa-fw"></i>Pembayaran</a></li>
                        <li><a href="<?php echo base_url();?>admin/keluar"><i class="fa fa-sign-out fa-fw"></i> Logout</a> </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
             <?php $this->load->view($content);?>
         
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
<script src="<?php echo base_url();?>templates/admin/js/jquery.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>templates/admin/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>templates/admin/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>templates/admin/vendor/metisMenu/metisMenu.min.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>templates/admin/dist/js/sb-admin-2.js"></script>
  <!-- DataTables JavaScript -->
    <script src="<?php echo base_url();?>templates/admin/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>templates/admin/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>templates/admin/vendor/datatables-responsive/dataTables.responsive.js"></script>


    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
</body>

</html>

<?php } else { ?>
<br />
<b>Parse error</b>:  syntax error, unexpected 'if' (T_IF) in <b>C:\xampp\htdocs\catering\application\controllers\admin.php</b> on line <b>5</b><br />
<?php } ?>