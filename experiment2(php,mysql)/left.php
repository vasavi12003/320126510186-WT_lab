<?php
session_start();
?>
<html>
<head>
<style>
input[type=submit] {
	background-color:#9cd3d3;
    width: 15em; 
    border-radius:25px;
	 height: 5em;
}
</style>
<body>
<div class="upload" >
<form action="dash.php" method="post" target="right">
    <input type="submit" name="upp" value="HOME">
</form>
</div>
<div class="upload" >
<form action="upp.php" method="post" target="right">
    <input type="submit" name="upp" value="UPLOADED">
</form>
</div>
<div class="upload" >
<form action="watchall.php" method="post" target="right">
    <input type="submit" name="watchall" value="watchall">
</form>
</div>
