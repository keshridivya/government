<?php
//include '../api.php';
include("../include.php");
session_start();
if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
{
  header("location:index.php");
}
$district='';
        $email=$_SESSION['use'];
        $sql = mysqli_query($conn,"SELECT * FROM webuser WHERE email='$email'") ;
        
        while($res=mysqli_fetch_array($sql)){
          $district=$res['district'];
        }
        $id='';
        $caseid='';
        $victim_name='';
        $victim_address='';
        $caste_certificate='';
        $aadhaar_card='';
        $bank_info='';
        $charge_sheet='';
        $victim_age='';
        $category_and_caste='';
        if(isset($_GET['id'])){
          $id=intval($_GET['id']);
          $sql=mysqli_query($conn,"select * from victim where id='$id'");
        while($arr=mysqli_fetch_array($sql)){
        $id=$arr['id'];
        $caseid=$arr['caseid'];
        $victim_name= $arr['name'];
        $victim_address=$arr['address'];  
        $caste_certificate=$arr['caste_certificate'] ; 
        $aadhaar_card=$arr['aadhar_card'] ; 
        $bank_info=$arr['bank_detail'];
        $charge_sheet=$arr['charge_sheet'];
        $victim_age=$arr['victim_age'];
        $category_and_caste=$arr['caste'];
    }
        }

        if(isset($_POST['sub_mit']) && ($_GET['id']))  
        {  
         $id=$_POST['id'];
         $caseid=$_POST['caseid'];
         $victim_name=$_POST['victim_name'];
         $victim_address=$_POST['victim_address'];
         $category_and_caste=$_POST['category_and_caste'];  
         $victim_age=$_POST['victim_age'];
         $caste_certificate=$_POST['caste_certificate']; 
         $aadhaar_card=$_POST['aadhaar_card'];
         $charge_sheet=$_POST['charge_sheet'];
         
         
         $sql= mysqli_query($conn,"UPDATE `victim` SET `caseid`='$caseid',`charge_sheet`='$charge_sheet',`aadhar_card`='$aadhaar_card',`caste_certificate`='$caste_certificate',`caste`='$category_and_caste',`victim_age`='$victim_age',`name`='$victim_name',`address`='$victim_address' where id='$id'");
        
        if($sql==1)
        {
         header("Location:editform4.php?eid=".$caseid) ;
        }
        else {
        echo 'error';
         
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
            <a href="#" class="d-block" style="text-transform:capitalize;font-size:20px;font-weight:500"><?php echo $district; ?></a>
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

              <a href="#" class="nav-link  active">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  ??????????????????
                  <i class="right fas fa-angle-left"></i>
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item menu-open">
                  <a href="form1.php" class="nav-link">
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
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  ???????????????
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="report/R1.php" class="nav-link">
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
                  <a href="report/complain.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Complaint</p>
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
                                <li class="breadcrumb-item active">?????????????????? ?????????????????????</li>
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
                                <!-- form start  action="../api.php"-->
                                <form method="post" >
                                    <div class="card-body">
                                    <div class="col-12" style="text-align:center;">
                      <ul id="progressbar" style="display:flex"  ;>
                                            <li  class="active" id="account"><strong>??????????????????</strong></li>
                                            <li  class="active" id="personal"><strong>????????????????????? ??????????????????</strong></li>
                                            
                                            <li class="active" id="payment"><strong>??????????????? ??????????????????????????? ??????????????????</strong></li>
                                            <li id="confirm"><strong>????????? ?????????????????? </strong></li>
                                            <li id="confirm"><strong>?????????????????? </strong></li>
    
                                        </ul> 
        <!--$aadhaar_card=$arr['aadhaar_card'] ; 
        $bank_info=$arr['bank_info'];
        $charge_sheet=$arr['charge_sheet'];
        $category_and_caste=$arr['category_and_caste'];-->

                      </div>
                                        <div class="d-flex form-group " style="margin-left: -12px;">
                                            <div class="form-group col-6">
                                           
                                               <input type="hidden" required class="" name="id" value="<?php echo $id;?>"
                                                    id="example??????????????????" placeholder="">
                                               <input type="hidden" required class="" name="caseid" value="<?php echo $caseid;?>"  id="example??????????????????" placeholder="">
                                            </div>
                                        </div>
                                        <div class="d-flex form-group " style="margin-left: -12px;">
                                            <div class="form-group col-6">
                                                <label for="">??????????????? ??????????????????????????? ????????? </label>
                                                <input type="text" required class="form-control" value="<?php echo $victim_name;?>" name="victim_name" id="fff" placeholder="">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="">??????????????? ??????????????????????????? ???????????????</label>
                                                <input type="text" required class="form-control" value="<?php echo $victim_address;?>" name="victim_address" id="fff2" placeholder="">
                                            </div>

                                        </div>

                                        

                                        <div class="d-flex form-group " style="margin-left: -12px;">
                                            <div class="form-group col-6">
                                                <label for="Example????????????????????? ????????? ????????? ">??????????????? ??????????????????????????? ????????????????????? ????????? ?????????</label>
                                                <input type="Textbox" required class="form-control"
                                                name="category_and_caste" value="<?php echo  $category_and_caste;?>" id="Example????????????????????? ????????? ????????? fff3" placeholder="">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="example??????????????????">??????????????? ??????????????????????????? ??????</label>
                                                <input type="number" required class="form-control"
                                                    name="victim_age" value="<?php echo $victim_age;?>" id="example?????????????????? fff4" placeholder="">
                                            </div>

                                        </div>

                                        <div class="form-group d-flex " style="margin-left: -12px;">
                                            <div class="form-group col-2">
                                                <label for="Example?????? ?????????????????? ?????? ?????????">?????????????????? ??????????????? </label>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" required type="radio"
                                                        id="customRadio1" value="?????????" <?php if($caste_certificate=='?????????') {?> <?php echo "checked";?> <?php }?> name="caste_certificate">
                                                    <label for="customRadio1" class="custom-control-label">????????? </label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="customRadio2"
                                                        value="????????????" <?php if($caste_certificate=='????????????') {?> <?php echo "checked";?> <?php }?> name="caste_certificate">
                                                    <label for="customRadio2" class="custom-control-label">???????????? </label>
                                                </div>
                                            </div>
                                            <div class="form-group col-2">
                                                <label for="Example?????? ?????????????????? ?????? ?????????">???????????? ??????????????? </label>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" required type="radio"
                                                        id="customRadio3" value="?????????" <?php if($aadhaar_card=='?????????') {?> <?php echo "checked";?> <?php }?> name="aadhaar_card">
                                                    <label for="customRadio3" class="custom-control-label">?????????</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="customRadio4"
                                                        value="????????????" <?php if($aadhaar_card=='????????????') {?> <?php echo "checked";?> <?php }?> name="aadhaar_card">
                                                    <label for="customRadio4" class="custom-control-label">???????????? </label>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col-2">
                                                <label for="Example?????????????????? ??????.">??????????????? ????????? </label>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" required type="radio"
                                                        id="customRadio7" value="?????????" <?php if($charge_sheet=='?????????') {?> <?php echo "checked";?> <?php }?> name="charge_sheet">
                                                    <label for="customRadio7" class="custom-control-label">?????????</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" required type="radio"
                                                        id="customRadio8" value="????????????" <?php if($charge_sheet=='????????????') {?> <?php echo "checked";?> <?php }?> name="charge_sheet">
                                                    <label for="customRadio8" class="custom-control-label">???????????? </label>
                                                </div>
                                            </div>
                                            
                                        </div>


                                        

                                        <!-- /.card-body -->
<?php $eid=intval($_GET['eid']); ?>
                                        <div style="text-align: end;">
                                            <a href="addnewform3.php?eid=<?php echo $eid;?>" class="btn btn-primary bbbt">Add</a>
                                            <button type="sumbit" name="sub_mit" class="btn btn-primary bbbt">???????????? ?????????
                                            </button>
                                           
                                        </div>
                                    </div>          
                                </form>
                            </div>
                            <div class="card-body">
                <table class="table table-bordered table-hover" style="display:inline-table">
                  <thead>
                    <tr>
                      <th>??????????????????????????????</th>
                      <th>?????????????????? ?????????????????? ?????????.</th>
                      <th>???????????????????????????????????? ?????????</th>
                      <th>??????????????? ??????????????????</th>
                      <th>??????????????????</th>
                      <th>age</th>
                      <th>address</th>
                      <th>name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      
                    <?php 
                    $eid=intval($_GET['eid']);
                    $sql=mysqli_query($conn,"select * from victim where caseid='$eid'");
                    $count=1;
                    while($arr=mysqli_fetch_array($sql)){
                    ?>
                    <tr data-widget="expandable-table" aria-expanded="false">
                      <td><?php echo $count;?></td>
                      <td><?php echo $arr['caseid'];?></td>
                      <td><?php echo $arr['charge_sheet'];?></td>
                      <td><?php echo $arr['aadhar_card'];?></td>
                      <td><?php echo $arr['caste_certificate'];?></td>
                      <td><?php echo $arr['victim_age'];?></td>
                      <td><?php echo $arr['address'];?></td>
                      <td><?php echo $arr['name'];?></td>
                      <td><a href="editform3.php?action=edit&id=<?php echo $arr['id']; ?>" title="" class="btn btn-success btn-xs delete_purchase"><i class="fas fa-edit"></i></a></td>
                      
                    </tr>
                    <?php $count++;
                  } ?>
                    <tr class="expandable-body">
                      <td colspan="7">
                        <p>
                         ????????????????????????????????? ?????????????????? ??????????????? ?????????.
                        </p>
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
      <!-- /.content -->
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
    <script>
        $(document).ready(function(){
            $("bbbt").click(function(){
              $(".fff").html("#id");
              $(".fff2").html("#id1");
              $(".fff3").html("#id1");
              $(".fff4").html("#id1");
              $(".fff5").html("#id1");
            });
        });
    </script>
</body>

</html>