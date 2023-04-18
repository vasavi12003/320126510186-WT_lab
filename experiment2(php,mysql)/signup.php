<html>
<head>
<title> REGISTRATION PAGE </title>
<style>
   

   body{
    background-color:lightgreen;
    /*background-repeat: no-repeat;
    background-size:cover;*/
    
    }
    .t{
    width:10px;
    background-color:#98e5ec;
    margin: 50px auto 0px auto;
    }
    body
    {
    background-color:#c7f3ff;
    }
    .l{
    background-color:lightblue;
    }
    .le{
    width:100px;
    height:100px;
}
    h1{
    text-align:center;
    font-size:50px;
    text-decoration:underline;
    }
    input{
    text-align:center;
    border-color:green;
    margin:10px;
    background-color:white;}
    .rel{
    border-color:solid lightgray;
    background-color:white;
    margin:10px
    text-align:center;
}
    textarea{
    background-color:white;
    margin:10px;
    text-align:center;
    }
    .s{
    background-color:#FAEBD7;
    }
    
</style>
</head>
<body>
<h1>SIGN UP</h1>
<div class="form-container">
<center><a href="main1.php" id="t"><h2><button>login>></h2></button></a></center>
<form name="f1" action="verify.php" method="post">
<table class="t">
<tr>
<td> NAME: </td>
<td><input type="text" name="nm"></td>
</tr>
<tr>
<td> EMAIL: </td>
<td><input type="email" name="eid"></td>
</tr>
<tr>
<td> PASSWORD: </td>
<td><input type="password" name ="pwd"></td>
</tr>
<tr>
    <td><input type="submit" name="submit" value="SIGNUP"></td>
</tr>
</form>
</div>
</body>
</html>


