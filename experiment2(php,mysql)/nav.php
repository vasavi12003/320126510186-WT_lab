<style>
    *{
        list-style:none;
        text-decoration:none;
    }
    .sidebar{
        position:fixed;
        left:0;
        top:130;
        width:180px;
        height:100%;
        background:#68bde1;
    }
    .sidebar header{
        position:fixed;
        font-size:22px;
        color:black;
        text-align:center;
        line-height:70px;
        background:#68bde1;
        user-select:none;

    }
    .sidebar ul a{
        
        height:90px;
        width:50%;
        line-height:65px;
        font-size:20px;
        color:black;
        padding-left:40px;
        box-sizing:border-box;
        border-top:1px solid rgba(255,255,255,.1);
        border-bottom:1px solid black;
        transition:.4s;


    }
    button{
        width:90px;
        height:40px;

    }

    </style>
<body>
    <div class="sidebar">
        <header></header>
        <ul>
            <li><a href="dash.php"><button>Home</button></a></li>
<li><a href="upp.php"><button>upload a ph            oto</button></a></li>
            <li><a href="watchall.php"><button>my photos</button></a></li>
            <li><a href="viewpr.php"><button>view profile</button></a></li>
            
         </ul>
</div>
</body>

