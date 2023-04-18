<html>



<body>
  
    <h1 align="center">WELCOME TO LOGIN PAGE</h1>
    
   <center> <a href="main.php"><button> >>signup </button></a> &nbsp;&nbsp;&nbsp;</center>
   <br>
   <br>
    <div class="box">
    <form method="post" >
    <table align="center" >
    <tr>
                  <td><label for="name" style="color:blue">Name:</label></td>
                  <td><input type="text" name="name" id="name" placeholder="your name"></td>
    </tr>
    <tr>
                  <td><label for="email" style="color:blue">Email:</label></td>
                  <td><input type="text" name="email" id="email" placeholder="your email"></td>
                </tr>          
    <tr>
                  <td><input type="submit" class="submit" value="LOGIN" name="submit" /></td> &nbsp;&nbsp;&nbsp;
                </tr>
</table>
</form>
                
</div>


</html>
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uname = $_POST["name"];
        $email=$_POST["email"];
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'lab_expt';

        $conn = mysqli_connect($host, $username, $password, $dbname);

        if ($conn) {
            echo "";
        }
        else{
            echo "Connection Failed.";
            die("Connection Failed:".mysqli_connect_error());
        }
        $sql = "select * from regform where sname='$uname' and email='$email'";
        $res = mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)>0){
           $_SESSION['uname']=$uname;
           header('Location:dash.php');
        }
        else{
            echo "<script>alert('invalid login.Please enter correct mail id and username')</script>";
           //header('Location:login.php');
        }
}
?>
<style> 
body{
    /*background-image:url("https://tse4.mm.bing.net/th?id=OIP.NnyZNxsYGudJ29vt096W6wHaE6&pid=Api&P=0");*/
    background-color:#c7f3ff;
    background-repeat: no-repeat;
    background-size:cover;
    font-weight: 200px;
    /*font-style: italic;*/
    background-repeat: no-repeat;
    background-size: cover;
}
h1{
    color:black;
   /* margin-top:30px;*/
}
.box{
    padding: 10px;
    margin-left: 35%;
    margin-right: 35%;
    background-color:pink;
    border-radius: 10px;
}
td{
    font-size: 15px;
   
}
</style>
