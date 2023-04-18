<style>
    *{
        margin:0;}
    body{
        background-color:#68bde1;
    }
    #div1{
        background-color:#68bde1;
        height:140px;
        text-align:center; }
    #div2{
        background-color:#bef2ff;
        height:603px;
        text-align:center; 
        width:607px;
        float:left;
}
    #div3{
        background-color:#c7f3ff;
        height:565px;
        text-align:center; 
    float:left;
    padding-right:0;
width:912px;
height:400px}
    </style>
<body>
    <div id="div1">
        <h1>welcome to facebook</h1>
    </div>
    <div id="div2">
        <?php
        include("views.php");
        
        ?>
    </div>
    <div id="div3">
       <?php include("login.php");
       ?>
</div>
</body>

