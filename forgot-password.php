<?php include 'database/config.php';
include 'app/controllers/resetpassword.php';
?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <title>Reset Password</title>
    <?php include 'resources/styles.php'?>


</head>
<header id="home" class="header">

    <?php include 'resources/header.php'?>

</header>
<!--========================= service-section start ========================= -->
<section id="contact" class="contact-section  pt-20 pb-160">

    <div class="container">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="section-title text-center mb-55">

                    <h2 class="mb-15 wow fadeInUp" data-wow-delay=".4s"><?php echo reset_pwdttle?></h2>

                </div>
            </div>
        </div>


        <div   class="contact-form ">
            <div class="row">
                <div class="col-xl-8 mx-auto">
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
                    <form action=""  method="POST"  class="contact-form">

                        <div class="form-group">

                            <input type="email" required class="form-control" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>" name="email" placeholder="Email">
                        </div>



                        <button name="searchmail" type="submit" class="btn btn-block theme-btn">Send Reset link</button>

                    </form>
                                        <p class="form-message pt-15"></p>
                </div>
            </div>
        </div>
    </div>

</section>
<?php include 'resources/footer.php'?>
<!-- ========================= footer end ========================= -->


<!-- ========================= scroll-top ========================= -->
<a href="#" class="scroll-top">
    <i class="lni lni-arrow-up"></i>
</a>

<!-- ========================= JS here ========================= -->
<?php include "resources/scripts.php"; ?>
<body>
</body>
</html>