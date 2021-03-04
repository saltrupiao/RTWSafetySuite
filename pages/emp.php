<?php
//every page after login will need this php code for session
session_start();
//user session variable stored in emp
$emp = $_SESSION['login_user'];
$serverName = "localhost";//always stays the same between local and main server
$userName = "user";
$password = "oakland";
$dbName = "rtwdb";
// Create connection
$conn = mysqli_connect($serverName, $userName , $password, $dbName);
//selecting the is admin
$sql = "SELECT EMP_ISADMIN FROM EMPLOYEE WHERE EMP_USERID = '$emp'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$active = $row['active'];
if($row["EMP_ISADMIN"] == "0"){
    //ensuring regular user session
    //echo "Welcome " . " " . $emp;
}else{
    //if not a regular user, resets back to login
    unset($emp);
    header("location: login.html");
}

//html
//echo "<br>Welcome to COVID Safety Suite";
//echo "<br>";
//echo "<a href=controller/logout.php>Logout</a>";
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <link href="../css/bootstrap.min.css" rel="stylesheet" />
        <link href="../css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
        <link href="../css/demo.css" rel="stylesheet" />
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title> Employee Dashboard </title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

        <section id="nav-bar">
            <div class="topnav" id="myTopnav"> <a href="admin.php"><b>Return To Work Safety Suite - Employee</b></a> <a class="nav-link" href="./controller/logout.php">Logout&nbsp;</a>
                <a class="nav-link">
                    <?php echo "Welcome" . " " . $emp; ?>
                </a>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()"> <i class="fa fa-bars"></i> </a>
            </div>
        </section>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header ">
                            <h5 class="card-title">Employee Status Overview</h5> </div>
                            <div class="table-responsive card-body">
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header ">
                                            <h5 class="card-title">Employee Status Overview</h5> </div>
                                        <div class="table-responsive card-body">
                                            //insert data for the left side card here
                                        </div>
                                        <div class="card-footer ">
                                            <hr>
                                            <div class="stats"> <i class="fa fa-history"></i> This is the footer </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="float-md-right">
                                    <div class="col-md-6">
                                        //insert data for the right side card here
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats"> <i class="fa fa-history"></i> This is the footer </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function myFunction() {
                    var x = document.getElementById("myTopnav");
                    if (x.className === "topnav") {
                        x.className += " responsive";
                    }
                    else {
                        x.className = "topnav";
                    }
                }
            </script>
        </div>
    </body>

    </html>