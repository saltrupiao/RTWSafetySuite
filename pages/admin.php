<?php
    //every page after login will need this php code for session
    session_start();

    //user session stored in variable
    $adminuser = $_SESSION['login_user'];
    $serverName = "localhost";//always stays the same between local and main server
    $userName = "user";
    $password = "oakland";
    $dbName = "test";

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
        header("location: login.php");
    }
    $currentDate = date("Y-m-d");
    $sqlTable = "SELECT * FROM EMP_SYMPTOMS WHERE EMP_DATE_INSERT = '$currentDate'";
    $resultTable = $conn->query($sqlTable);
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
        <title> Admin Dashboard </title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
        <style>
            /*font style for employee signature*/
            
            .signature {
                font-family: cursive;
                text-align: center;
            }
            /*centered text for table headers and data in main table*/
            
            .heading,
            .data {
                text-align: center;
            }
        </style>
    </head>

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
                            <h5 class="card-title">Employee Status Overview</h5> </div>
                        <div class="table-responsive card-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="heading">Name</th>
                                        <th scope="col" class="heading">Status</th>
                                        <th scope="col" class="heading">Fever</th>
                                        <th scope="col" class="heading">Cough</th>
                                        <th scope="col" class="heading">Shortness
                                            <br>of Breath</th>
                                        <th scope="col" class="heading">Congestion</th>
                                        <th scope="col" class="heading">Aches</th>
                                        <th scope="col" class="heading">Loss of
                                            <br>Taste/Smell</th>
                                        <th scope="col" class="heading">Headache</th>
                                        <th scope="col" class="heading">Diarrhea</th>
                                        <th scope="col" class="heading">Nausea</th>
                                        <th scope="col" class="heading">COVID
                                            <br>Positive</th>
                                        <th scope="col" class="heading">COVID
                                            <br>Exposed</th>
                                        <th scope="col" class="heading">SIGNATURE</th>
                                        <th scope="col" class="heading">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                //Logic base reference: https://www.w3schools.com/php/php_mysql_select.asp
                                if ($resultTable->num_rows > 0) {
                                    while ($rowTable = $resultTable->fetch_assoc()) {
                                        $empID = $rowTable['EMP_ID'];
                                        $name = "";
                                        $sqlFLName = "SELECT EMP_FNAME, EMP_LNAME, EMP_STATUS FROM EMPLOYEE WHERE EMP_ID = $empID";
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
                                        $empSignature = $rowTable['EMP_SIGNATURE'];
                                        if ($status == "OK") {
                                            echo "<tr style=background:lightgreen;>";
                                        } else {
                                            echo "<tr style=background:lightcoral;>";
                                        }
                                        //echo "<tr>";
                                        echo '<td class="data">'.$empFullName.'</td>';
                                        echo '<td class="data">'.$status.'</td>';
                                        echo '<td class="data">'.$fever.'</td>';
                                        echo '<td class="data">'.$cough.'</td>';
                                        echo '<td class="data">'.$shortnessBreath.'</td>';
                                        echo '<td class="data">'.$congestion.'</td>';
                                        echo '<td class="data">'.$aches.'</td>';
                                        echo '<td class="data">'.$lossTasteSmell.'</td>';
                                        echo '<td class="data">'.$headache.'</td>';
                                        echo '<td class="data">'.$d.'</td>';
                                        echo '<td class="data">'.$nausea.'</td>';
                                        echo '<td class="data">'.$covidPositive.'</td>';
                                        echo '<td class="data">'.$covidExposed.'</td>';
                                        echo '<td class="signature">'.$empSignature.'</td>';
                                        echo '<td class="data"><form action="./controller/adminController.php" method="post"><input type="hidden" id="empID" name="empID" value="'.$empID.'"><button type="submit" class="btn btn-secondary" value="Submit">OVERRIDE</button></form></td>';
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<h1> 0 results </h1>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats"> <a href="admin.php"><i class="fa fa-history"></i></a> Refresh </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-11">
                    <div class="card">
                        <div class="card-header ">
                            <h5 class="card-title">Company-Wide Statistics</h5> </div>
                        <div class="table-responsive card-body">
                            <table class="table table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <td>Non-Cleared Employees</td>
                                        <?php
                                        $sqlGetNOCount = "SELECT EMP_STATUS, count(EMP_STATUS) FROM EMPLOYEE WHERE EMP_STATUS = 'NO' GROUP by EMP_STATUS";
                                        $resultGetNOCount = $conn->query($sqlGetNOCount);
                                        while ($rowGetNOCount = $resultGetNOCount -> fetch_row()) {
                                            echo "<td>" . $rowGetNOCount[1] . "</td>";
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <td>Cleared Employees</td>
                                        <?php
                                        $sqlGetNOCount = "SELECT EMP_STATUS, count(EMP_STATUS) FROM EMPLOYEE WHERE EMP_STATUS = 'OK' GROUP by EMP_STATUS";
                                        $resultGetNOCount = $conn->query($sqlGetNOCount);
                                        while ($rowGetNOCount = $resultGetNOCount -> fetch_row()) {
                                            echo "<td>" . $rowGetNOCount[1] . "</td>";
                                        }
                                        ?>
                                    </tr>
                                    <!--<tr>
                                        <td>Employees With No Submission</td>
                                        <?php
                                        $sqlGetNOCount = "SELECT EMP_STATUS, count(EMP_STATUS) FROM EMPLOYEE WHERE EMP_STATUS = NULL GROUP by EMP_STATUS";
                                        $resultGetNOCount = $conn->query($sqlGetNOCount);
                                        while ($rowGetNOCount = $resultGetNOCount -> fetch_row()) {
                                            echo "<td>" . $rowGetNOCount[1] . "</td>";
                                        }
                                        ?>
                                    </tr>-->
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats"> <a href="admin.php"><i class="fa fa-history"></i></a> Refresh </div>
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
        <?php $conn->close(); ?>
    </body>

    </html>