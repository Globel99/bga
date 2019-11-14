<?php
echo "logout";
/*
var_dump($_COOKIE[0]);
var_dump($_COOKIE[1]);
unset($_COOKIE[0]);
unset($_COOKIE[1]);*/

session_start();
session_destroy();
header("location: http://bga.rf.gd/index.html");
?>