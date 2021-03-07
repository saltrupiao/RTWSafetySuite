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
//query for employee information
$sql2 = "SELECT EMP_ID, EMP_FNAME, EMP_LNAME, EMP_DEPT, EMP_STATUS FROM EMPLOYEE WHERE EMP_USERID = '$emp'";
$result2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
//assigning variables 
$emp_id = $row2["EMP_ID"];
$emp_name = $row2["EMP_FNAME"] . " " . $row2["EMP_LNAME"];
$emp_dept = $row2["EMP_DEPT"];
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
            <div class="topnav" id="myTopnav"> <a href="emp.php"><b>Return to Work Safety Suite - Employee</b>
                <a class="nav-link">
                    <?php echo "Welcome" . " " . $emp; ?>
                </a></a> <a class="nav-link" href="./controller/logout.php">Logout&nbsp;</a>
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
                            <h4 class="card-title">Employee Dashboard</h4> </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header ">
                                            <h4 class="card-title">Employee Health Screening Form</h4> </div>
                                        <div class="table-responsive card-body"> //insert data for the left side card here </div>
                                        <div class="card-footer">
                                            <hr>
                                            <div class="stats"> <i class="fa fa-history"></i> This is the footer </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <!--Information box-->
                                            <h4 class="card-title">Employee Information</h4></div>
                                        <div class="card-body">
                                            <h5>Name: <?php echo "$emp_name"; ?></h5>
                                            <h5>Employee ID: <?php echo "$emp_id"; ?></h5>
                                            <h5>Department: <?php echo "$emp_dept"; ?></h5> </div>
                                    </div>
                                    <!--Employee status-->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title text-center">Employee Status</h5></div>
                                        <div class="card-body">
                                            <?php
                                            //if status in employee table in database is OK it displays
                                            //the green checkmark for cleared
                                                if ($row2["EMP_STATUS"] == "OK"){
                                                    echo "<img src='../icons/checkmark.svg' class='img-fluid rounded mx-auto d-block' alt='Cleared for Work'><br><h5 class='text-center'>CLEARED</h5>";
                                                    
                                                }
                                            //if status in employee table in database is NO it dsiplays
                                            //the red cross for staying home
                                                elseif ($row2["EMP_STATUS"] == "NO") {
                                                    echo "<img src='../icons/cross.svg' class='img-fluid rounded mx-auto d-block' alt='Not Cleared for Work, Stay Home'><br><h5 class='text-center'>STAY HOME</h5>";
                                                }
                                            //if neither OK or NO is in database it displays message to fill out form
                                            else {
                                                echo "<h4>You currently do not have a form entry. <br>Please fill out the health screening form to find out your status.</h4>";
                                            }
                                            ?> </div>
                                    </div>
                                    <!--certification results-->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Certification of Results</h5></div>
                                        <div class="card-body">
                                            <p class="font-weight-bold">By submitting the Health Screening Form, you certify that your answers are accurate and truthful to the best of your abilities. Doing so ensures you and your fellow employees are kept safe.
                                                <br>
                                                <br>Any intentional false statements on this reporting form may result in disciplinary action in accordance with company policy.</p>
                                        </div>
                                    </div>
                                </div>
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
        </div>
    </body>

    </html>