<?php
include '../database/config.php';
include '../app/sessions/session.php';
include '../app/controllers/medhistory.php';
include '../app/controllers/functions.php'

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Medical History</title>
    <?php include '../resources/dashboard-styles.php' ?>
</head>
<body class="sb-nav-fixed">
<?php include '../resources/topbar.php'?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include '../resources/usersidebar.php'?>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><?php echo user_dashboard?></h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Medical History</li>
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
                <?php if (mysqli_num_rows($medhis)>0){ ?>
                    <table class="table table-hover" id="sample-table-1">
                        <thead>
                        <tr>
                            <th class="center">#</th>
                            <th class="">Medical Hist.</th>
                            <th>Medication Hist.</th>
                            <th>Family Medical Hist.</th>
                            <th>Treatment Hist</th>
                            <th>Action</th>


                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        while($row=mysqli_fetch_array($medhis))
                        {
                            ?>

                            <tr>
                                <td class="center"><?php echo $cnt;?>.</td>

                                <td><?php echo $row['pnt_med_hist'];?></td>
                                <td><?php echo $row['medication_hist']?></td>
                                <td><?php  echo $row['family_med_hist']?></td>
                                <td><?php echo $row['treatment_hist'];?></td>
                                <td ><a href="medical-history.php?id=<?php echo $row['id']?>&cancel=update" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger" title="Delete Medical History">Delete</a>
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
                        <h5 class="text-center  text-bold">No Medical history.</h5>


                        <div class="text-center">
                            <a class="btn btn-primary" role="button" href="addmedhis.php">Add Medical history</a>
                        </div>
                    </div>
                </div>

            </div>
            <?php } ?>
        </main>
        <?php include '../resources/dashfooter.php'?>
    </div>
</div>
<?php include '../resources/dashboard-scripts.php'?>
</body>
</html>
