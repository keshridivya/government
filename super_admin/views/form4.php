<?php
//include '../api.php';
include("../include.php");
session_start();
if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
{
  header("location:index.php");
}
$role='';
       $email=$_SESSION['use'];
       $sql = mysqli_query($conn,"SELECT * FROM webuser WHERE email='$email'") ;
       while($res=mysqli_fetch_array($sql)){
         $role=$res['role'];
       }

        $image='';
        $discription='';
        $id=intval($_GET['id']);
        $sql=mysqli_query($conn,"select * from image where caseid='$id'");
        while($arr=mysqli_fetch_array($sql)){
        $image=$arr['image'];
        $discription=$arr['discription'];
        $payStatus=$arr['payStatus'];
        }
      

$id=$_GET['id'];
if(isset($_POST['subm_it'])){
    $file=$_FILES['files']['name'];    
    $discription=$_POST['discription'];
    $payStatus=$_POST['payStatus'];
    $filedet=$_FILES['files']['tmp_name'];
    $loc="file/".$file;
    move_uploaded_file($filedet,$loc);
    $loc1="../../user/views/file/".$file;
    move_uploaded_file($filedet,$loc1);
    if(isset($_GET['eid'])){
      $sql=mysqli_query($conn,"update image set discription='$discription',status='$payStatus' where caseid='$eid'");
    }
    else{
      $sql=mysqli_query($conn,"insert into image (caseid,image,discription,status) values('$id','$file','$discription','$payStatus')");
    }
    if($sql==1){
        header("location:form5.php?id=".$id);
    }else{
        mysqli_error($conn);
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atrocity Raigad | Governnment Form </title>
    <link rel="shortcut icon" type="image/png" href="../dist/img/government.png" />


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <script>
        var stateObject = {
            "???????????????": {
                "??????????????????": ["Thiruvananthapuram", "Palakkad"],
                "???????????????": ["North Goa", "South Goa"],
                "???????????????": ["North Goa", "South Goa"],
                "?????????": ["Thiruvananthapuram", "Palakkad"],
                "?????????": ["North Goa", "South Goa"],
                "???????????????": ["North Goa", "South Goa"],
                "?????????????????????": ["Thiruvananthapuram", "Palakkad"],
                "??????????????????": ["North Goa", "South Goa"],
                "??????????????????": ["North Goa", "South Goa"],
                "????????????": ["Thiruvananthapuram", "Palakkad"],
                "?????????": ["North Goa", "South Goa"],
                "?????????": ["North Goa", "South Goa"],
                "??????????????????": ["Thiruvananthapuram", "Palakkad"],
                "???????????????????????????": ["North Goa", "South Goa"],
                "????????????????????????": ["North Goa", "South Goa"],

            },
            "????????? ???????????????": {
                "South Australia": ["Dunstan", "Mitchell"],
                "Victoria": ["Altona", "Euroa"]
            },
        }
        window.onload = function () {
            var district = document.getElementById("district"),
                taluka = document.getElementById("taluka"),
                police = document.getElementById("police");
            for (var dis in stateObject) {
                district.options[district.options.length] = new Option(dis, dis);
            }
            district.onchange = function () {
                taluka.length = 1; // remove all options bar first
                police.length = 1; // remove all options bar first
                if (this.selectedIndex < 1) return; // done
                for (var talu in stateObject[this.value]) {
                    taluka.options[taluka.options.length] = new Option(talu, talu);
                }
            }
            district.onchange(); // reset in case page is reloaded
            taluka.onchange = function () {
                police.length = 1; // remove all options bar first
                if (this.selectedIndex < 1) return; // done
                var pol = stateObject[district.value][this.value];
                for (var i = 0; i < pol.length; i++) {
                    police.options[police.options.length] = new Option(pol[i], pol[i]);
                }
            }
        }
    </script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->


                <!-- Messages Dropdown Menu -->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
               
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light" >Atrocity Raigad</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <!--<div class="image">
            <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>-->
          <div class="info">
            <a href="#" class="d-block" style="text-transform:capitalize;font-size:20px;font-weight:500"><?php echo $role; ?></a>
          </div>
        </div>

        <!-- SidebarSearch Form -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


            <li class="nav-item menu-open">
              <a href="index.php" class="nav-link ">
                 <i class="nav-icon fas fa-tachometer-alt"></i> 
               
                <p>
                    ?????????????????????????????? 
                  <!-- <i class="right fas fa-angle-left"></i> -->
                </p>
              </a>
           
            </li>

            <li class="nav-item">

              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  ??????????????????
                  <i class="right fas fa-angle-left"></i>
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item menu-open">
                  <a href="form1.php" class="nav-link active">
                    <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
                    <p >
                    ?????????????????? ?????????
                      <!-- <i class="right fas fa-angle-left"></i> -->
                    </p>
                  </a>

                </li>
                
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  ???????????????
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="report/R1.php" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>??????????????? ???</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="report/R2.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>??????????????? ???</p>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a href="report/R4.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>??????????????? ???</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="report/R5.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>??????????????? ???</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="report/Complaint.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Complaint</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  ???????????????????????????                                                                                                                                                                                                                                
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="viewwebuser.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p> ??????????????????????????? ???????????????????????????

                    </p>
                  </a>
                </li>
                
              </ul>
            </li>
            <li class="nav-item">

            <a href="#" class="nav-link ">
              <i class=" nav-icon fas fa-landmark "></i>
              <p>
                ?????????
                <i class="right fas fa-angle-left"></i>
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
            <a href="report/r1opy.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i> 
              <p>
              ????????? ??????????????????
              </p>
            </a>

            </li>
            <!-- <li class="nav-item"> 
            <a href="report/payment.php" class="nav-link">
            <i class=" far fa-circle nav-icon"></i> 
              <p>
              ??????????????????
              </p>
            </a>

            </li>-->
              
            </ul>
            </li>

            <li class="nav-item">
              <a href="../logout.php" class="nav-link">
              <i class=" nav-icon fas fa-sign-out-alt"></i> 
                <p>
                     ??????????????? ?????????  
                </p>
              </a>
           
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->


      </div>
      <!-- /.sidebar -->
    </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>???????????????????????? ????????????/??????????????? ???????????????????????? ?????????????????? ??????????????????????????? ???????????????</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">????????????????????????</a></li>
                                            <li  class="active" id="account"><strong>?????????????????? ?????????????????????</strong></li>
                                <li class="breadcrumb-item active"></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary">
                           
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" enctype="multipart/form-data">
                                    <div class="card-body">
                                    <div class="col-12" style="text-align:center;">
                      <ul id="progressbar" style="display:flex"  ;>
                                            <li  class="active" id="account"><strong>??????????????????</strong></li>
                                            <li  class="active" id="personal"><strong>????????????????????? ??????????????????</strong></li>
                                            
                                            <li class="active" id="payment"><strong>??????????????? ??????????????????????????? ??????????????????</strong></li>
                                            <li class="active" id="confirm"><strong>????????? ?????????????????? </strong></li>
                                            <li id="confirm"><strong>?????????????????? </strong></li>
    
                                        </ul>

                      </div>
                      <div class="d-flex form-group " style="margin-left: -12px;">
                                            <div class="form-group col-6">
                                           
                                               <input type="hidden" required class="" name="id" value="<?php echo $id;?>"
                                                    id="example??????????????????" placeholder="">
                                            </div>
                                        </div>

                    

                                        <div class="d-flex form-group " style="margin-left: -12px;">
                    <div class="form-group col-8">
                      <label for="Example???????????????  ??????????????????-?????? ???????????????">FIR</label><br>
                      <label for="myfile">???????????? ???????????????:</label>
                      <input type="file" name="files" multiple  value="<?php echo $image; ?> "/>
                    </div>
                    <div class="form-group col-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="gender3">Status</label>
                      </div>
                      <select class="custom-select" id="gender3" name="payStatus">
                        <option value="<?php echo $payStatus; ?>"><?php echo $payStatus; ?></option>
                        <option value="stage 1" selected>stage 1 payment</option>
                        <option value="stage 2">stage 2 payment</option>
                        <option value="stage 3">stage 3 payment</option>
                        <option value="stage 3">Case close</option>
                      </select>
                    </div>
                    
                                </div>
                  </div>

                    <div class="form-group">
                      <label for="Example????????????">????????????</label>
                      <input type="Descriptionbox" required value="<?php echo $discription; ?>" class="form-control" name="discription" id="Example????????????"
                        placeholder="">
                    </div>

                                        <!-- /.card-body -->

                                        <div style="text-align: end;">
                                        
                                       <!-- <a href="form3.php?id=<?php //echo $id;?>" class="btn btn-primary">???????????? ??????</a>-->
                                            <button type="submit" name="subm_it" class="btn btn-primary">???????????? ?????????
                                            </button>
                                            <a href="fo.php?id=<?php echo $id;?>" class="btn btn-primary">???????????? ??????</a>
                                        </div>
                                    </div>          
                                </form>
                            </div>
                            <!-- /.card -->

                            <!-- general form elements -->

                            <!-- /.card -->

                            <!-- Input addon -->

                            <!-- /.card -->
                            <!-- Horizontal Form -->

                            <!-- /.card -->

                        </div>
                        <!--/.col (left) -->
                        <!-- right column -->

                        <!--/.col (right) -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
      <strong>Copyright &copy; <?php echo date('Y'); ?></strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        Designd by Tectignis It Solutions</b>
      </div>
    </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
</body>

</html>