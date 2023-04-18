<?php
include("nav.php")
?>
<style>
    .k{
        list-style:none;
        margin-left:200;
        padding:0;
    }
    </style>
<body class="k">
<div>
<?php
session_start();
$pat="";
$con = mysqli_connect("localhost","root","","lab_expt");
$id=$_SESSION["uname"];
$qr="select path from ins where id not in ('$id');";
$res=mysqli_query($con,$qr);
if(mysqli_num_rows($res)>=1){
while($row=mysqli_fetch_assoc($res)){
$pat=$row['path'];
echo "<div><img src='$pat' height='100'  width='100'>";
echo '<form method="post" >';
echo  '<input type="hidden" name="path" value="'.$pat.'">';
echo '<button type="submit" name="like_but">like</button>';
echo '<span class="likes">'.count_likes($pat).'</span><br>';
echo '</form>';
echo '<form method="post" >';
echo  '<input type="hidden" name="path" value="'.$pat.'">';
echo  "<input type='textarea' name='comment' placeholder='enter your comment'><br>";
echo  '<button type="submit" name="comments" >post</button>';
echo '</form>';
echo '</div>';
echo $id;
}

}
//likes
if (isset($_POST['like_but'])){
$pid=$_POST['path'];

$qy=mysqli_query($con,"select * from likes where id='$id' and path='$pid';");
if(mysqli_num_rows($qy)==0){
mysqli_query($con,"insert into likes values('$id','$pid');");
}
}


//comments 
if(isset($_POST['comments'])){
$pid=$_POST['path'];
$com=$_POST['comment'];
if($com!=""){
$qu="insert into comments values('$id','$pid',$com);";
mysqli_query($con,$qu);
}
}
function count_likes($hj){
global $con;
$res=mysqli_query($con,"select count(*) as num from likes where path='$hj';");

while($data=mysqli_fetch_assoc($res)){

return $data['num'];
}
}

mysqli_close($con);

?>
</div>
</body>
