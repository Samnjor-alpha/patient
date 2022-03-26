<?php
include 'core/config.php';
include 'app/sessions/session.php';
include 'app/controllers/medhistory.php';
include 'app/controllers/functions.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Medical History</title>
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
                <form role="form" action=""  method="post" >

                    <div class="form-group">
                        <label for="pnt_hist">
                     Patient Medical history
                        </label>
                        <textarea id="pnt_hist" name="p_medhist" class="form-control" placeholder="Diagnosed recently with any sickness?" required></textarea>

                    </div>

                    <div class="form-group">
                        <label for="medic_hist">
                            Medication History
                        </label>
                        <textarea id="medic_hist" name="med_hist" class="form-control" placeholder="under any medication?" required></textarea>
                    </div>





                    <div class="form-group">
                        <label for="fam_med_his">
                        Family Medical History
                        </label>

                        <textarea id="fam_med_his" name="famhist" class="form-control" placeholder="Any hereditary diseases in your family?" required></textarea>

                    </div>

                    <div class="form-group">
                        <label for="treat_hist">
                        Treatment History
                        </label>
<textarea id="treat_hist" class="form-control" name="trehist" placeholder="Any treatment history? i.e Surgery" required></textarea>

                    </div>



                    <button type="submit" name="addmedhist" class="btn btn-block theme-btn">
                        Add Medical History
                    </button>
                </form>

            </div>
        </main>

    </div>
</div>
<?php include 'styles/scripts.php'?>
</body>
</html>
