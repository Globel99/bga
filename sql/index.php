<html>
    <head>
        <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/sql/sql.css">
    </head>
    <body>
        <div id="upper">
            <p>Query</p>
            <input id="input" onkeypress="keyPressed(event)">
            <div id="buttonDiv">
                <button onclick="process()">Process</button>
            </div>
        </div>
        <div id="lower">
            <p>Result</p>
            <div>
                <div id="navigate"></div>
                <div id="result">
                    <iframe id="iframe" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </body>
    <script>
        const iframe = document.getElementById("iframe");
        const input = document.getElementById("input");

        process = (header) =>
        {
            let url = "http://bga.rf.gd/sql/query.php?q=" + header;
            iframe.src = url;
        }
        function keyPressed(e)
        {
            if(e.keyCode == 13) {
                process(input.value);
            }
        }
    </script>

    <?php
        include $_SERVER['DOCUMENT_ROOT'].'/scripts/db_connect.php';
        $str;
        $res = mysqli_query($conn, "show tables");
        while($row = mysqli_fetch_assoc($res))
        {
        $str .= "<div>".$row[0]."</div>";
        }
        echo "<script>document.getElementById('navigate').innerHTML = $str;</script>"
    ?>

</html>

