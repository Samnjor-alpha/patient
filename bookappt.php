<?php
include 'core/config.php';
include 'app/sessions/session.php';
include 'app/controllers/getdoctors.php';
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
                <h1 class="mt-4"><?php echo "Book appointment"?></h1>


<div class="row">
    <div class="col-lg-8">
        <form action="" method="get">
            <div class="form-group">
                <input type="text" name="search" class="form-control" value="<?= $_GET['search'] ?? ''; ?>" placeholder="Search for Doctor">
            </div>
        </form>
    </div>
    <div class="col-lg-4">
        <form action="" method="post">
            <div class="form-group">
               <select class="form-control" onchange="this.form.submit()" name="skill">
                   <option selected><?= $_POST['skill'] ?? 'Filter doctors'; ?></option>
                    <?php while($row=mysqli_fetch_array($ret)){
                           ?>
                           <option value="<?php echo htmlentities($row['specilization']);?>">
                               <?php echo htmlentities($row['specilization']);?>
                           </option>
                       <?php } ?>


               </select>
            </div>
        </form>
    </div>
</div>

                <?php if (mysqli_num_rows($doctors)>0){ ?>
                <div class="row">
                    <?php while($row_dr=mysqli_fetch_array($doctors)){
                    ?>
                    <div class="col-lg-4 mb-2">
                <div class="card h-100 text-center">
                    <div class="">
                        <img class=" mt-1" style="border-radius:50%"  src="https://ui-avatars.com/api/?name=<? echo $row_dr['fname']?>" alt="Card image">
                    </div>

                    <div class="card-body">
                        <h4 class="card-title"><?php echo $row_dr['fname']?></h4>
                        <p class="card-text"><?php echo $row_dr['specialization']?></p>
                        <a href="<?php echo BASE_URL.'/'.getdrusername($row_dr['userID'])  ?>" class="btn  btn-sm btn-primary">Visit Doctor</a>
                        <a href="<?php echo BASE_URL.'/'.getdrusername($row_dr['userID'])  ?>" class="btn  btn-sm btn-success"><i class="fas fa-video"></i></a>
                    </div>
                </div>








                    </div>
                    <?php }?>


            </div>
                <?php }else{?>
                    <div id="notfound">
                        <div id="descnot">
                            <h5 class=" text-center"><?php echo $querymsg; ?></h5>



                        </div>
                    </div>

                <?php }?>
                </div>

        </main>

    </div>
</div>
<?php include 'styles/scripts.php'?>
</body>
</html>
