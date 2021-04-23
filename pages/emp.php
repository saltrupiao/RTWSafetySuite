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
$sql = "SELECT EMP_ISADMIN FROM employee WHERE EMP_USERID = '$emp'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$active = $row['active'];
if($row["EMP_ISADMIN"] == "0"){
    //ensuring regular user session
    //echo "Welcome " . " " . $emp;
}else{
    //if not a regular user, resets back to login
    unset($emp);
    header("location: login.php");
}
//query for employee information
$sql2 = "SELECT EMP_ID, EMP_FNAME, EMP_LNAME, EMP_DEPT, EMP_STATUS FROM employee WHERE EMP_USERID = '$emp'";
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
        <link href="../css/main.css" rel="stylesheet" media="all">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link href="../css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
        <link href="../css/font-awesome.min.css" rel="stylesheet" media="all">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
        <link href="../css/select2.min.css" rel="stylesheet" media="all">
        <link href="../css/daterangepicker.css" rel="stylesheet" media="all">
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
                                        <?php
                                            $currentDate = date("Y-m-d");
                                            $sqlMostRecentRecord = "SELECT EMP_DATE_INSERT FROM emp_symptoms WHERE EMP_DATE_INSERT = '$currentDate' AND EMP_ID = '$emp_id'";
                                            $resultsMostRecentRecord = $conn->query($sqlMostRecentRecord);
                                            if ($resultsMostRecentRecord -> num_rows > 0) {
                                                echo "<div class='table-responsive card-body'>
                                                        <div class='form-row m-b-55'>
                                                            <div class='container'>
                                                                <h4>Thanks for doing your part to keep the workplace safe!</h4>
                                                            </div>
                                                        </div>
                                                      </div>";
                                            } else {
                                                echo '<div class="table-responsive card-body">
                                            <div class="form-row m-b-55">
                                                <div class="container">
                                                    <form method="post" action="controller/empController.php">
                                                        <h4>In the past 48 hours, have you had any of these symptoms:</h4>
                                                        <br> Fever (100.4 or higher) or feeling feverish or chills:
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="fever" id="feverYes" value="yes" required />
                                                            <label class="form-check-label" for="feverYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="fever" id="feverNo" value="no" required />
                                                            <label class="form-check-label" for="feverNo">No</label>
                                                        </div>
                                                        <br> Uncontrolled cough that you cannot attribute to another health condition (example: allergies, asthma): &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="cough" id="coughYes" value="yes" required />
                                                            <label class="form-check-label" for="coughYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="cough" id="coughNo" value="no" required />
                                                            <label class="form-check-label" for="coughNo">No</label>
                                                        </div>
                                                        <br> Shortness of breath you cannot attribute to another health condition (example: asthma): &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="breath" id="breathYes" value="yes" required />
                                                            <label class="form-check-label" for="breathYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="breath" id="breathNo" value="no" required />
                                                            <label class="form-check-label" for="breathNo">No</label>
                                                        </div>
                                                        <br> Sore throat you cannot attribute to another health condition (example: allergies): &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="soreThroat" id="soreThroatYes" value="yes" required />
                                                            <label class="form-check-label" for="soreThroatYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="soreThroat" id="soreThroatNo" value="no" required />
                                                            <label class="form-check-label" for="soreThroatNo">No</label>
                                                        </div>
                                                        <br> Nasal congestion or runny nose you cannot attribute to another health condition (example: allergies): &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="congest" id="congestYes" value="yes" required />
                                                            <label class="form-check-label" for="congestYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="congest" id="congestNo" value="no" required />
                                                            <label class="form-check-label" for="congestNo">No</label>
                                                        </div>
                                                        <br> Muscle aches you cannot attribute to another health condition (example: injury, exercise): &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="aches" id="achesYes" value="yes" required />
                                                            <label class="form-check-label" for="achesYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="aches" id="achesNo" value="no" required />
                                                            <label class="form-check-label" for="achesNo">No</label>
                                                        </div>
                                                        <br> Loss of taste or smell that is new and you cannot attribute to another health condition: &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="tasteSmell" id="tasteSmellYes" value="yes" required />
                                                            <label class="form-check-label" for="tasteSmellYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="tasteSmell" id="tasteSmellNo" value="no" required />
                                                            <label class="form-check-label" for="tasteSmellNo">No</label>
                                                        </div>
                                                        <br> Headache that you cannot attribute to another health condition: &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="headache" id="headacheYes" value="yes" required />
                                                            <label class="form-check-label" for="headacheYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="headache" id="headacheNo" value="no" required />
                                                            <label class="form-check-label" for="headacheNo">No</label>
                                                        </div>
                                                        <br> Diarrhea you cannot attribute to another health condition (example: IBS): &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="d" id="dYes" value="yes" required />
                                                            <label class="form-check-label" for="dYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="d" id="dNo" value="no" required />
                                                            <label class="form-check-label" for="dNo">No</label>
                                                        </div>
                                                        <br> Nausea or vomiting that you cannot attribute to another health condition (example: pregnancy): &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="nausea" id="nauseaYes" value="yes" required />
                                                            <label class="form-check-label" for="nauseaYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="nausea" id="nauseaNo" value="no" required />
                                                            <label class="form-check-label" for="nauseaNo">No</label>
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <hr>
                                                        <br>
                                                        <h6>Answer the following questions to the best of your knowledge:</h6> Have you tested positive for COVID-19 in the past 10 days? (Only a viral test, not a blood antibody test) &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="covidPositive" id="covidPositiveYes" value="yes" required />
                                                            <label class="form-check-label" for="covidPositiveYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="covidPositive" id="covidPositiveNo" value="no" required />
                                                            <label class="form-check-label" for="covidPositiveNo">No</label>
                                                        </div>
                                                        <br> Have you had known, unprotected exposure (for healthcare workers) or close contact (within 6 feet for 15 minutes or longer) with someone diagnosed with COVID-19 in the past 14 days? &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="exposure" id="exposureYes" value="yes" required />
                                                            <label class="form-check-label" for="exposureYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="exposure" id="exposureNo" value="no" required />
                                                            <label class="form-check-label" for="exposureNo">No</label>
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <hr>
                                                        <br>
                                                        <div class="form-group">
                                                            <label for="signatureBox">By typing your name, you are electronically signing that your responses are accurate to the best of your knowledge:</label>
                                                            <br>
                                                            <br>
                                                            <input type="text" class="form-control" id="signatureBox" name="signatureBox" placeholder="Enter Electronic Signature Here..."> </div>
                                                        <br>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <br>
                                                        <br> </form>
                                                </div>
                                            </div>
                                        </div>';
                                            }
                                        ?>
                                            <!--<div class="table-responsive card-body">
                                            <div class="form-row m-b-55">
                                                <div class="container">
                                                    <form method="post" action="controller/empController.php">
                                                        <h4>In the past 48 hours, have you had any of these symptoms:</h4>
                                                        <br> Fever (100.4 or higher) or feeling feverish or chills:
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="fever" id="feverYes" value="yes">
                                                            <label class="form-check-label" for="feverYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="fever" id="feverNo" value="no">
                                                            <label class="form-check-label" for="feverNo">No</label>
                                                        </div>
                                                        <br> Uncontrolled cough that you cannot attribute to another health condition (example: allergies, asthma): &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="cough" id="coughYes" value="yes">
                                                            <label class="form-check-label" for="coughYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="cough" id="coughNo" value="no">
                                                            <label class="form-check-label" for="coughNo">No</label>
                                                        </div>
                                                        <br> Shortness of breath you cannot attribute to another health condition (example: asthma): &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="breath" id="breathYes" value="yes">
                                                            <label class="form-check-label" for="breathYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="breath" id="breathNo" value="no">
                                                            <label class="form-check-label" for="breathNo">No</label>
                                                        </div>
                                                        <br> Sore throat you cannot attribute to another health condition (example: allergies): &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="soreThroat" id="soreThroatYes" value="yes">
                                                            <label class="form-check-label" for="soreThroatYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="soreThroat" id="soreThroatNo" value="no">
                                                            <label class="form-check-label" for="soreThroatNo">No</label>
                                                        </div>
                                                        <br> Nasal congestion or runny nose you cannot attribute to another health condition (example: allergies): &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="congest" id="congestYes" value="yes">
                                                            <label class="form-check-label" for="congestYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="congest" id="congestNo" value="no">
                                                            <label class="form-check-label" for="congestNo">No</label>
                                                        </div>
                                                        <br> Muscle aches you cannot attribute to another health condition (example: injury, exercise): &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="aches" id="achesYes" value="yes">
                                                            <label class="form-check-label" for="achesYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="aches" id="achesNo" value="no">
                                                            <label class="form-check-label" for="achesNo">No</label>
                                                        </div>
                                                        <br> Loss of taste or smell that is new and you cannot attribute to another health condition: &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="tasteSmell" id="tasteSmellYes" value="yes">
                                                            <label class="form-check-label" for="tasteSmellYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="tasteSmell" id="tasteSmellNo" value="no">
                                                            <label class="form-check-label" for="tasteSmellNo">No</label>
                                                        </div>
                                                        <br> Headache that you cannot attribute to another health condition: &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="headache" id="headacheYes" value="yes">
                                                            <label class="form-check-label" for="headacheYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="headache" id="headacheNo" value="no">
                                                            <label class="form-check-label" for="headacheNo">No</label>
                                                        </div>
                                                        <br> Diarrhea you cannot attribute to another health condition (example: IBS): &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="d" id="dYes" value="yes">
                                                            <label class="form-check-label" for="dYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="d" id="dNo" value="no">
                                                            <label class="form-check-label" for="dNo">No</label>
                                                        </div>
                                                        <br> Nausea or vomiting that you cannot attribute to another health condition (example: pregnancy): &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="nausea" id="nauseaYes" value="yes">
                                                            <label class="form-check-label" for="nauseaYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="nausea" id="nauseaNo" value="no">
                                                            <label class="form-check-label" for="nauseaNo">No</label>
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <hr>
                                                        <br>
                                                        <h6>Answer the following questions to the best of your knowledge:</h6> Have you tested positive for COVID-19 in the past 10 days? (Only a viral test, not a blood antibody test) &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="covidPositive" id="covidPositiveYes" value="yes">
                                                            <label class="form-check-label" for="covidPositiveYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="covidPositive" id="covidPositiveNo" value="no">
                                                            <label class="form-check-label" for="covidPositiveNo">No</label>
                                                        </div>
                                                        <br> Have you had known, unprotected exposure (for healthcare workers) or close contact (within 6 feet for 15 minutes or longer) with someone diagnosed with COVID-19 in the past 14 days? &nbsp;&nbsp;
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="exposure" id="exposureYes" value="yes">
                                                            <label class="form-check-label" for="exposureYes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="exposure" id="exposureNo" value="no">
                                                            <label class="form-check-label" for="exposureNo">No</label>
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <hr>
                                                        <br>
                                                        <div class="form-group">
                                                            <label for="signatureBox">By typing your name, you are electronically signing that your responses are accurate to the best of your knowledge:</label>
                                                            <br>
                                                            <br>
                                                            <input type="text" class="form-control" id="signatureBox" name="signatureBox" placeholder="Enter Electronic Signature Here..."> </div>
                                                        <br>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <br>
                                                        <br>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>-->
                                            <div class="card-footer">
                                                <hr>
                                                <div class="stats"><a href="emp.php"><i class="fa fa-history"></i></a> Refresh </div>
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