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
}
else{
        //if not an admin, resets back to login
        unset($adminuser);
        header("location: login.html");
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link href="../css/bootstrap.min.css" rel="stylesheet" />
        <link href="../css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
        <link href="../css/demo.css" rel="stylesheet" />
        <link rel="stylesheet" href="../css/style.css">
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
            <?php
            //selecting all records
        $sql2 = "SELECT * FROM EMPLOYEE";
        //selecting all departments
        $sql3 = "SELECT * FROM DEPARTMENTS";
        
        $result2 = mysqli_query($conn,$sql2);
        $result3 = mysqli_query($conn,$sql3);
            
            
        if ($result2->num_rows > 0) {     
        //when dept is updated a success message will appear above table
        //gets global variable from backend php logic for updating dept
        if (!empty($_SESSION['dept_message'])) {
            $deptmsg = $_SESSION['dept_message'];
            //shows update message
            echo "<div class='card text-center'>
                    <div class='card-body d-flex justify-content-center'>
                        <div class='alert alert-warning alert-dismissible fade show card w-50 ' role='alert'> <strong> <p class='fs-6 text-center fw-bolder fs-4'>Success! $deptmsg</p></strong>
                        <a href='javascript:location.reload(true)' class='btn-close'></a>
                        </div>
                    </div>
                </div>";
            //click x button to get rid of message, reloads page to kill session variable
            //kills session variable when page refreshes
            unset ($_SESSION['dept_message']);
        } 
        //when page refreshes the messsage goes back to being empty until next update
        else {
        $deptmsg = null;
        }
        //when employee is added a sucess message is created from the session variable created in the backend logic
        if (!empty($_SESSION['add_message'])) {
            $addmsg = $_SESSION['add_message'];
            //shows add employee message
            echo "<div class='card text-center'>
                    <div class='card-body d-flex justify-content-center'>
                        <div class='alert alert-warning alert-dismissible fade show card w-50 ' role='alert'> <strong> <p class='fs-6 text-center fw-bolder fs-4'>Success! $addmsg</p></strong>
                        <a href='javascript:location.reload(true)' class='btn-close'></a>
                        </div>
                    </div>
                </div>";
            //click x button to get rid of message, reloads page to kill session variable
            //kills session variable when page refreshes
            unset ($_SESSION['add_message']);
        } 
        //when page refreshes the messsage goes back to being empty until next emp add
        else {
        $addmsg = null;
        }
        //when deletion of a record is successful it creates a success message from session variable created in backend logic
        if (!empty($_SESSION['del_message'])) {
            $delmsg = $_SESSION['del_message'];
            //shows message
            echo "<div class='card text-center'>
                    <div class='card-body d-flex justify-content-center'>
                        <div class='alert alert-warning alert-dismissible fade show card w-50 ' role='alert'> <strong> <p class='fs-6 text-center fw-bolder fs-4'>Success! $delmsg</p></strong>
                        <a href='javascript:location.reload(true)' class='btn-close'></a>
                        </div>
                    </div>
                </div>";
            //click x button to get rid of message, reloads page to kill session variable
            //kills session variable when page refreshes
            unset ($_SESSION['del_message']);
        } 
        //when page refreshes the messsage goes back to being empty until next deletion
        else {
        $delmsg = null;
        }
        //when password reset is successful it shows success message
        if (!empty($_SESSION['pw_message'])) {
            $pwmsg = $_SESSION['pw_message'];
            //shows message
            echo "<div class='card text-center'>
                    <div class='card-body d-flex justify-content-center'>
                        <div class='alert alert-warning alert-dismissible fade show card w-50 ' role='alert'> <strong> <p class='fs-6 text-center fw-bolder fs-4'>Success! $pwmsg</p></strong>
                        <a href='javascript:location.reload(true)' class='btn-close'></a>
                        </div>
                    </div>
                </div>";
            //click x button to get rid of message, reloads page to kill session variable
            //kills session variable when page refreshes
            unset ($_SESSION['pw_message']);
        } 
        //when page refreshes the messsage goes back to being empty until next reset
        else {
        $pwmsg = null;
        }
            
    } else {
            echo "O results";
        }
            ?>
                <div class="row">
                    <div class="col-lg-11">
                        <div class="card">
                            <div class="card-header ">
                                <h5 class="card-title">Employee Account Management</h5> </div>
                            <!--start of add employee form-->
                            <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
                                <button class='btn btn-primary btn-lg btn btn-info' data-bs-toggle='modal' data-bs-target='#exampleModal'>Add Employee</button>
                                <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='exampleModalLabel'>Add an Employee</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <form action='controller/addemp.php' method='post'>
                                                    <label class='form-label text-dark fw-bolder'>First Name:</label>
                                                    <input required type='text' name='fname' class='form-control' required>
                                                    <br>
                                                    <label class='form-label text-dark fw-bolder'>Last Name:</label>
                                                    <input required type='text' name='lname' class='form-control' required>
                                                    <br>
                                                    <label class='form-label text-dark fw-bolder'>Username:</label>
                                                    <input required type='text' name='uname' class='form-control' required>
                                                    <br>
                                                    <label class='form-label text-dark fw-bolder'>Department:</label>
                                                    <select name='dept' id='dept' class='form-select' required>
                                                        <!--validation from required statement won't allow for form submit without choosing an option with a value-->
                                                        <option value=''>[SELECT]</option>
                                                        <?php 
                                                            if ($result3->num_rows > 0) { 
                                                                while($row3 = $result3->fetch_assoc()) {
                                                                    $dept_choices = $row3["DEPARTMENT_NAME"];
                                                                    echo "<option value='{$dept_choices}'>{$dept_choices}</option>";
                                                                }
                                        
                                                            } else {
                                                                echo "No Departments";
                                                            }
                                                        ?>
                                                            <!--<option value='IT'>IT</option>
                                                            <option value='Sales'>Sales</option>
                                                            <option value='HR'>HR</option>
                                                            <option value='Purchasing'>Purchasing</option>
                                                            <option value='Maintenance'>Maintenance</option>
                                                            <option value='Marketing'>Marketing</option>-->
                                                    </select>
                                                    <br>
                                                    <label class='form-label text-dark fw-bolder'>Password:</label>
                                                    <input required type='text' name='pw' class='form-control' required>
                                                    <br>
                                                    <label class='form-label text-dark fw-bolder'>Administrator or Regular User:</label>
                                                    <br>
                                                    <div class='form-check form-check-inline'>
                                                        <input type='radio' name='usertype' value='Administrator' class='form-check-input' required> Admistrator</div>
                                                    <div class='form-check form-check-inline'>
                                                        <input type='radio' name='usertype' value='Regular User' class='form-check-input' required> Regular User </div>
                                                    <br>
                                                    <input type='submit' value='Add' class='btn btn-primary btn btn-info'> </form>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive card-body">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">User ID</th>
                                            <th scope="col">Password</th>
                                            <th scope="col">Department</th>
                                            <th scope="col">Update Department</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    while($row2 = $result2->fetch_assoc()) {
                                    //grabs values from db
                                    $name = $row2["EMP_FNAME"] . " " . $row2["EMP_LNAME"];
                                    $id = $row2["EMP_USERID"];
                                    $dept = $row2["EMP_DEPT"];
                                    $emp_id = $row2["EMP_ID"];
                                    
                                    //start of table data
                                    echo "<tr><td>" . $name . "</td>"; //displays name
                                    echo "<td>" . $id . "</td> "; //displays username
                                        
                                    //password reset form, pass php values through link and id to be used in modal
                                    //since modal is outside of loop and can't auto populate data itself
                                    echo "<td><a href='#exampleModal2-$id-$emp_id' data-bs-toggle='modal' class='btn btn-success'>RESET</a>
                                <!-- Modal -->
                                <div class='modal fade' id='exampleModal2-$id-$emp_id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                            <h5 class='modal-title' id='exampleModal2'>Password Reset</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                        <div class='modal-body'>
                                            <form action='controller/pwreset.php' method='post'>
                                            <label class='form-label text-dark fw-bolder'>Username: $id</label>
                                            <br>
                                            <label class='form-label text-dark fw-bolder'>New Password:</label>
                                            <input type='text' name='pw' class='form-control' required>
                                            <br>
                                            <input type='hidden' name='uname' value='{$id}'>
                                            <input type='hidden' name='id' value='{$emp_id}'>
                                            <input type='submit' value='Reset Password' class='btn btn-primary btn btn-info'> </form>
                                        </div>
                                    <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            </td>";
                                        
                                //creates different dropdown menu based off current dept from departments table in db
                                //had to use separate result query variable for this one bc add emp code uses similar while loop
                                $result4 = mysqli_query($conn,$sql3);
                                echo "<td>". $dept . "</td>";
                                echo "<td><form action='controller/edit_dept.php' method='post'>
                                        <select name='newdept' id='dept' class='fs-6'>
                                            <option value=''>SELECT NEW</option>";
                                if ($result4->num_rows > 0) { 
                                    while($row4 = $result4->fetch_assoc()) {
                                        $dep_choices = $row4["DEPARTMENT_NAME"];
                                        echo "<option value='{$dep_choices}'>{$dep_choices}</option>";
                                    }
                                        
                                } else {
                                    echo "No Departments";
                                }
                                echo "</select>
                                        <input type='hidden' name='emp_user' value='{$id}'>
                                        <input type='hidden' name='id' value='{$emp_id}'>
                                        <input type='submit' value='Save' class='btn btn-secondary'> </form></td>"; 
                                    
                        //if not current user who's logged in the delete action will be active
                        if ($id !== $adminuser){ 
                            echo "<td>
                            <form action='controller/delete_acc.php' method='post'>
                            <input type='hidden' name='emp_user' value='{$id}'><!--username of employee-->
                            <input type='hidden' name='id' value='{$emp_id}'><!--employee id-->
                            <input type='submit' class='btn btn-danger' name='delete' value='DELETE'> </form>
                            </td>"; 
                        } 
                        else { 
                        //if it is the current admins row then it displays disabled delete button so current admin won't
                        //accidentally delete their own account
                            echo "<td><input type='submit' class='btn btn-danger' name='delete' value='DELETE' disabled></td>"; 
                        }                
                        echo "</tr>";
                }
                
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer ">
                                <hr>
                                <div class="stats"> <a href="admin_manage.php"><i class="fa fa-history"></i></a> Refresh </div>
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
        <!--bootstrap links-->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    </body>

    </html>