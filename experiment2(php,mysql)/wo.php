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
.t{
margin-left:220;
padding:150;
}
</style>
<div class="t">
<?php
//include("all.php");
$pat="";
$n="";
$con = mysqli_connect("localhost","root","","lab_expt");
$id=$_SESSION['uname'];
$qr="select path from ins where id not in ('$id');";
$res=mysqli_query($con,$qr);

if(mysqli_num_rows($res)>=1)
{
while($row=mysqli_fetch_assoc($res))
{

$pat=$row['path'];
$we="select id as c from ins where path in ('$pat');";
$z=mysqli_query($con,$we);
while($row=mysqli_fetch_assoc($z)){
echo "<div style='float:left;width:33%;'>";
echo "<center>";
echo "<div align='left' style='background-color:#acdcee ;width:300px;height:20px;'>". $row['c'].' posted';
echo "</div>";
break;
}
echo "<div align='center' style='background-color:#acdcee ;width:300px;height:700px'><img  src='$pat' height='380'  width='300' align='center'>";
echo '<form method="post" >';
echo  '<input type="hidden" name="path" value="'.$pat.'">';
echo '<button type="submit" name="like_but">like</button>';
echo '<span class="likes">'.count_likes($pat).'</span><br>';
echo '</form>';
//veiw all comments
echo '<div style="background-color:#acdcee">';
$rt="select id,path,comment from comments";
$resu=mysqli_query($con,$rt);
$posts="";
 while($row=mysqli_fetch_assoc($resu)){
     $pat=$row['path'];
     $posts="";
     $post_id=$row['id'];
     $comments_query="select id,comment from comments where path='$pat';";
     $comments_result=mysqli_query($con,$comments_query);
     $comments="";
    while($comment_row=mysqli_fetch_assoc($resu))
    {
        if($comment_row['path']==$pat){
        $comments.="<p>".$comment_row['id'].'  commented   '.$comment_row['comment']."</p>";}
    }
    $posts.="<button onclick='toggleComments()'>show</button>";
    $posts.="<div id='comment1' style='display:none;'>$comments</div>";
    
}

echo "<div>";
echo "$posts";
echo '</div>';
echo "<div>";
echo '<form method="post" >';
echo  '<input type="hidden" name="path" value="'.$pat.'">';
//echo  "<input type='textarea' name='comment' placeholder='enter your comment'><br>"; 
echo  "<textarea name='comment' placeholder='enter your comment'></textarea><br>";
echo  '<button type="submit" name="comments" >comments</button>';
echo '</form>';
echo "<div align='center' style='background-color:white ;width:300px;height:150px;'>";
echo '</div>';
echo "</center>";
echo "</div>"
;
}

}
echo "</html>";
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
$qu="insert into comments values ('$id','$pid','$com');";
mysqli_query($con,$qu);
}
}



//counting likes
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
<script>
    function toggleComments(){
        var commentsDiv = document.getElementById("comment1");
        if(commentsDiv.style.display==="none"){
            commentsDiv.style.display="block";
        }
        else{
            commentsDiv.style.display="none";
        }
    }
</script>