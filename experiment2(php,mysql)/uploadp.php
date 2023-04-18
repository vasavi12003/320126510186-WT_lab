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

   if(isset($_POST["submit"]) && !empty($_FILES["usefile"]["name"])){
      $errors= array();
      $file_name = $_FILES["usefile"]["name"];
      $file_size = $_FILES["usefile"]["size"];
      $file_tmp = $_FILES["usefile"]["tmp_name"];
      $file_type = $_FILES["usefile"]["type"];
      $dedir="pics/".$file_name;
      $ty=time();
      $id=$_SESSION['uname'];
     
      
      
         if(move_uploaded_file($file_tmp,$dedir)){
         $con = mysqli_connect("localhost","root","","lab_expt");
	 if($con){
	
	$sql_q="INSERT into ins (id,path,po_time) values ('$id','$dedir','$ty');";
	if(mysqli_query($con,$sql_q)){
	echo "<script>alert('uploaded successfully')</script>";
   header("location:upp.php");
}
}
      }
mysqli_close($con);
   }
else
echo "erro";
?>
</div>
</body>

