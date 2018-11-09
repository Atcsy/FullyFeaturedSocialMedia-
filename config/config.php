<?php
ob_start(); // turns on output buffering
session_start();
$timezone = date_default_timezone_get("	Europe/Budapest");

//temporary connection
$con = mysqli_connect("localhost", "root", "root", "realsocialmedia");
if(mysqli_connect_errno())
{
    echo "failed to connect:" . mysqli_connect_errno();
}

// make test connection for prepared statements
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "realsocialmedia";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
