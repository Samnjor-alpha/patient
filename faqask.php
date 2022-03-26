<?php
include 'core/config.php';
include 'app/sessions/session.php';
include 'app/controllers/faq.php';
include 'app/controllers/functions.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>FAQs</title>
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
                    <li class="breadcrumb-item active">FAQ</li>
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
                <form role="form" action=""  method="post" >

                    <div class="form-group">
                        <label for="faq">
                            Ask a question
                        </label>
                        <textarea id="faq" name="faq" class="form-control" placeholder="Ask a question.Our help desk will answer you" required></textarea>

                    </div>




                    <button type="submit" name="ask" class="btn btn-block theme-btn">
                        Ask
                    </button>
                </form>
                <?php if (mysqli_num_rows($questions)>0){ ?>

                    <table class="table table-hover" id="sample-table-1">
                        <thead>
                        <tr>
                            <th class="center">#</th>

                            <th>Question</th>
                            <th>Answer</th>
                            <th>Date asked</th>
                            <th>Date answered</th>
                            <th>Action</th>


                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        while($row=mysqli_fetch_array($questions))
                        {
                            ?>

                            <tr>
                                <td class="center"><?php echo $cnt;?>.</td>

                                <td><?php echo $row['faq'];?></td>
                                <td><?php echo getanswer($row['id'])?></td>
                                <td><?php  echo timeAgo($row['date_asked'])?></td>
                                <td><?php  echo getdateanswered($row['id'])?></td>

                                <td ><a href="faqask.php?id=<?php echo $row['id']?>&cancel=update" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger" title="Delete Medical History">Delete</a>
                                </td>
                            </tr>

                            <?php
                            $cnt=$cnt+1;
                        }?>


                        </tbody>
                    </table>
                <?php }else{?>

                    <div  class="mt-5" id="notfound">
                        <div id="descnot">
                            <h5 class="text-center  text-bold"><?php echo $notfoundmsg ?></h5>



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