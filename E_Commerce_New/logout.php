<?php
session_start();
include('connection.php');
session_destroy();
echo "<meta http-equiv='refresh' content='0;url=index.php'>";
?>