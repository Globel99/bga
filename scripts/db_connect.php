<?php
$host = "sql109.epizy.com";
$user = "epiz_24762160";
$db_password = "JuItz7HcclcW";
$db_name = "epiz_24762160_bga";

$conn = new mysqli($host, $user, $db_password, $db_name);

$GLOBALS["conn"] = $conn;

?>