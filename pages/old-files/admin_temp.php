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
$sql = "SELECT EMP_ISADMIN FROM employee WHERE EMP_USERID = '$adminuser'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$active = $row['active'];
if($row["EMP_ISADMIN"] == "1"){
    //ensuring admin session
    //echo "Welcome" . " " . $adminuser;
}else{
    //if not an admin, resets back to login
    unset($adminuser);
    header("location: login.php");
}

$sqlTable = "SELECT * FROM emp_symptom";
$resultTable = $conn->query($sqlTable);

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <link href="../../css/bootstrap.min.css" rel="stylesheet" />
        <link href="../../css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
        <link href="../../css/demo.css" rel="stylesheet" />
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title> Admin Dashboard </title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' /> </head>

    <body>
        <section id="nav-bar">
            <div class="topnav" id="myTopnav"> <a href="admin_temp.php"><b>Return To Work Safety Suite - Admin</b></a> <a class="nav-link" href="../admin_manage.php">Manage Employees</a> <a class="nav-link" href="../admin_distance.php">Distance Tracking</a> <a class="nav-link" href="../controller/logout.php">LOGOUT&nbsp;</a> <span class="navbar-text"><?php echo "Welcome" . " " . $adminuser; ?></span>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()"> <i class="fa fa-bars"></i> </a>
            </div>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container-fluid"> <a class="navbar-brand" href="#">RTW Safety Suite - Admin</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav"> <a class="nav-link active" aria-current="page" href="#">Employee Stats</a> <a class="nav-link" href="../admin_manage.php">Manage Employees</a> <a class="nav-link" href="../admin_distance.php">Distance Tracking</a> <a class="nav-link" href="../controller/logout.php" tabindex="-1">LOGOUT</a>
                            <a class="nav-link">
                                <?php echo "Welcome" . " " . $adminuser; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </section>
        <div class="row">
            <div class="col-lg-11">
                <div class="card">
                    <div class="card-header ">
                        <h5 class="card-title">Employee Status Overview</h5> </div>
                    <div class="table-responsive card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Fever</th>
                                    <th scope="col">Cough</th>
                                    <th scope="col">Shortness of Breath</th>
                                    <th scope="col">Congestion</th>
                                    <th scope="col">Aches</th>
                                    <th scope="col">Loss of Taste/Smell</th>
                                    <th scope="col">Headache</th>
                                    <th scope="col">Diarrhea</th>
                                    <th scope="col">Nausea</th>
                                    <th scope="col">COVID Positive</th>
                                    <th scope="col">COVID Exposed</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //Logic base reference: https://www.w3schools.com/php/php_mysql_select.asp
                                if ($resultTable->num_rows > 0) {
                                    while ($rowTable = $resultTable->fetch_assoc()) {
                                        $empID = $rowTable['EMP_ID'];
                                        $name = "";

                                        $sqlFLName = "SELECT EMP_FNAME, EMP_LNAME, EMP_STATUS FROM employee WHERE EMP_ID = $empID";
                                        $resultFLName = $conn->query($sqlFLName);
                                        while ($rowFLName = $resultFLName->fetch_assoc()) {
                                            $empFname = $rowFLName['EMP_FNAME'];
                                            $empLname = $rowFLName['EMP_LNAME'];
                                            $status = $rowFLName['EMP_STATUS'];
                                        }
                                        $empFullName = $empFname . " " . $empLname;

                                        $fever = $rowTable['SYMP_FEAVER'];
                                        $cough = $rowTable['SYMP_COUGH'];
                                        $shortnessBreath = $rowTable['SYMP_BREATH'];
                                        $congestion = $rowTable['SYMP_CONGEST'];
                                        $aches = $rowTable['SYMP_ACHES'];
                                        $lossTasteSmell = $rowTable['SYMP_TS'];
                                        $headache = $rowTable['SYMP_HEADACHE'];
                                        $d = $rowTable['SYMP_DIARRHEA'];
                                        $nausea = $rowTable['SYMP_NAUS'];
                                        $covidPositive = $rowTable['SYMP_COVIDPOS'];
                                        $covidExposed = $rowTable['SYMP_COVIDEXPOS'];
                                        echo "<tr>";
                                        echo '<td>'.$empFullName.'</td>';
                                        echo '<td>'.$status.'</td>';
                                        echo '<td>'.$fever.'</td>';
                                        echo '<td>'.$cough.'</td>';
                                        echo '<td>'.$shortnessBreath.'</td>';
                                        echo '<td>'.$congestion.'</td>';
                                        echo '<td>'.$aches.'</td>';
                                        echo '<td>'.$lossTasteSmell.'</td>';
                                        echo '<td>'.$headache.'</td>';
                                        echo '<td>'.$d.'</td>';
                                        echo '<td>'.$nausea.'</td>';
                                        echo '<td>'.$covidPositive.'</td>';
                                        echo '<td>'.$covidExposed.'</td>';
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<h1> 0 results </h1>";
                                }
                                $conn->close();
                            ?>
                                    <!--<tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>test</td>
                                <td>test2</td>
                                <td>@twitter</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                            </tr>-->
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats"> <i class="fa fa-history"></i> This is the footer </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-11">
                <div class="card">
                    <div class="card-header ">
                        <h5 class="card-title">Company-Wide Statistics</h5> </div>
                    <div class="card-body "> </div>
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
    </body>

    </html>