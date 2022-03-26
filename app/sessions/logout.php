<?php
session_start();










session_unset();
session_destroy();
$_SESSION['redirect_url'] = $_SERVER['PHP_SELF'];
echo "<script>
 window.location.href='javascript: history.go(-1)';
</script>";


?>