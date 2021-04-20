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
        header("location: login.php");
    }
    $currentDate = date("Y-m-d");
    $sqlTable = "SELECT * FROM EMP_SYMPTOMS";
    $resultTable = $conn->query($sqlTable);
    //gettig employee names for table filter
    $sql3 = "SELECT EMP_FNAME, EMP_LNAME FROM EMPLOYEE";
    $result3 = mysqli_query($conn,$sql3);
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
            }
            /*css for hiding rows that don't match filter on table*/
            
            .hidden-row {
                display: none;
            }
            /*aligning cell data with headers*/
            
            td,
            th {
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
                            <h5 class="card-title">Employee Status History</h5> </div>
                        <div class="table-responsive card-body">
                            <!--<input id="myInput" type="text" placeholder="Search..">-->
                            <!--line between potential search bar and table-->
                            <hr />
                            <table class="table table-striped table-hover filter-table">
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
                                        <th scope="col">SIGNATURE</th>
                                        <th scope="col">Submit Date</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">
                                            <select class="filter" id="name_sort" data-field="Name">
                                                <option value="">All</option>
                                                <?php 
                                            //filter for names grabs all employee names from employee table so that it 
                                            //populates options without duplicates and new employees will be auto added to 
                                            //the dropdown even without a form submission in the history yet
                                                            if ($result3->num_rows > 0) { 
                                                                while($row3 = $result3->fetch_assoc()) {
                                                                    $name = $row3["EMP_FNAME"] . " " . $row3["EMP_LNAME"];
                                                                    echo "<option value='{$name}'>{$name}</option>";
                                                                }
                                        
                                                            } else {
                                                                echo "No Employees";
                                                            }
                                                        ?>
                                                    <!--hardcoded values for initial testing just to see if names worked
                                                    <option value="Carmia Smith">Carmia Smith</option>
                                            <option value="John Doe">John Doe</option>-->
                                            </select>
                                        </th>
                                        <th scope="col">
                                            <select class="filter" data-field="Status">
                                                <option value="">All</option>
                                                <option value="OK">OK</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </th>
                                        <th scope="col">
                                            <select class="filter" data-field="Fever">
                                                <option value="">All</option>
                                                <option value="no">no</option>
                                                <option value="yes">yes</option>
                                            </select>
                                        </th>
                                        <th scope="col">
                                            <select class="filter" data-field="Cough">
                                                <option value="">All</option>
                                                <option value="no">no</option>
                                                <option value="yes">yes</option>
                                            </select>
                                        </th>
                                        <th scope="col">
                                            <select class="filter" data-field="Shortness of Breath">
                                                <option value="">All</option>
                                                <option value="no">no</option>
                                                <option value="yes">yes</option>
                                            </select>
                                        </th>
                                        <th scope="col">
                                            <select class="filter" data-field="Congestion">
                                                <option value="">All</option>
                                                <option value="no">no</option>
                                                <option value="yes">yes</option>
                                            </select>
                                        </th>
                                        <th scope="col">
                                            <select class="filter" data-field="Aches">
                                                <option value="">All</option>
                                                <option value="no">no</option>
                                                <option value="yes">yes</option>
                                            </select>
                                        </th>
                                        <th scope="col">
                                            <select class="filter" data-field="Loss of Taste/Smell">
                                                <option value="">All</option>
                                                <option value="no">no</option>
                                                <option value="yes">yes</option>
                                            </select>
                                        </th>
                                        <th scope="col">
                                            <select class="filter" data-field="Headache">
                                                <option value="">All</option>
                                                <option value="no">no</option>
                                                <option value="yes">yes</option>
                                            </select>
                                        </th>
                                        <th scope="col">
                                            <select class="filter" data-field="Diarrhea">
                                                <option value="">All</option>
                                                <option value="no">no</option>
                                                <option value="yes">yes</option>
                                            </select>
                                        </th>
                                        <th scope="col">
                                            <select class="filter" data-field="Nausea">
                                                <option value="">All</option>
                                                <option value="no">no</option>
                                                <option value="yes">yes</option>
                                            </select>
                                        </th>
                                        <th scope="col">
                                            <select class="filter" data-field="COVID Positive">
                                                <option value="">All</option>
                                                <option value="no">no</option>
                                                <option value="yes">yes</option>
                                            </select>
                                        </th>
                                        <th scope="col">
                                            <select class="filter" data-field="COVID Exposed">
                                                <option value="">All</option>
                                                <option value="no">no</option>
                                                <option value="yes">yes</option>
                                            </select>
                                        </th>
                                        <th>
                                            <!--empty table data for space since signature doesn't have sorting-->
                                        </th>
                                        <th scope="col">
                                            <input type="date" class="filter" data-field="Submit Date" id="Date" name="Date"> </th>
                                        <p style="text-align:right; font-size:9pt;">Reset Date: Press backspace
                                            <br>until all fields are mm/dd/yyyy</p>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
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
                                        $insertDate = $rowTable['EMP_DATE_INSERT'];
                                        $empSignature = $rowTable['EMP_SIGNATURE'];
                                        echo "<tr class='content'>";
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
                                        echo '<td class=signature>'.$empSignature.'</td>';
                                        echo '<td>'.$insertDate.'</td>';
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
                            <div class="stats"> <a href="admin_symp_history.php"><i class="fa fa-history"></i></a> Refresh </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--links for the table filtering with jquery
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        <!-- Include all compiled plugins (below), or include individual files as needed 
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
        <script type="text/javascript">
            //filters 
            var table = document.querySelector('.filter-table')
                , filterState = {};
            var dataFromRow = (row, headers) => Object.fromEntries([...row.querySelectorAll('td')].map((td, index) => [headers[index], td.textContent]));
            var matchesCriteria = (rowData, filters) => filters.every(([key, value]) => rowData[key] === value);
            var refresh = () => {
                var headers = [...table.querySelectorAll('thead th')].map(th => th.textContent)
                    , filters = Object.entries(filterState)
                    , showAll = filters.length === 0;
                table.querySelectorAll('tbody tr').forEach(row => {
                    var show = showAll || matchesCriteria(dataFromRow(row, headers), filters);
                    row.classList.toggle('hidden-row', !show);
                });
            };
            var handleFilterChange = (e) => {
                var field = e.target.dataset.field
                    , value = e.target.value;
                if (value) {
                    filterState[field] = value;
                }
                else {
                    delete filterState[field];
                }
                refresh();
            };
            document.querySelectorAll('.filter').forEach(filter => filter.addEventListener('change', handleFilterChange));
            //function for nav bar
            function myFunction() {
                var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                }
                else {
                    x.className = "topnav";
                }
            }
            //function for search bar
            //$(document).ready(function () {
            //$("#myInput").on("keyup", function () {
            //var value = $(this).val().toLowerCase();
            //$("#myTable tr").filter(function () {
            //$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            //});
            //});
            //});
        </script>
        <?php $conn->close(); ?>
    </body>

    </html>