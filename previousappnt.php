<?php
include 'core/config.php';
include 'app/sessions/session.php';
include 'app/controllers/pendingappnts.php';
include 'app/controllers/functions.php'

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book Appointment</title>
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
                <h1 class="mt-4"><?php echo "dashboard"?></h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Previous Appointments</li>
                </ol>
                <div class="row">
                    <div class="float-left">
                        <div class="btn-group">
                            <a href="javascript: history.go(-1)" class="btn  btn-lg"><i class="text-secondary fas fa-arrow-left"></i></a>

                        </div>
                    </div>
                    <!-- /.btn-group -->
                </div>

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
                <?php if (mysqli_num_rows($prevappnts)>0){ ?>
                    <table class="table table-hover" id="sample-table-1">
                        <thead>
                        <tr>
                            <th class="center">#</th>
                            <th class="">Doctor Name</th>
                            <th>Specialization</th>
                            <th>Consultancy Fee</th>
                            <th>Appnt. Date / Time </th>
                            <th>Booking Date  </th>
                            <th>Current Status</th>
                            <th>Action</th>


                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        while($row=mysqli_fetch_array($prevappnts))
                        {
                            ?>

                            <tr>
                                <td class="center"><?php echo $cnt;?>.</td>
                                <td class=" text-capitalize"><?php echo docname($row['doctorId']);?></td>
                                <td><?php echo $row['doctorSpecialization'];?></td>
                                <td><?php echo  formatMoney($row["consultancyFees"],true);?></td>
                                <td><?php echo
                                    formatAppointment($row['appointmentDate']);?>
                                    <?php echo
                                    $row['appt_time'];?>
                                </td>
                                <td><?php echo timeAgo($row['postingDate']);?></td>
                                <td>
                                    <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1))
                                    {
                                        echo "Active";
                                    }
                                    if(($row['userStatus']==0) && ($row['doctorStatus']==1))
                                    {
                                        echo "Cancelled by You";
                                    }
                                    if(($row['userStatus']==1) && ($row['doctorStatus']==0))
                                    {
                                        echo "Cancelled by Doctor";
                                    }
                                    if(($row['doctorStatus']==2) && ($row['feedbackstatus']==0)){
                                        echo'<p class="text-info">Dr. will leave a feeback soon</p>'; }
                                    if(($row['doctorStatus']==2) && ($row['feedbackstatus']==1)){
                                        echo'<a class="btn btn-primary">Read Feedback</a>'; }
                                    ?>
                                </td>
                                <td >    <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1))
                                    { ?>
                                        <a href="pendingappt.php?id=<?php echo $row['id']?>&cancel=update" onClick="return confirm('Are you sure you want to cancel this appointment ?')"class="btn btn-transparent btn-xs tooltips" title="Cancel Appointment" tooltip-placement="top" tooltip="Remove">Cancel</a>
                                    <?php } elseif(($row['userStatus']==1) && ($row['doctorStatus']==2)) {

                                        echo "<p class='text-info'>Thanks for coming!!</p>";
                                    } ?>

                                </td>
                            </tr>

                            <?php
                            $cnt=$cnt+1;
                        }?>


                        </tbody>
                    </table>
                <?php }else{?>

                <div id="notfound">
                    <div id="descnot">
                        <h5 class="text-center  text-bold">No previous appointments found</h5>


                        <div class="text-center">
                            <a class="btn btn-primary" role="button" href="pendingappt.php">Pending Appointments</a>
                        </div>
                    </div>
                </div>

            </div>
            <?php } ?>
        </main>

    </div>
</div>
<?php include 'styles/scripts.php'?>
</body>
</html>
