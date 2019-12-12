<?php
    require "db_connect.php";

    $sql = "select * from villages";
    $decoded = json_decode(file_get_contents("http://bga.rf.gd/data/layer_array_data.json"));

    $array = array();
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result))
    {
        array_push($array, intval($row["tile"]));
    }
    var_dump($array);
    echo "<br><br>";
    
    $i=0;
    $error = 0;
    $good = 0;
    $miss = 0;
    foreach($decoded as $val)
    {
        if($val == 1 && !in_array((string)$i, $array))
        {
            $decoded[$i] = 0;
            $error++;
        }
        else if($val == 0 && in_array((string)$i, $array))
        {
            $decoded[$i] = 1;
            $miss++;
        }
        else if($val == 1 && in_array((string)$i, $array))
        {
            $good++;
        }
        $i++;
    }
    echo "<br> Mezők száma: ".$i;
    echo "<br> Fölösleges layer: ".$error;
    echo "<br> Hiányzó layer: ".$miss;
    echo "<br> Helyes: ".$good;

    $encoded = json_encode($decoded);
    file_put_contents($_SERVER['DOCUMENT_ROOT']."/data/layer_array_data.json", $encoded);
    
?>