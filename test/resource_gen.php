<?php
    $backg = json_decode(file_get_contents("http://bga.rf.gd/data/backg_array_data.json"));
    $layer = json_decode(file_get_contents("http://bga.rf.gd/data/layer_array_data.json"));

    $i = 0;
    $result = array();

    foreach($backg as $b)
    {
        $arr = array_fill(0, 12, 0);
        if($b != 255)
        {
            switch($layer[$i])
            {
                //0 plain
                //1 forest
                //2 hill with forest
                //3 hill
                //4 mine
                //5 town
                case 1:
                {
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
                }
                break;

                default:break;
            }
        }
        $result[$i] = $arr;

        $i++;
    }

    file_put_contents($_SERVER['DOCUMENT_ROOT']."/data/resource_field_types.json", json_encode($result));
?>