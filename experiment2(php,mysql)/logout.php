<?php 
session_start();
session_destroy();
header("Location: main1.php");
?>