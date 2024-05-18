<?php
include_once('../php-logic/config.php');
include_once('../php-logic/header.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', './updateUsers.txt');
session_start();

$userID = isset($_GET['userID']) ? $_GET['userID'] : $_SESSION['edit_user_id'];
$_SESSION['edit_user_id'] = $userID;
$sql = 'SELECT * FROM users WHERE userID = ' . $userID;
$result = mysqli_query($conn, $sql);
$userData = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="../assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body style="background-color: black;" class="">
    <div class="container">
        <div class="row justify-center items-center h-dvh">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
            <?php
            if (isset($_SESSION['update_user_error_message'])) {
                echo "<p class='text-red-600'> " . $_SESSION['update_user_error_message'] . "</p>";

                // echo "<script>alert($errorMessage);</script>";

                unset($_SESSION['update_user_error_message']);
            }
            ?>
                        <h4 class="card-title"><?php echo $userData['first_name'] . " " . $userData['last_name'] ?></h4>
                        <form class="forms-sample" method="post" action="../php-logic/adminUpdateUserData.php">
                            <div class="form-group mb-3">
                                <label for="exampleInputUsername1">Username</label>
                                <input name="username" type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="<?php echo $userData['username'] ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleInputUsername1">First name</label>
                                <input name="first_name" type="text" class="form-control" id="exampleInputName1" placeholder="First Name" value="<?php echo $userData['first_name'] ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleInputUsername1">Last name</label>
                                <input name="last_name" type="text" class="form-control" id="exampleInputUsername1" placeholder="Last Name" value="<?php echo $userData['last_name'] ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleInputEmail1">Email address</label>
                                <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="<?php echo $userData['email'] ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleInputPassword1">Password</label>
                                <input name="password" type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" value="<?php echo $userData['password'] ?>">
                            </div>
                            <button class="text-green-600 border border-green-600 rounded-lg py-1 px-3 me-2 hover:text-black hover:bg-green-600 duration-300" type="submit" name='submit'>Save Changes</button>
                            <a href="../website/usersAdminDashboard.php" style="text-decoration: none;" class="text-slate-400 border border-slate-400 px-4 py-2 rounded-lg hover:text-black hover:bg-slate-400 duration-300">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>