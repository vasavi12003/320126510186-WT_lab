<?php
$con = mysqli_connect("localhost","root","","lab_expt");
$q="select path,count(*) as high from likes group by path order by high  desc limit 3;";
$res=mysqli_query($con,$q);

?>
<br>
<h2 style="text-align:left">highest liked posts</h2>
<table border="1" cellspacing="0" cellpadding="6" align="left" bgcolor="#68bde1">
<tr>
<th>id</th>
<th>posts</th>
<th>likes</th>
<th>comments</th>
</tr>
<?php
if(mysqli_num_rows($res)>=1)
{
while($row=mysqli_fetch_assoc($res))
{
$pat=$row['path'];
$we="select id as c from ins where path in ('$pat');";
$z=mysqli_query($con,$we);
while($row=mysqli_fetch_assoc($z)){
echo "<tr>";
echo "<td>".'<p style="font-size:30px;color:#155363" align="center"> '.$row['c'].'</p>'."</td>";;
break;
}
echo "<td>";
echo "<div align='center' style='background-color:red'><img  src='$pat' height='100'  width='100' align='center'>"."</td>";
echo "<td>".'<span class="likes">'.count_likes($pat).'</span><br>'."</td>";
echo "</div>";
echo '<div style="background-color:#808080">';
//echo 'All comments<br>';
echo "</td>";
$rt="select id,comment from comments where path='$pat';";
$resu=mysqli_query($con,$rt);
if(mysqli_num_rows($resu)>=1)
{
echo "<td>";
while($row=mysqli_fetch_assoc($resu))
{
echo   "<strong>".($row['id'])."</strong>".'  comments '.($row['comment']).'<br>';
}
echo "</td>";
}
echo '</div>';
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
</table>