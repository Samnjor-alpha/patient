<?php include 'database/config.php';
include 'app/controllers/register.php'
?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <title>Wilson Medical Center</title>
    <?php include 'resources/styles.php'?>


</head>
<body>
<header id="home" class="header">

    <?php include 'resources/header.php'?>

</header>
<!--========================= service-section start ========================= -->
<section id="contact" class="contact-section  pt-20 pb-160">

    <div class="container">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="section-title text-center mb-55">

                    <h2 class="mb-15 wow fadeInUp" data-wow-delay=".4s"><?php echo ptnt_regTittle?></h2>
                    <p class="wow fadeInLeft" data-wow-delay=".6s">

                        <?php echo ptnt_regdesc ?>
                    </p>
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
                            <input type="text" class="form-control" value="<?= isset($_POST['full_name']) ? $_POST['full_name'] : ''; ?>" name="full_name" placeholder="Full Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="address" value="<?= isset($_POST['address']) ? $_POST['address'] : ''; ?>" placeholder="Address" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="city" placeholder="City" value="<?= $_POST['city'] ?? ''; ?>" required>
                        </div>
                        <div class="selectr-input selectr-container">
                            <select class="selectr-input" name="gender"  required>
                               <option  disabled>Gender</option>
                               <option value="male">Male</option>
                               <option value="female">Female</option>
                           </select>


                        </div>

                        <div class="form-group">

	<input type="email" class="form-control" name="email" id="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>" placeholder="Email" required>

                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="pno" value="<?= isset($_POST['pno']) ? $_POST['pno'] : ''; ?>" placeholder="phone Number(+233XXXX)" required>
                        </div>
                        <div class="form-group">
	<input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?= isset($_POST['password']) ? $_POST['password'] : ''; ?>" required>
	
                        </div>
                        <div class="form-group">
	<input type="password" class="form-control"  id="password_again" name="password_again" placeholder="Confirm Password" required>
                        </div>
                                                <button type="submit" name="regptnt" class="btn btn-block theme-btn">Create an account</button>

                    </form>
                    <div class="new-account">
                        Have an account?
                        <a href="index.php">
                            Login here
                        </a>
                    </div>

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

</body>
</html>