<?php
require('../connection.php');
require('../functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = validate($_POST['name']);
    $type = validate($_POST['type']);
    $ph_low = validate($_POST['ph_low']);
    $ph_high = validate($_POST['ph_high']);
    $n = validate($_POST['n']);
    $p = validate($_POST['p']);
    $k = validate($_POST['k']);
    $fertilizer = validate($_POST['fertilizer']);
    $description = validate($_POST['description']);
    $external_link = validate($_POST['external_link']);
    $image_src = validate($_POST['image_src']);


    $sql = "insert into crops(name,type,ph_low,ph_high,n,p,k,fertilizer,description,external_link,image_src) values('$name','$type',$ph_low,$ph_high,'$n','$p','$k','$fertilizer','$description','$external_link','$image_src')";
    if ($conn->query($sql)) {
        echo "hello";
    } else {
        echo $sql.$conn->error;
    }
}
