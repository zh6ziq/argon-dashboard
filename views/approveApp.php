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
$stfRL = 'Nurse';
$query = "SELECT * FROM staff WHERE staffID='$stfID' AND staffRole='$stfRL'";
$result = mysqli_query($con, $query) or die ('Failed to query ' . mysqli_error($con));
	if(!isset($_SESSION['staffID'])) {
    header("Location: login.php");
  }	
  while($row = mysqli_fetch_assoc($result))
  { $staffName = $row['staffName']; }

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
	<meta name="author" content="Creative Tim">
	<title>YouHeal Hospital</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
	integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<!-- Favicon -->
	<link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
	<!-- Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
	<!-- Icons -->
	<link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
	<link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
	<!-- Argon CSS -->
	<link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body>
	<div>
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
								<a class="nav-link" href="dashboardNurse.php">
									<i class="ni ni-tv-2 text-primary"></i>
									<span class="nav-link-text">Dashboard</span>
								</a>
							</li>

							<li class="nav-item">
								<a class="nav-link active bg-info" href="approveApp.php">
									<i class="ni ni-calendar-grid-58 text-default"></i>
									<span class="nav-link-text">Approve Appointment</span>
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
						<!-- Search form -->
						<!-- <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
							<div class="form-group mb-0">
								<div class="input-group input-group-alternative input-group-merge">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-search"></i></span>
									</div>
									<input class="form-control" placeholder="Search" type="text">
								</div>
							</div>
							<button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</form> -->
						<!-- Navbar links -->
						<ul class="navbar-nav align-items-center  ml-md-auto ">
							<li class="nav-item d-xl-none">
								<!-- Sidenav toggler -->
								<div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
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
								<a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
								<h6 class="h2 text-white d-inline-block mb-0">List of Appointments</h6>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Page content -->
			<div class="container-fluid mt--6">
				<div class="row">
					<div class="col">
						<div class="card">
						</div>
					</div>
				</div>


				<?php
				$con = mysqli_connect("localhost", "root", "", "bookingappointment") or die ('Unable to connect to MYSQL: ' . mysqli_connect_error());
				$condition = 'Processing';
        		$sql = "SELECT patient.*, appointment.* FROM patient INNER JOIN appointment
            		ON patient.patientIC=appointment.patientIC WHERE appStatus = '$condition' ORDER BY appDate ";
				$result = mysqli_query($con, $sql) or die ('Failed to query ' . mysqli_error($con));
				?>
	
				<!-- Dark table -->
				<div class="row">
					<div class="col">
						<div class="card bg-default shadow">

							<div class="card-header bg-transparent border-0">
								<h3 class="text-white mb-0">Pending Appointment</h3>
							</div>

							<div class="table-responsive">
								<table class="table align-items-center table-dark table-flush">
									<thead class="bg-gradient-success">
										<tr>
											
											<th>Name</th>
											<th>Services</th>
											<th>Date</th>
											<th>Time</th>
											<th>Status</th>
											<th></th>
											<th></th>

										</tr>
									</thead>
									<?php
									while($row=mysqli_fetch_assoc($result))
									{
									?>

									<tbody class="list">
										<tr class="text-left">
											<td><?php echo $row['patientName']; ?></td>
											<td><?php echo $row['appService']; ?></td>
											<td><?php echo $row['appDate']; ?></td>
											<td><?php echo $row['appTime']; ?></td>
											<td><?php echo $row['appStatus']; ?></td>
											<td>
												<a href="#" class="text-success">
													<i class="fas fa-check-circle" data-toggle="modal" 
														data-target="#showApproveModal"></i>
												</a>
											</td>
											<td>
												<a href="#" class="text-danger">
													<i class="fas fa-times-circle" data-toggle="modal" 
														data-target="#showRejectModal"></i>
												</a>
											</td>
										</tr>
									</tbody>
									<?php } ?>
								</table>
							</div>
						</div>
					</div>
				</div>
										
				<!-- APPROVE APPOINTMENT MODAL -->
				<div class="modal fade" id="showApproveModal" tabindex="-1" aria-labelledby="showApproveModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
						<div class="modal-content">
										
							<div class="modal-header">
								<h5 class="modal-title" id="showApproveModalLabel">Approve Appointment</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
										
							<div class="alert alert-info mx-2 text-default" role="alert">
								<strong>Alert!</strong> Confirm to approve appointment <strong><?php echo $row['patientName']; ?></strong> ?
							</div>

							<div class="modal-footer">
								<button class="btn btn-default btn-md float-right" 
									data-dismiss="modal">Cancel</button>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<button class="btn btn-success btn-md float-right" 
									data-dismiss="modal" name="approveAppt">Approve</button>
							</div>

						</div>
					</div>
				</div>

				<!-- REJECT APPOINTMENT MODAL -->
				<div class="modal fade" id="showRejectModal" tabindex="-1" aria-labelledby="showRejectModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
						<div class="modal-content">

							<div class="modal-header">
								<h5 class="modal-title" id="showRejectModalLabel">Reject Appointment</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="alert alert-warning mx-2 text-default" role="alert">
								<strong>Warning!</strong> Confirm to reject appointment <strong><?php echo $row['patientName']; ?></strong> ?
							</div>

							<div class="modal-footer">
								<button class="btn btn-default btn-md float-right" 
									data-dismiss="modal">Cancel</button>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<button class="btn btn-danger btn-md float-right"
									data-dismiss="modal" name="rejectAppt">Reject</button>
							</div>

						</div>
					</div>
				</div>

				<!-- Footer -->
				<footer class="footer pt-0">
					<!-- <div class="row align-items-center justify-content-lg-between">
						<div class="col-lg-6">
							<div class="copyright text-center  text-lg-left  text-muted">
								&copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
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
									<a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
								</li>
							</ul>
						</div>
					</div> -->
				</footer>
			</div>
		</div>
	</div>

	<!-- Argon Scripts -->
	<!-- Core -->
	<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
	<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="../assets/vendor/js-cookie/js.cookie.js"></script>
	<script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
	<script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
	<!-- Argon JS -->
	<script src="../assets/js/argon.js?v=1.2.0"></script>

</body>

</html>
