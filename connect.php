<?php
include '../database/config.php';
include '../app/sessions/session.php';
include '../app/controllers/getdoctors.php';
include '../app/controllers/functions.php';
$uname=$_GET['username'];
$getvuser=mysqli_query($conn,"select * from v_users where username='$uname'");
$rowvuser=mysqli_fetch_assoc($getvuser);
$getdrname=mysqli_query($conn, "select * from doctors where id='".$rowvuser['dr_pnt_id']."'");
$rowdname=mysqli_fetch_assoc($getdrname);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book Appointment</title>
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
                    <li class="breadcrumb-item active">Connect</li>
                </ol>

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
<div class="row">
    <div class="col-4">
        <?php if (mysqli_num_rows($doctors)>0){ ?>
            <div class="row">

                  <table width="100px">
                      <?php while($row_dr=mysqli_fetch_array($doctors)){?>

                      <tr class="mb-2">

                      <td>

                              <img class="" style="border-radius:50%"  height="50" width="50" src="https://ui-avatars.com/api/?name=<?php echo $row_dr['doctorName']?>"

                      </td>
                          <td>
                              <a class="nav-link text-primary" href="<?php echo BASE_URL.'/dashboard/'.getdrusername($row_dr['id'])  ?>">
                                  <?php echo $row_dr['doctorName'] ?>
                              </a>

                          </td>

                      </tr>
                      <?php }?>
                  </table>








            </div>
        <?php }else{?>
            <div id="notfound">
                <div id="descnot">
                    <h5 class=" text-center"><?php echo $querymsg; ?></h5>



                </div>
            </div>


        <?php }?>
    </div>

<div class="col-8">
    <div id="profile" class="mt-2 text-center">
        <div class="">

                <img style="border-radius:50%"  height="75" width="75" class="h-auto w-full" src="https://ui-avatars.com/api/?name=<?php echo $rowdname['doctorName']?>">

            <div class="text-center mt-5">
                <h2 class="text-center"><?php echo $rowdname['doctorName']?></h2>
                <p>Do you want to make a Call?</p>
                <button id="callBtn" data-user="<?php echo $rowvuser['userID'];?>" class="btn btn-success"><i class=""></i></button>
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
        <?php include '../resources/dashfooter.php'?>
    </div>
</div>
<?php include '../resources/dashboard-scripts.php'?>
</body>
</html>
