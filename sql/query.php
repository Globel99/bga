<?php
    include $_SERVER['DOCUMENT_ROOT'].'/scripts/db_connect.php';

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


