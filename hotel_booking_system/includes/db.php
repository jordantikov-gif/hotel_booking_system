<?php
$host = "localhost";  
$user = "root";        
$pass = "1234";            
$dbname = "hotel_booking";  

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
