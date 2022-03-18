<?php
include 'core/config.php';
include 'app/sessions/session.php';
include "app/controllers/functions.php";
include 'app/controllers/bookappt.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book Appointment</title>
    <?php include 'styles/css.php' ?>
    <script>
        const conn =new WebSocket('ws://localhost:8080/?token=<?php echo getusersessionid($_SESSION['userID']) ?>')
    </script>
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
                <h1 class="mt-4"><?php echo "Book Appointment";

                ?></h1>

                <div class="row">
                    <div class="float-left">
                        <div class="btn-group">
                            <a href="javascript: history.go(-1)" class="btn  btn-lg"><i class="text-secondary fas fa-arrow-left"></i></a>

                        </div>
                    </div>
                    <!-- /.btn-group -->
                </div>
<div class="row">
    <div class="col-6">
        <div>
            <?php if (!empty($msg)): ?>
                <div class="alert <?php echo $msg_class ?> alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php echo $msg; ?>
                </div>
            <?php endif; ?>
        </div>
        <form role="form" name="book" method="post" >

            <div class="form-group">
                <label for="DoctorSpecialization">
                    Doctor Specialization
                </label>
                <input name="drspec" value="<?php echo getdoctorspec(getdrid($_GET['doctor'])) ?>" class="form-control" id="DoctorSpecialization" readonly>

            </div>




            <div class="form-group">
                <label for="doctor">
                    Doctor Name
                </label>
                <input name="drname" value="<?php echo getdoctorsname(getdrid($_GET['doctor'])) ?>" class="form-control" id="doctor" readonly>
            </div>





            <div class="form-group">
                <label for="fees">
                    Consultancy Fees
                </label>
                <input name="fees" class="form-control" id="fees" value="<?php echo getfee(getdrid($_GET['doctor']))?>"  readonly>


            </div>

            <div class="form-group">
                <label for="AppointmentDate">
                    Date
                </label>
                <input type="date" id="AppointmentDate" class="form-control" name="appdate"  required="required" data-date-format="yyyy-mm-dd">

            </div>

            <div class="form-group">
                <label for="bizhrs">
                    Time
                </label>
                <select  name="bizhrs" id="bizhrs" class="form-control">

                    <option  disabled selected>Choose Appt. Time</option>
                    <?php while($row=mysqli_fetch_array($getdrbizhrs)){
                        ?>
                        <option value="<?php echo htmlentities($row['hours']);?>">
                            <?php echo htmlentities($row['hours']);?>
                        </option>
                    <?php } ?>

                </select>

            </div>

            <button type="submit" name="bookappt" class="btn btn-block btn-primary">
                Book Appointment
            </button>
        </form>
    </div>
    <div class="col-6">
        <div id="profile" class="mt-2 text-center">
            <div class="">

                <img style="border-radius:50%"  height="75" width="75" class="" src="https://ui-avatars.com/api/?name=<?php echo getdoctorsname(getdrid($_GET['doctor']))?>">

                <div class="text-center mt-5">
                    <h2 class="text-center"><?php echo getdoctorsname(getdrid($_GET['doctor']))?></h2>
                    <p>Do you want to make a Call?</p>
                    <button id="callBtn" data-user="<?php echo getdrid($_GET['doctor']);?>" class="btn btn-success"><i class="fas fa-video"></i></button>
                </div>
            </div>
        </div>
        <div id="video" class="hidden overflow-hidden flex items-center">
            <div class="flex relative flex-col h-full">
                <div class="order-2 h-full">
                    <video id="remoteVideo" class="h-full object-cover" style="width:1280px;" autoplay playsinline>
                    </video>
                    <video id="localVideo" class="vid-2 z-1 right-0 bottom-1 absolute" autoplay playsinline>
                    </video>
                </div>
                <div class="order-1 mt-4 absolute self-center">
                    <div class="time rounded-xl text-white font-bold py-1 px-4"><span id="callTimer"></span></div>
                </div>
                <div class="order-3 shadow-md flex justify-center btn-call-end items-end w-full h-full absolute ">
                    <button id="hangupBtn" class="relative -top-8 shadow-lg drop-shadow bg-red-600  rounded-full hover:bg-red-700 text-white text-2xl px-4 py-4 text-2xl">
                        <i class="fas fa-video-slash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


            </div>
        </main>

    </div>
</div>
<?php include 'styles/scripts.php'?>
<script src="public/dashboard-assets/js/main.js">
</body>
</html>
