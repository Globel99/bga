<?php
    
    $arr = array_fill(0, 12, 0);

    $arr[6] = 5;
    /*number of*/$hill = 3;
    /*number of*/$forest = 4;

    for($k=0;$k<$forest;$k++)
    {
        do{
            $r = rand(0,12);
        }while($arr[$r]);

        $arr[$r] = 1;
    }

    for($k=0;$k<$hill;$k++)
    {
        do{
            $r = rand(0,12);
        }while($arr[$r]);

        $arr[$r] = 2;
    }
?>