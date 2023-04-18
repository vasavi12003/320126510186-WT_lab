<?php 
session_start();

if($_SESSION["uname"]){
    ?>
    <h1 style="text-align:center"><img src="https://tse1.mm.bing.net/th?id=OIP.uX3CiNceeTjBzot_qs3JrAHaFj&pid=Api&P=0" alt=logo width=190 height=100><center><?php echo $_SESSION["uname"];?></center>
    <br><br><br>
    <a href='logout.php'><h3 style="color:crimson;"><button>logout</button></a>
<?php
}
else{
    header("location:signup.php");
}
?>
<style> 
body{
    background-color:whitesmoke;
}
</style>