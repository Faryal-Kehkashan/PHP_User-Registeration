<?php

$username = "root";
$password = "";
$server = "localhost";
$databse = "Users1";

$conn = mysqli_connect($server, $username, $password, $databse);

if(!$conn)
{
    echo "Connection to database failed due to " . mysqli_connect_error();
}
else{
    // echo "Connect succcessfully";
}


?>