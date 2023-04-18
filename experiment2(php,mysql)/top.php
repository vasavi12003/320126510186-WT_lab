<?php
session_start();
?>
<html>
<body style="background-color:#53a8b6">


<h1 align="center" id="h1">welcome to facebook
    <?php
    ?><img src="https://tse3.mm.bing.net/th?id=OIP.gySs21u2ywRj0ZS5p4bWiAHaH6&pid=Api&P=0" width="50" height="60"><?php
    echo "<i>";
    echo"<br>";
    echo $_SESSION['uname'];
    echo "</i>";
    ?></h1>
    
<form align="right" action="login.php" method="post">
    <input type="submit" name="logout" value="logout">
</form>
</body>
</html>
