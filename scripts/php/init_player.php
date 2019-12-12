<?php
    if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");

    function initUsersTile(){
        $backg_array = json_decode(file_get_contents("http://bga.rf.gd/data/backg_array_data.json"));
        $layer_array = json_decode(file_get_contents("http://bga.rf.gd/data/layer_array_data.json"));
    
        $bool = false;
        while($bool == false)
        {
            $tile = rand(0,4095);
            if($backg_array[$tile] != 255 && $layer_array[$tile] == 0)
            {
                $bool = true;
            }
        }
        $un = $_SESSION["username"];

        $sql = "INSERT INTO villages VALUES ($tile, '$un', 'village1')";
        $result = mysqli_query($GLOBALS["conn"], $sql);
        
        if(!$result) {
            die("create village error");
        } else {
            $sql2 = "INSERT INTO resources VALUES ($tile, '100', '2', '100', '2', '100', '2')";
            $result2 = mysqli_query($GLOBALS["conn"], $sql2);
            if(!$result2) {
                die("addig resources to 1st village was unsuccesful");
            }
        }

        $url = "http://bga.rf.gd/scripts/layer_array_replace.php?pw=szkuvi&rep=".$tile."&with=1";
        $contents = file_get_contents($url);
    
        
        //nyersanyag mezők
        $resource_fields = json_decode(file_get_contents("http://bga.rf.gd/data/resource_field_types.json"));
        
        require "resource_field_generator.php";

        $resource_fields[$tile] = $arr;

        file_put_contents($_SERVER['DOCUMENT_ROOT']."/data/resource_field_types.json", json_encode($resource_fields));
        //
    }
    
?>