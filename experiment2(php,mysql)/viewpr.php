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
<?php
$connect=mysqli_connect("localhost","root","","lab_expt");
$sql="select *from regform";
$rows=mysqli_query($connect,$sql);
?>
<div class="y">
<div class="x">
<?php
while($row = mysqli_fetch_array($rows)) {
echo "Name:"."&nbsp;&nbsp;&nbsp;&nbsp;".$_SESSION["uname"];
echo "<br>";
$j=$_SESSION["uname"];
$k="select email from regform where sname='$j'";
$r=mysqli_query($connect,$k);
if(mysqli_num_rows($r)>0){
    while($row=mysqli_fetch_assoc($r))
    {
    echo "EMAIL:"."&nbsp;&nbsp;&nbsp;"."<strong>".($row['email'])."</strong>";
    break;
    }
    
    }
break;
}
?>
</table>
</div>
</div>
<style>

table{
        font-size:20px;
        align-items:center;
    }
    .y{
        padding-left:550;
        padding-top:340;
        background-color:white;
        width:180px;
        height:170px;
    }
    .x{
        align-items:center;
        padding-left:150;
        padding-top:60;
        background-color:pink;
        width:280px;
        height:120px;
    }
       