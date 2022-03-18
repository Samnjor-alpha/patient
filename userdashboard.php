<?php
include '../database/config.php';
include '../app/sessions/session.php';
include '../app/controllers/userdashboard.php';
include '../app/controllers/functions.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../resources/dashboard-styles.php' ?>
    <link href="../public/dashboard-assets/css/vcall.css" rel="stylesheet">
</head>
<body class="sb-nav-fixed">
<?php include '../resources/topbar.php'?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include '../resources/usersidebar.php'?>
    </div>
    <div id="layoutSidenav_content">
        <div id="alertBox" class="hidden z-10 transition absolute w-full h-full flex items-center justify-center">
            <div class="pop-up flex justify-between w-96 bg-white rounded overflow-hidden">
                <div class="pl-6 border-green-600 px-2 py-2 flex items-center">
                    <div class="w-16 h-16 mx-1 rounded-full border overflow-hidden">
                        <img id="alertImage" class="w-full h-auto" src="">
                    </div>
                    <div class="flex flex-col">
                        <div id="alertName" class="mx-2 font-500">
                        </div>
                        <div class="animate-pulse mx-2 text-xs font-200 relative flex">
                            <span id="alertMessage" class="flex"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CallPopup -->
        <div id="callBox" class="hidden z-10 transition absolute w-full h-full flex items-center justify-center">
            <div class="pop-up flex justify-between w-96 bg-white rounded overflow-hidden">
                <div class="pl-6 border-green-600 px-2 py-2 flex items-center">
                    <div class="w-16 h-16 mx-1 rounded-full border overflow-hidden">
                        <img id="profileImage" class="w-full h-auto" src="https://ui-avatars.com/api/?name=D+R">
                    </div>
                    <div class="flex flex-col">

                        <div id="username" class="mx-2 font-500">
                            username
                        </div>
                        <div class="animate-pulse mx-2 text-xs font-200 relative flex">
                            <span class="flex">Video calling</span>
                            <span class="ml-2 text-lg text-green-600 top-0 flex">
                        <i class=" fas fa-video"></i>
                    </span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-center mx-4">

                            <button id="declineBtn" class="btn btn-danger mr-2"><i class="fas fa-times"></i></button>

                            <button id="answerBtn" class="btn btn-success mr-2"><i class="fas fa-phone"></i></button>

                </div>
            </div>
        </div>
        <main>

            <div class="container-fluid">
                <h1 class="mt-4"><?php echo user_dashboard?></h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"><?php echo user_dashboard?></li>
                </ol>


                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2 " data-toggle="tooltip" title="Booked Appointments">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-capitalize mb-1">Booked Appt(s).</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo countallappnts($_SESSION['p_id'])?></div>
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
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo countallprevappnts($_SESSION['p_id'])?></div>
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
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo getfeedbacks($_SESSION['p_id']) ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comment-medical fa-3x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </main>
<?php include '../resources/dashfooter.php'?>
    </div>
</div>
<?php include '../resources/dashboard-scripts.php'?>

</body>
</html>
