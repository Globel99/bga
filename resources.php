<?php
    require_once "init.php";
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=0.35">
        <meta charset="utf-8">
        <script type="text/javascript" src="scripts/js/simple_request.js"></script>
        <script type="text/javascript" src="scripts/js/resources_page.js"></script>
        <link rel="stylesheet" type="text/css" href="styles/basic.css">
        <link rel="stylesheet" type="text/css" href="styles/header.css">
        <link rel="stylesheet" type="text/css" href="styles/resources.css">
    </head>
    <body>
        <?php include "header.php"; echo $header;?>
        <div id="container">
        <?php
            $k=0;
            $array = array(22, 18, 17, 16, 14, 13, 11, 10, 8, 7, 6, 2);
            for($i=0;$i<25;$i++)
            {
                $resource = in_array($i, $array);
                $village = ($i == 12);
                
                echo "<div";
                if ($village) echo " class='village'";
                if ($resource)
                {
                    $k++;
                    echo " class='resource'";
                }
                    echo ">";

                echo "</div>";
            }
        ?>
    </body>
</html>