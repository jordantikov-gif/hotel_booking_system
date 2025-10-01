<?php
include("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $phone  = $_POST['phone'];
    $guests = $_POST['guests'];
    $date   = $_POST['date'];
    $time   = $_POST['time'];
    $notes  = $_POST['notes'];

    $stmt = $conn->prepare("INSERT INTO reservations (name, email, phone, guests, date, time, notes) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisss", $name, $email, $phone, $guests, $date, $time, $notes);

    if ($stmt->execute()) {
        echo "Успешна резервация";
    } else {
        echo "Грешка при записването: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
