<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include("includes/db.php");

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM reservations WHERE id = $id");
$reservation = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $guests = $_POST['guests'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $notes = $_POST['notes'];

    $stmt = $conn->prepare("UPDATE reservations SET name=?, email=?, phone=?, guests=?, date=?, time=?, notes=? WHERE id=?");
    $stmt->bind_param("sssisssi", $name, $email, $phone, $guests, $date, $time, $notes, $id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Редактиране на резервация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Редактиране на резервация</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Име</label>
            <input type="text" name="name" class="form-control" value="<?= $reservation['name'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Имейл</label>
            <input type="email" name="email" class="form-control" value="<?= $reservation['email'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Телефон</label>
            <input type="text" name="phone" class="form-control" value="<?= $reservation['phone'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Гости</label>
            <input type="number" name="guests" class="form-control" value="<?= $reservation['guests'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Дата</label>
            <input type="date" name="date" class="form-control" value="<?= $reservation['date'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Час</label>
            <input type="time" name="time" class="form-control" value="<?= $reservation['time'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Бележки</label>
            <textarea name="notes" class="form-control"><?= $reservation['notes'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Запази</button>
        <a href="dashboard.php" class="btn btn-secondary">Отказ</a>
    </form>
</body>
</html>
