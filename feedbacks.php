<?php
include 'core/config.php';
include 'app/sessions/session.php';
include 'app/controllers/feedback.php';
include 'app/controllers/functions.php'

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book Appointment</title>
    <?php include 'styles/css.php' ?>
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
                <h1 class="mt-4"><?php echo "Dashboard"?></h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Appointment Feedbacks</li>
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
                <?php if (mysqli_num_rows($fedback)>0){ ?>
                    <table class="table table-hover" id="sample-table-1">
                        <thead>
                        <tr>
                            <th class="center">#</th>
                            <th class="">Doc Name</th>
                            <th>Feedback</th>
                            <th>Date</th>
                            <th>Action</th>


                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        while($row=mysqli_fetch_array($fedback))
                        {
                            ?>

                            <tr>
                                <td class="center"><?php echo $cnt;?>.</td>
                                <td class=" text-capitalize"><?php echo docname($row['doc_id']);?></td>
                                <td><?php echo $row['feedback'];?></td>
                                <td><?php echo  formatAppointment($row['date']);?></td>

                                <td >    <?php if(($row['viewed']==0))
                                    { ?>

                                        <a href="feedbacks.php?id=<?php echo $row['id']?>&cancel=read" onClick="return confirm('Are you sure you want Mark read?')" class="btn btn-primary">Mark Read</a>
                                    <?php } else {

                                        echo "<p class='text-secondary'>Read</p>";
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
                        <h5 class="text-center  text-bold">No Feedbacks found</h5>



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
