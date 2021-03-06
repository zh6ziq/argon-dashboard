<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard


* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com



=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "bookingappointment") or die ('Unable to connect to MYSQL: ' . mysqli_connect_error());
$stfID = $_SESSION['staffID'];
$stfRL = 'Admin';
$query = "SELECT * FROM staff WHERE staffID='$stfID' AND staffRole='$stfRL'";
$result = mysqli_query($con, $query) or die ('Failed to query ' . mysqli_error($con));
  if(!isset($_SESSION['staffID'])) {
    header("Location: login.php");
  }
  while($row = mysqli_fetch_assoc($result))
  { $staffName = $row['staffName'];
    $staffID = $row['staffID'];
    $staffEmail = $row['staffEmail'];
    $staffPhone = $row['staffPhone'];
 }

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>YouHeal Hospital</title>
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-dark bg-default" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="../assets/img/brand/logo.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">

            <li class="nav-item">
              <a class="nav-link" href="dashboardAdmin.php">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text text-dark">Dashboard</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="listApp.php">
                <i class="ni ni-calendar-grid-58 text-danger"></i>
                <span class="nav-link-text">List of Appointments</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="listPatient.php">
                <i class="ni ni-bullet-list-67 text-info"></i>
                <span class="nav-link-text">List of Patients</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="listStaff.php">
                <i class="ni ni-bullet-list-67 text-info"></i>
                <span class="nav-link-text">List of Staffs</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link active bg-info" href="profileAdmin.php">
                <i class="ni ni-single-02 text-yellow"></i>
                <span class="nav-link-text">Profile</span>
              </a>
            </li>


          </ul>
          <!-- Divider -->
          <hr class="my-3">

        </div>
      </div>
    </div>
  </nav>

  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-gradient-info border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">

            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>



          </ul>

          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="../assets/img/theme/team-4.jpg">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $staffName ?></span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <a href="_logout.php" class="dropdown-item">
                  <i class="ni ni-user-run text-danger"></i>
                  <span class="text-danger">Logout</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <div class="header bg-gradient-info pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">My Profile</h6>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
      <!-- EDIT PROFILE BUTTON -->
      <div class="row">
        <div class="col-lg-12 my-1">
          <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#showEditModal"
            @click="showEditModal=true">
            <i class="fas fa-edit text-default"></i>&nbsp;&nbsp;Edit Profile
          </button>
        </div>
      </div>

      <!-- PROFILE DETAILS -->
      <div class="row">
        <div class="col">
          <div class="card bg-default shadow">

            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0 text-white">User Details</h3>
                </div>
              </div>
            </div>

            <div class="card-body text-white">
              <div class="jumbotron jumbotron-fluid bg-default">
                <div class="container">
                  <div class="row">
                    <div class="col-md-2 col-sm-6">
                      <h3 class="text-white">Name</h3>
                    </div>
                    <div class="col-md-4 col-sm-8">
                      <h4 class="bg-secondary text-default pl-2"><?php echo $staffName; ?></h4>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2 col-sm-6">
                      <h3 class="text-white">Staff ID </h3>
                    </div>
                    <div class="col-md-4 col-sm-8">
                      <h4 class="bg-secondary text-default pl-2"><?php echo $staffID; ?></h4>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2 col-sm-6">
                      <h3 class="text-white">Email</h3>
                    </div>
                    <div class="col-md-4 col-sm-8">
                      <h4 class="bg-secondary text-default pl-2"><?php echo $staffEmail; ?></h4>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2 col-sm-6">
                      <h3 class="text-white">Phone</h3>
                    </div>
                    <div class="col-md-4 col-sm-8">
                      <h4 class="bg-secondary text-default pl-2"><?php echo $staffPhone; ?></h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- EDIT PROFILE MODAL -->
      <div class="modal fade" id="showEditModal" tabindex="-1" aria-labelledby="showEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="showEditModalLabel">Edit Profile</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="_admin.php" method="post">
      
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control form-control-sm" name="staffName"
                    value="<?php echo $staffName; ?>">
                </div>
      
                <div class="form-group">
                  <label for="id">ID</label>
                  <input type="text" class="form-control form-control-sm" name="staffID" 
                    value="<?php echo $staffID; ?>" disabled>
                </div>
      
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control form-control-sm" name="staffEmail"
                    value="<?php echo $staffEmail; ?>">
                </div>
      
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="tel" class="form-control form-control-sm" name="staffPhone"
                    value="<?php echo $staffPhone; ?>">
                </div>
      
                <button class="btn btn-success btn-block btn-md" type="submit" name="updateProfile">
                  <i class="fas fa-edit text-white"></i>&nbsp;&nbsp;Update
                </button>
      
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="footer pt-0">
        <!-- <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
              &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative
                Tim</a>
            </div>
          </div>
          <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link"
                  target="_blank">MIT License</a>
              </li>
            </ul>
          </div>
        </div> -->
      </footer>
    </div>
  </div>

  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.2.0"></script>
</body>

</html>