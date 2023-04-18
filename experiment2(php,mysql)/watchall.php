
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
        background:#68bde1;
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
    <a href='logout.php'><h3 style="color:crimson; float:right;"><button>logout</button></a>
        
</div>
</body><?php
}
else{
    header("location:main.php");
}?><?php
include("nav.php");
?>
<style>
    #l{
        margin-left:190;padding:140;
    }
    </style>

<div id="l">
<?php
$con = mysqli_connect("localhost","root","","lab_expt");
$id=$_SESSION["uname"];
$qr="select path from ins where id='$id';";
$res=mysqli_query($con,$qr);
if(mysqli_num_rows($res)>=1){
while($row=mysqli_fetch_assoc($res)){
$pat=$row['path'];
echo "<div><center><img src='$pat' height='300' width='300'></center></div><br><br>";

}
}

mysqli_close($con);

?>
</div>