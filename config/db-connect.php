<?php
//Start sesion
session_start();

$SITEURL = 'http://localhost/Fashion%20and%20Beauty%20website/';
$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DATABASE = 'fashion and beauty';

$con = mysqli_connect($HOSTNAME,$USERNAME,$PASSWORD,$DATABASE);

if($con){
   
}
else{
    die(mysqli_error($concon));
}
?>