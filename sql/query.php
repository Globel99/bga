<?php
    include $_SERVER['DOCUMENT_ROOT'].'/scripts/db_connect.php';

    $sql = $_GET["q"];
    if(!$result = mysqli_query($conn, $sql))
    die("\nError: ".mysqli_error($conn))
    
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/sql/query.css">
    </head>
    <body>
        <div class="main">
        <?php
            echo "Affected rows: " . mysqli_affected_rows($conn);
            if(is_bool($result))
            {
                echo "<br>Successful query!";
            }else
            {
                echo "<div class='headerRow'>";
                $headerRow = mysqli_fetch_fields($result);
                foreach ($headerRow as $val) {
                    echo "<div>";
                    printf($val->name);
                    echo "</div>";
                    /*printf("Table:     %s\n",   $val->table);
                    printf("Max. Len:  %d\n",   $val->max_length);
                    printf("Length:    %d\n",   $val->length);
                    printf("charsetnr: %d\n",   $val->charsetnr);
                    printf("Flags:     %d\n",   $val->flags);
                    printf("Type:      %d\n\n", $val->type);*/
                }
                echo "</div>";
    
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
            }
            mysqli_close($conn);

        ?>
        </div>
    </body>
</html>


