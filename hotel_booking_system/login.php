<?php
session_start();
include("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && $admin['password'] === $password) {
        $_SESSION['admin'] = $admin['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Невалидно потребителско име или парола!";
    }
}
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Админ Вход</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div>
        <h2>Вход за администратор</h2>

        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <form method="POST">
            <input type="text" name="username" class="form-control mb-2" placeholder="Потребител" required>
            <input type="password" name="password" class="form-control mb-3" placeholder="Парола" required>
            <button type="submit" class="btn btn-primary w-100">Вход</button>
        </form>
    </div>

</body>
</html>
