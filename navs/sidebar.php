<nav class="sb-sidenav accordion theme-bg" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Dashboard</div>
            <a class="nav-link" href="<?php echo BASE_URL?>/home.php">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Appointments</div>
            <a class="nav-link" href="<?php echo BASE_URL?>/bookappt.php">
                <div class="sb-nav-link-icon"><i class="far fa-calendar-check"></i></div>
                Book Appt.
            </a>
            <a class="nav-link" href="<?php echo BASE_URL?>/pendingappt.php">
                <div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
                Pending Appt.
            </a>
            <a class="nav-link" href="<?php echo BASE_URL?>/previousappnt.php">
                <div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>
                Appt. History
            </a>
            <div class="sb-sidenav-menu-heading">Medical </div>
            <a class="nav-link" href="<?php echo BASE_URL?>/medical-history.php">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-file-medical-alt"></i>
                </div>
                Medical history
            </a>
            <a class="nav-link" href="<?php echo BASE_URL?>/feedbacks.php">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-comment-medical"></i>
                </div>
                Feedbacks
<!--                &nbsp;<span class="badge badge-pill badge-primary">--><?php //echo countfeedbacks($_SESSION['p_id'])?><!--</span>-->
            </a>
            <div class="sb-sidenav-menu-heading">Invoice </div>
            <a class="nav-link" href="<?php echo BASE_URL?>/invoice.php">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-file-invoice"></i>
                </div>
                Invoice  &nbsp;
<!--                <span class="badge badge-pill badge-primary">-->
<!--                    --><?php //echo countinvoice($_SESSION['userID']) ?><!--</span>-->
            </a>
            <div class="sb-sidenav-menu-heading">FAQ </div>
            <a class="nav-link" href="<?php echo BASE_URL?>/faqask.php">
                <div class="sb-nav-link-icon">
                    <i class="far fa-question-circle"></i>
                </div>
                Ask Question
            </a>


        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <p class="text-capitalize"><?php echo $_SESSION['name'] ?></p>
        </div>
</nav>