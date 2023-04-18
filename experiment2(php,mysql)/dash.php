<style>
    *{
        list-style:none;
        margin:0;
        padding:0;
    }
    .s{
        position:fixed;
        top:0;
        width:1532px;
        height:140px;
        background:aqua;
    }
</style>
<?php
session_start();
if($_SESSION["uname"]){
    ?>
<body style="background-color:white">
<div class="s">
<h1 align="center" id="h1">welcome to facebook
    <?php
    echo "<i>";
    echo"<br>";
    echo $_SESSION["uname"];
    echo "</i>";
    ?></h1>
   <!---<a href='logout.php'><h3 style="color:crimson; float:right;"><button>logout</button></a>--->
        
</div>
</body><?php
}
else{
    header("location:main.php");
}?>
<div>
<?php include("nav.php")?>

</div>
<div>
<?php include("watchother.php")?>

</div>