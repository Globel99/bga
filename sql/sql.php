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
            <div id="result">
                <iframe id="iframe" frameborder="0"></iframe>
            </div>
        </div>
    </body>
    <script>
        const iframe = document.getElementById("iframe");
        const input = document.getElementById("input");
        process = () =>
        {
            let url = "http://bga.rf.gd/sql/query.php?q=" + input.value;
            iframe.src = url;
        }
        function keyPressed(e)
        {
            if(e.keyCode == 13) {
                process();
            }
        }
    </script>
</html>
