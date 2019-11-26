<html>
    <head>
        <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/sql/sql.css">
        <script type="text/javascript" src="index.js"></script>
    </head>
    <body>
        <div id="upper">
            <p>Query</p>
            <input id="input" onkeypress="keyPressed(event)" type="text">
            <div id="buttonDiv">
                <button id="button">Process</button>
            </div>
        </div>
        <div id="lower">
            <p>Result</p>
            <div id="container">
                <div id="navigate"></div>
                <iframe id="iframe" frameborder="1"></iframe>
            </div>
        </div>
    </body>

    <?php
        include $_SERVER['DOCUMENT_ROOT'].'/scripts/db_connect.php';
        $str;
        $res = mysqli_query($conn, "show tables");
        $i = 0;
        while(($row = mysqli_fetch_assoc($res)) && $i<30)
        {
            $str .= "<div>".reset($row)."</div>";
            $i++;
        }
        echo "<script>
        document.getElementById('navigate').innerHTML = '$str';
        initNavigate();
        </script>";
    ?>

</html>

