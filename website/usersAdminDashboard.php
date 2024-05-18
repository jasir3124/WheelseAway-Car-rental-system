<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('../php-logic/config.php');
include_once('../php-logic/header.php');
session_start();

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

unset($_SESSION['edit_user_id'])
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

<body class="">
  <div class="container-scroller min-h-dvh">

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
          <a class="nav-link" href="usersAdminDashboard.php">
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
                  <h5>Accounts created</h5>
                  <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                      <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                        $totalAccountsCreated = count($users);
                        echo "<h2 class'mb-0'>" . $totalAccountsCreated . "</h2>"
                        ?>
                        <p class="text-success ms-2 mb-0 font-weight-medium">+4%</p>
                      </div>
                      <h6 class="text-muted font-weight-normal">11.38% Since last month</h6>
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
                  <h5>Users that have rented a car</h5>
                  <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                      <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                        $usersThatRentCar = 0;
                        foreach ($users as $user) {
                          if ($user['has_rented'] == 1) {
                            $usersThatRentCar++;
                          }
                        }
                        echo "<h2 class'mb-0'>" . $usersThatRentCar . "</h2>"
                        ?>
                        <p class="text-success ms-2 mb-0 font-weight-medium">+8%</p>
                      </div>
                      <h6 class="text-muted font-weight-normal"> 9.61% Since last month</h6>
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
                        <p class="text-danger ms-2 mb-0 font-weight-medium">-2% </p>
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

          <!-- users table -->
          <div class="row ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">User Accounts</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>
                            <div class="form-check form-check-muted m-0">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" id="check-all">
                              </label>
                            </div>
                          </th>
                          <th> Name </th>
                          <th> Last name </th>
                          <th> Username </th>
                          <th> Email </th>
                          <th> Password </th>
                          <th> Has rented </th>
                          <th> Rented Car Id </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($users as $user) : ?>
                          <?php
                          $hasRented = $user['has_rented'] == 1;
                          $hasRentedClass = $hasRented ? 'badge badge-outline-success' : 'badge badge-outline-danger';
                          $hasRentedDesc = $hasRented ? 'True' : 'False';
                          $rentedCarInfo = $hasRented ? $user['rented_car_id'] : "<i class=' fa-solid fa-ban'></i>";
                          ?>
                          <tr id="user-row-<?= $user['userID'] ?>"> <!-- Add this -->
                            <td>
                              <div class='form-check form-check-muted m-0'>
                                <label class='form-check-label'>
                                  <?php
                                    if($user['admin'] == 0){
                                      echo "<input type='checkbox' class='form-check-input user-checkbox' data-user-id='" . $user['userID'] . "' data-email='" . $user['email'] . "' data-has-rented='" . $user['has_rented'] . "'>";
                                    }
                                  ?>
                                </label>
                              </div>
                            </td>
                            <td><?= $user['first_name'] ?></td>
                            <td><?= $user['last_name'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['password'] ?></td>
                            <td>
                              <div class='<?= $hasRentedClass ?>'><?= $hasRentedDesc ?></div>
                            </td>
                            <td><?= $rentedCarInfo ?></td>
                            <td> <a style="text-decoration: none;" class="text-blue-600 border border-blue-600 py-1 px-3 rounded-md" href="updateUserDataDashboard.php?userID=<?php echo $user['userID'] ?>">Edit User</a></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    <div class="mt-4">
                      <!-- Existing table here -->
                      <button id="delete-users" class="btn btn-danger">Delete selected users</button>
                    </div>


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>



  <?php
  if (isset($_SESSION['update_user_success_message'])) {
    echo "
      <script>
        alert('" . $_SESSION['update_user_success_message'] . "');
      </script>
    ";
    unset($_SESSION['update_user_success_message']);
  }
  ?>
  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../assets/js/usersTableForm.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
  <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="../assets/js/proBanner.js"></script>
  <script src="../assets/js/dashboard.js"></script>
  <!-- End custom js for this page -->
</body>

</html>