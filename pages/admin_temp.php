<?php
    //every page after login will need this php code for session
    session_start();

    //user session stored in variable
    $adminuser = $_SESSION['login_user'];
    $serverName = "localhost";//always stays the same between local and main server
    $userName = "user";
    $password = "oakland";
    $dbName = "rtwdb";

    // Create connection
    $conn = mysqli_connect($serverName, $userName , $password, $dbName);

    //selecting the is admin
    $sql = "SELECT EMP_ISADMIN FROM EMPLOYEE WHERE EMP_USERID = '$adminuser'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];
    if($row["EMP_ISADMIN"] == "1"){
        //ensuring admin session
        //echo "Welcome" . " " . $adminuser;
    }else{
        //if not an admin, resets back to login
        unset($adminuser);
        header("location: login.html");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
    <link href="../css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
    <link href="../css/demo.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
    Admin Dashboard
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
</head>

<body>
    <section id="nav-bar">

        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <h3><a href="admin_temp.php"><b>Return To Work Safety Suite - Admin</b></a></h3>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href=".">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-manage.php">Manage Employees</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-distance.php">Distance Tracking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./controller/logout.php">LOGOUT&nbsp;</a>
                        <p class="nav-link"><?php echo "Welcome" . " " . $adminuser; ?></p>
                        <p class="nav-link">|</p>
                    </li>
                </ul>
            </div>
        </nav>
    </section>
    <div class="row">
        <div class="col-lg-11">
            <div class="card ">
                <div class="card-header ">
                    <h5 class="card-title">Admin Dashboard</h5>
                    <p class="card-category">Data goes here!</p>
                </div>
                <div class="card-body ">
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-history"></i> This is the footer
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
