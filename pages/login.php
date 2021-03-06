<?php
    session_start();
?>
    <!DOCTYPE html>
    <html lang="">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <!--bootsrap cdn links-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/login.css"> </head>

    <body>
        <div class="container">
            <?php
            if (empty($_SESSION["error"])) {

            } else {
                echo "<div class=\"card text-dark bg-warning mb-3\">
            <div class=\"card-header\">LOGIN ERROR</div>
            <div class=\"card-body\">
                <h5 class=\"card-title\">Invalid Login Credentials</h5>
                <p class=\"card-text\">If you are seeing this message, it means that either your username or password is incorrect. Please speak to your administrator to reset this password.</p>
            </div>
        </div>";
            }
        ?>
                <div class="row">
                    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                        <div class="card card-signin my-5">
                            <div class="card-body">
                                <h5 class="card-title text-center"><strong>COVID Safety Suite</strong></h5>
                                <!--login form-->
                                <form action="controller/userauth.php" method="post" class="form-signin">
                                    <label>Username:</label>
                                    <div class="form-label-group">
                                        <input required type="text" name="username" class="form-control"> </div>
                                    <label>Password:</label>
                                    <div class="form-label-group">
                                        <input required type="password" name="password" class="form-control"> </div>
                                    <br>
                                    <input type="submit" value="Login" class="btn btn-lg btn-primary btn-block text-uppercase"> </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!--more links for design-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js " integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo " crossorigin="anonymous "></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js " integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1 " crossorigin="anonymous "></script>
    </body>

    </html>
    <?php
    unset($_SESSION["error"]);
?>