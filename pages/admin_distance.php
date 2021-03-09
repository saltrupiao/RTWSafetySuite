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
        <link href="../css/bootstrap.min.css" rel="stylesheet" />
        <link href="../css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
        <link href="../css/demo.css" rel="stylesheet" />
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/distance.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title> Admin Dashboard </title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' /> </head>

    <body>
        <div class="container-fluid">
            <section id="nav-bar">
                <div class="topnav" id="myTopnav"> <a href="admin.php"><b>Return To Work Safety Suite - Admin</b></a> <a class="nav-link" href="admin_manage.php">Manage Employees</a> <a class="nav-link" href="admin_distance.php">Distance Tracking</a> <a class="nav-link" href="admin_symp_history.php">Employee Submission History</a> <a class="nav-link" href="./controller/logout.php">LOGOUT&nbsp;</a>
                    <a class="nav-link">
                        <?php echo "Welcome" . " " . $adminuser; ?>
                    </a>
                    <a href="javascript:void(0);" class="icon" onclick="myFunction()"> <i class="fa fa-bars"></i> </a>
                </div>
            </section>
            <div class="row">
                <div class="col-lg-11">
                    <div class="card">
                        <div class="card-header ">
                            <h5 class="card-title">On-Site Distance Tracker</h5> </div>
                        <div class="card-body ">
                            <main>
                                <div class="container-fluid">
                                    <form>
                                        <table>
                                            <tr>
                                                <th>
                                                    <label>Location: </label>
                                                    <select name="location">
                                                        <option value="IT Area">IT Area</option>
                                                        <option value="Sales Area">Sales Area</option>
                                                        <option value="HR Area">HR Area</option>
                                                        <option value="Purchasing Area">Purchasing Area</option>
                                                        <option value="Maintenance Area">Maintenance Area</option>
                                                        <option value="Marketing Area">Marketing Area</option>
                                                    </select>
                                                </th>
                                            </tr>
                                            <tbody>
                                                <tr>
                                                    <td> <span>[Video Feed Shows Here]</span> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </main>
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