<?php
    $host = "sql109.epizy.com";
    $user = "epiz_24762160";
    $db_password = "JuItz7HcclcW";
    $db_name = "epiz_24762160_bga";
    $conn = new mysqli($host, $user, $db_password, $db_name);

    $sql = $_GET["q"];
    $result = mysqli_query($conn, $sql);
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/sql/query.css">
    </head>
    <body>
        <div class="main">
        <?php
            if(mysqli_num_rows($result)) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='row'>";
                    $i=0;
                    foreach($row as $element){
                        echo "<div class='col$i'>".$element."</div>";
                        $i++;
                    }
                    echo "</div>";
                }
            }
        ?>
        </div>
    </body>
</html>


