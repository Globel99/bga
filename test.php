<?php
require "Medoo.php";
use Medoo\Medoo;

$database = new Medoo();

$data = $database->query("select * from resources")->fetchAll();

echo print_r($data[0]);
?>