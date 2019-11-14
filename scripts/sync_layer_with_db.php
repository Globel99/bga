<?php
    include "db_connect.php";

    $sql = "select * from villages";
    $decoded = json_decode(file_get_contents("layer_array_data.json"));

    $array = array();
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result))
    {
        array_push($array, $row["tile"]);
    }
    var_dump($array);
    
    $i=0;
    $error =0;
    $good = 0;
    foreach($decoded as $val)
    {
        if($val == 1 && !in_array((string)$i, $array))
        {
            $decoded[$i] = 0;
            $error++;
        }
        if($val == 1 && in_array((string)$i, $array))
        {
            $good++;
        }
        $i++;
    }
    echo "<br>".$i;
    echo "<br>".$error;
    echo "<br>".$good;

    $encoded = json_encode($decoded);
    file_put_contents("layer_array_data.json", $encoded);
    
?>