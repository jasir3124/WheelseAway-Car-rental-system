<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('../php-logic/config.php');
include_once('../php-logic/header.php');
session_start();

$sql = "SELECT * FROM cars WHERE status = 'rented'";
$result = mysqli_query($conn, $sql);

$carsRented = mysqli_fetch_all($result, MYSQLI_ASSOC);
$totalCarsRented = count($carsRented);

$totalCost = 0;

foreach ($carsRented as $carRented) {
    $carCost = $carRented['costPerDay'];

    $carCost = intval(str_replace('$', '', $carCost));

    $totalCost += $carCost;
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icons.min.css">
    <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
  </head>
  <body>


    <div class="container-scroller">

      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav pt-0">
          <li class="nav-item profile">
            <div class="profile-desc ps-0">
              <div class="profile-pic">
                <div class="profile-name flex items-center">
                  <a class="text-white" href="home.php"><i class="fa-solid fa-arrow-left fa-2x me-3"></i></a>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="adminDashboard.php">
              <span class="menu-icon">
                <i class="mdi mdi-home"></i>
              </span>
              <span class="menu-title">Home</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link"  href="usersAdminDashboard.php">
              <span class="menu-icon">
                <i class="fa fa-user"></i>
              </span>
              <span class="menu-title">Users</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="carAdminDashboard.php">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">Cars</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
 
        <!-- partial -->
        <div class="main-panel pt-0">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Cars Rented</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <?php
                            echo "<h2 class='mb-0'> " . $totalCarsRented . "</h2>"
                          ?>
                        </div>
                        <h6 class="text-muted font-weight-normal">10% Since last month</h6>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-codepen text-primary ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Income</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <?php
                            echo "<h2 class='mb-0'> $" . $totalCost . "<span class='fs-6'> /week </span> </h2>"
                          ?>
                        </div>
                        <h6 class="text-muted font-weight-normal"> 15% Since last month</h6>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-wallet-travel text-danger ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Website Visits</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">9000</h2>
                          <p class="text-danger ms-2 mb-0 font-weight-medium">-2.1% </p>
                        </div>
                        <h6 class="text-muted font-weight-normal">2.27% Since last month</h6>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-monitor text-success ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Visitors by Countries</h4>
                    <div class="row">
                      <div class="col-md-5">
                        <div class="table-responsive">
                          <table class="table">
                            <tbody>
                              <tr>
                                <td>
                                  <i class="flag-icon flag-icon-mk"></i>
                                </td>
                                <td>Macedonia</td>
                                <td class="text-end"> 3500 </td>
                                <td class="text-end font-weight-medium"> 77.35% </td>
                              </tr>
                              <tr>
                                <td>
                                  <i class="flag-icon flag-icon-al"></i>
                                </td>
                                <td>Albania</td>
                                <td class="text-end"> 2100 </td>
                                <td class="text-end font-weight-medium"> 69.35% </td>
                              </tr>
                              <tr>
                                <td>
                                  <i class="flag-icon flag-icon-us"></i>
                                </td>
                                <td>USA</td>
                                <td class="text-end"> 1500 </td>
                                <td class="text-end font-weight-medium"> 56.35% </td>
                              </tr>
                              <tr>
                                <td>
                                  <i class="flag-icon flag-icon-de"></i>
                                </td>
                                <td>Germany</td>
                                <td class="text-end"> 800 </td>
                                <td class="text-end font-weight-medium"> 33.25% </td>
                              </tr>
                              <tr>
                                <td>
                                  <i class="flag-icon flag-icon-au"></i>
                                </td>
                                <td>Australia</td>
                                <td class="text-end"> 760 </td>
                                <td class="text-end font-weight-medium"> 15.45% </td>
                              </tr>
                              <tr>
                                <td>
                                  <i class="flag-icon flag-icon-gb"></i>
                                </td>
                                <td>United Kingdom</td>
                                <td class="text-end"> 450 </td>
                                <td class="text-end font-weight-medium"> 25.00% </td>
                              </tr>
                              <tr>
                                <td>
                                  <i class="flag-icon flag-icon-ro"></i>
                                </td>
                                <td>Romania</td>
                                <td class="text-end"> 620 </td>
                                <td class="text-end font-weight-medium"> 10.25% </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col-md-7">
                        <div id="audience-map" class="vector-map"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-4 pt-1">
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Rented Cars Data by car cost</h4>
                    <div class="doughnutjs-wrapper d-flex justify-content-center">
                      <canvas id="doughnutChart" style="height:250px"></canvas>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Rented Cars Data by car year</h4>
                    <canvas id="barChart" style="height:230px"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <!-- <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
            </div>
          </footer> -->
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>



    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/vendors/chart.js/chart.umd.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard.js"></script>

    <!-- plugins for the charts -->
    <script src="../assets/vendors/chart.js/chart.umd.js"></script>
    <script src="../assets/js/chart.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>