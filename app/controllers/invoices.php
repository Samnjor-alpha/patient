<?php
$invoices=mysqli_query($connn,"select * from payments where pnt_id='".$_SESSION['userID']."' ");
$cnt=1;