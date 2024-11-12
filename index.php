<?php 
	session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}

    if (!isset($_SESSION['status_login'])) 
    {
        echo "<script>alert('Anda Harus Login')</script>";
        echo "<script>location='login.php';</script>";
        header('location:login.php');
        exit();
    }

 ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Sistem Pakar</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php?halaman=index">Admin</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"><a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
                    <li><a href="index.php?halaman=index"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a></li>
                    <li><a href="index.php?halaman=admin"><i class="fa fa-user fa-4x"></i>Admin</a></li>
                    <li><a href="index.php?halaman=pasien"><i class="fa fa-user-md fa-4x"></i>Pasien</a></li>
                    <li><a href="index.php?halaman=penyakit"><i class="fa fa-stethoscope fa-4x"></i> Penyakit</a></li>
                    <li><a href="index.php?halaman=gejala"><i class="fa fa-stethoscope fa-4x"></i> Gejala</a></li>
                    <li><a href="index.php?halaman=aturan"><i class="fa fa-desktop fa-3x"></i> Aturan</a></li>
                    <li><a href="index.php?halaman=riwayat"><i class="fa fa-table fa-3x"></i> Riwayat</a></li>
                    </ul>
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
            <?php
                if (isset($_GET['halaman']))
                {
                    if ($_GET['halaman']=="pasien"){
                        include'pasien.php';
                    }
                    elseif ($_GET['halaman']=="penyakit") {
                       include'penyakit.php';
                    }
                    elseif ($_GET['halaman']=="admin") {
                        include'admin.php';
                     }
                    elseif ($_GET['halaman']=="gejala") {
                        include'gejala.php';
                    }
                    elseif ($_GET['halaman']=="aturan") {
                        include'aturan.php';
                    }
                    elseif ($_GET['halaman']=="riwayat") {
                        include'riwayat.php';
                    }
                    elseif ($_GET['halaman']=="logout") {
                        include'logout.php';
                    }
                    elseif ($_GET['halaman']=="tambahgejala") {
                        include'tambahgejala.php';
                    }
                    elseif ($_GET['halaman']=="ubahgejala") {
                        include'ubahgejala.php';
                    }
                    elseif ($_GET['halaman']=="hapusgejala") {
                        include'hapusgejala.php';
                    }
                    elseif ($_GET['halaman']=="tambahpenyakit") {
                        include'tambahpenyakit.php';
                    }
                    elseif ($_GET['halaman']=="ubahpenyakit") {
                        include'ubahpenyakit.php';
                    }
                    elseif ($_GET['halaman']=="hapuspenyakit") {
                        include'hapuspenyakit.php';
                    }
                    elseif ($_GET['halaman']=="tambahaturan") {
                        include'tambahaturan.php';
                    }
                    elseif ($_GET['halaman']=="ubahaturan") {
                        include'ubahaturan.php';
                    }
                    elseif ($_GET['halaman']=="hapusaturan") {
                        include'hapusaturan.php';
                    }

                    elseif ($_GET['halaman']=="tambahadmin") {
                        include'tambahadmin.php';
                    }
                    elseif ($_GET['halaman']=="ubahadmin") {
                        include'ubahadmin.php';
                    }
                    elseif ($_GET['halaman']=="hapusadmin") {
                        include'hapusadmin.php';
                    }

                else
                {
                    include 'home.php';
                }
            }
                ?>            
                </div>     
                 <!-- /. ROW  -->           
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
