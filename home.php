<?php include 'core/config.php';
include 'app/sessions/session.php';
include 'app/controllers/functions.php';
include 'app/controllers/userdashboard.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
    <?php include 'styles/css.php'?>
</head>
<body class="sb-nav-fixed">
<?php include 'navs/top-bar.php'?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
     <?php include 'navs/sidebar.php'?>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Dashboard</h1>

            </div>
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2 " data-toggle="tooltip" title="Booked Appointments">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-capitalize mb-1">Booked Appt(s).</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo countallappnts($_SESSION['userID'])?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="far fa-calendar-check fa-3x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-capitalize mb-1">Previous Appts</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo countallprevappnts($_SESSION['userID'])?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-history fa-3x text-secondary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->


                <!-- Pending Requests Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-capitalize mb-1">Appt. Feedback</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo getfeedbacks($_SESSION['userID']) ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comment-medical fa-3x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2020</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<?php include 'styles/scripts.php' ?>
</body>
</html>
