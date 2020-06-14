<?php
require('connection.php');
require('functions.php');
// module to save data comming from devices
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $username = validate($_POST['username']);
    // $password = validate($_POST['password']);
    $device = validate($_POST['device']);
    $sql = "select id, username, password from users where device=$device";//sql to select the device
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $n = validate($_POST['n']);
        $p = validate($_POST['p']);
        $k = validate($_POST['k']);
        $ph = validate($_POST['ph']);
        $moisture = validate($_POST['moisture']);
        $t = time();
        $user_id = $row['id'];
        $sql = "insert into tests(n,p,k,ph,moisture,timestamp,user_id) values($n,$p,$k,$ph,$moisture,$t,$user_id)";//insert into database
        if ($conn->query($sql)) {
            echo "SUCCESS";
        } else {
            echo "ERROR".$sql . $conn->error;
        }
    } else {
        echo "Invalid credentials";
    }
}
