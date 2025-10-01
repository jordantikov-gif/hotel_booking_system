<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include("includes/db.php");

// Само една заявка към базата
$result = $conn->query("SELECT * FROM reservations ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Админ панел</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Добре дошъл, <?php echo $_SESSION['admin']; ?>!</h2>
    <a href="logout.php" class="btn btn-secondary mb-3">Изход</a>

    <h3>Списък с резервации</h3>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Име</th>
                <th>Имейл</th>
                <th>Телефон</th>
                <th>Гости</th>
                <th>Дата</th>
                <th>Час</th>
                <th>Бележки</th>
                <th>Създадена на</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= $row['guests'] ?></td>
                <td><?= $row['date'] ?></td>
                <td><?= $row['time'] ?></td>
                <td><?= $row['notes'] ?></td>
                <td><?= $row['created_at'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Редактирай</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Изтрий</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
