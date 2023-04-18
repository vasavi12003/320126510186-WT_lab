<?php
$connect=mysqli_connect("localhost","root","","lab_expt");
$n=$_POST["nm"];
$e=$_POST["eid"];
$p=$_POST["pwd"];
if(!empty($n)&& !empty($e) && !is_numeric($n))
    {
        $query="INSERT INTO regform(sname,email,password) VALUES ('$n','$e','$p')";
        //mysqli_query($connect,$query);
        //header("Location:login.php");
        //die;}
//$query="INSERT INTO regform(sname,email,password) VALUES ('$n','$e','$p')";
$res=mysqli_query($connect,$query);
if($res){
        echo "<script>alert('registered Successfully...')</script>";
        
        header("Location:main1.php");

}
else{
        echo "<script>alert('registration Falied...')</script>";
        header("Location:verify.php");
}
die;}
else{
        echo "Please enter some valid information";
    }
?>
