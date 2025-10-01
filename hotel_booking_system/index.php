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

    $stmt = $conn->prepare("INSERT INTO reservations (name, email, phone, guests, date, time, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisss", $name, $email, $phone, $guests, $date, $time, $notes);

    if ($stmt->execute()) {
        $success = "Резервацията е успешна!";
    } else {
        $error = "Грешка при записване: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Резервация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div style="width: 400px;">
        <h2 class="mb-3 text-center">Направи резервация</h2>

        <?php if (!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <form method="POST">
            <input type="text" name="name" class="form-control mb-2" placeholder="Име" required>
            <input type="email" name="email" class="form-control mb-2" placeholder="Имейл" required>
            <input type="text" name="phone" class="form-control mb-2" placeholder="Телефон">
            <input type="number" name="guests" class="form-control mb-2" placeholder="Брой гости" required>
            <input type="date" name="date" class="form-control mb-2" required>
            <input type="time" name="time" class="form-control mb-2">
             <?php if (isset($_GET['dates'])): ?>
        <div class="mb-3">
            <label for="dates" class="form-label">Избрани дати</label>
            <input type="text" name="dates" id="dates" class="form-control" 
                   value="<?php echo htmlspecialchars($_GET['dates']); ?>" readonly>
        </div>
    <?php endif; ?> 
            <textarea name="notes" class="form-control mb-3" placeholder="Бележки"></textarea>
            <button type="submit" class="btn btn-primary w-100">Резервирай</button>
            

        </form>
    </div>

</body>
</html>
