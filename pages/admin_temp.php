<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
    <link href="css/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Admin Dashboard
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
</head>

<body>
    <section id="nav-bar">

        <div class="topnav" id="myTopnav">
            <a href="#home" class="active">Home</a>
            <a href="#news">News</a>
            <a href="#contact">Contact</a>
            <a href="#about">About</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>

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
    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>

</body>

</html>
