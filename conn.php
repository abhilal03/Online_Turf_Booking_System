<?php

function connect()
{
    $server = "localhost";
$user = "root";
$pass = "";
$database = "turfmanagement";
    $conn = mysqli_connect($server, $user, $pass, $database);
    if (!$conn) die("<script>alert('Connection Failed.')</script>");
    return $conn;
}
$conn = connect();
if (!$conn) die("<script>alert('Connection Failed.')</script>");

