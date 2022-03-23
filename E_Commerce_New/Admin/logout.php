<?php
ob_start();
session_start();
 
 session_destroy();
// header("Loaction:index.php");
echo '<meta http-equiv="refresh" content="0;url=index.php">';


?>