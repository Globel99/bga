<html>
<head>
    <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/styles/village.css">
</head>
<body>
</body>


    <?php
       session_start();
       if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");
       file_get_contents("http://bga.rf.gd/scripts/event_list.php");
   
       echo "wall of tile ".$_SESSION["tiles"][$_GET["t"]];
    ?>


</html>