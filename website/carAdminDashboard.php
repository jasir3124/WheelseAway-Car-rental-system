<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('../php-logic/config.php');
include_once('../php-logic/header.php');
session_start();

$sql = "SELECT * FROM cars";
$result = mysqli_query($conn, $sql);

$cars = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
  <Style>
    .costPerDayInput::-webkit-outer-spin-button,
    .costPerDayInput::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    .costPerDayInput[type=number] {
      -moz-appearance: textfield;
    }
  </Style>
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

            <div class="col-sm-6 grid-margin">
              <div class="card">
                <div class="card-body">
                  <?php
                  if (isset($_SESSION['add_car_to_db_error'])) {
                    echo "<p class='text-red-600'>" . $_SESSION['add_car_to_db_error'] . "</p>";
                    unset($_SESSION['add_car_to_db_error']);
                  }
                  if (isset($_SESSION['add_car_to_db_success'])) {
                    echo "<p class='text-green-600'>" . $_SESSION['add_car_to_db_success'] . "</p>";
                    unset($_SESSION['add_car_to_db_success']);
                  }
                  ?>
                  <h4 class="card-title">Add new car</h4>
                  <form id="addCarForm" class="forms-sample" method="post" action="../php-logic/addNewCarToDB.php" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName1">Car Name</label>
                      <input name="carName" type="text" class="form-control" id="exampleInputName1" placeholder="Car Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Car Model</label>
                      <input name="carModel" type="text" class="form-control" id="exampleInputName1" placeholder="Car model">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Car Year</label>
                      <input name="carYear" type="text" class="form-control" id="exampleInputName1" placeholder="Car year">
                    </div>
                    <div class="form-group">
                      <label for="">Cost Per Week</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-primary text-white">$</span>
                        </div>
                        <input name="costPerDay" type="number" class="form-control costPerDayInput" aria-label="Amount (to the nearest dollar)">
                        <div class="input-group-append">
                          <span class="input-group-text">.00</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="overflow-hidden">
                        <div class="absolute z-10">
                          <input type="file" class="opacity-0" onchange="addImageNameToInput(this)">
                        </div>
                        <button type="button" class="z-0 bg-blue-500 px-3 py-1 rounded-sm">Upload Image</button>
                        <input name="carImage" class="imageNameInput" type="text" placeholder="Upload car image" class="m-0 px-1" style="background-color: #2A3038; height: 35px;">
                      </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary me-2">Submit</button>
                    <button type="button" onclick="resetForm()" class="btn btn-dark">Cancel</button>
                  </form>
                </div>
              </div>
            </div>


            <div class="col-sm-6 grid-margin">
              <div class="card mb-5">
                <div class="card-body">
                  <h5>Number of cars</h5>
                  <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                      <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                        $totalCars = count($cars);
                        echo "<h2 class'mb-0'>" . $totalCars . "</h2>"
                        ?>
                      </div>
                      <h6 class="text-muted font-weight-normal">11.38% Since last month</h6>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                      <i class="icon-lg mdi mdi-codepen text-primary ml-auto"></i>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-body">
                  <h5>Users that have rented a car</h5>
                  <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                      <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                        $carsRented = 0;
                        foreach ($cars as $car) {
                          if ($car['status'] == 'rented') {
                            $carsRented++;
                          }
                        }
                        echo "<h2 class'mb-0'>" . $carsRented . "</h2>"
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
                          <th> Car Name </th>
                          <th> Car model </th>
                          <th> Car year </th>
                          <th> Cost per week </th>
                          <th> Rented </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($cars as $car) : ?>
                          <?php
                          $isRented = $car['status'] == 'rented' ? "badge badge-outline-success" : 'badge badge-outline-danger';
                          $isRentedDesc = $car['status'] == 'rented' ? "True" : 'False';
                          ?>
                          <tr id="user-row-<?= $car['id'] ?>">
                            <td>
                              <div class='form-check form-check-muted m-0'>
                                <label class='form-check-label'>
                                  <input type='checkbox' class='form-check-input user-checkbox' data-car-id="<?= $car['id'] ?>">
                                </label>
                              </div>
                            </td>
                            <td><?= $car['car_name'] ?></td>
                            <td><?= $car['car_model'] ?></td>
                            <td><?= $car['car_year'] ?></td>
                            <td><?= $car['costPerDay'] ?></td>
                            <td>
                              <div class='<?= $isRented ?>'><?= $isRentedDesc ?></div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    <div class="mt-4">
                      <!-- Existing table here -->
                      <button id="delete-cars" class="btn btn-danger">Delete selected cars</button>
                    </div>


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial -->

        <div>

        </div>
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
  <script src="../assets/js/carsTableForm.js"></script>
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

  <script>
    let form = document.getElementById('addCarForm')

    function resetForm() {
      form.reset();
    }

    let imageCarInput = document.querySelector('.imageNameInput')

    function addImageNameToInput(inputElement) {
      const imageCarInput = document.querySelector('.imageNameInput');
      if (inputElement.files && inputElement.files.length > 0) {
        imageCarInput.value = inputElement.files[0].name;
      }
    }
  </script>
</body>

</html>