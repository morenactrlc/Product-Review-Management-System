<?php
// Проверяем, передан ли ID отзыва
if (!isset($_GET['id'])) {
    die("Отзыв не найден.");
}

$review_id = (int)$_GET['id'];

// Подключение к БД
$conn = new mysqli('localhost', 'root', '', 'exam');
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получаем данные отзыва
$sql = "SELECT * FROM reviews WHERE id = $review_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Отзыв с таким ID не найден.");
}

$review = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать отзыв</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>Редактировать отзыв</h1>
</header>
<nav>
        <ul>
        <li><a href="exam_index.php">Главная</a></li>
            <li><a href="exam_catalog.php">Каталог товаров</a></li>
            <li><a href="exam_add_review.php">Добавить отзыв</a></li>
            <li><a href="exam_view_review.php">Просмотреть отзывы</a></li>
        </ul>
    </nav>
<section>
    <form action="exam_update_review.php" method="POST">
        <input type="hidden" name="review_id" value="<?= $review['id'] ?>">

        <label for="review_text">Текст отзыва:</label>
        <textarea name="review_text" id="review_text" required><?= htmlspecialchars($review['text']) ?></textarea>
        <br>

        <label for="rating">Оценка (1–5):</label>
        <input type="number" name="rating" id="rating" min="1" max="5" value="<?= (int)$review['raiting'] ?>" required>
        <br>

        <button type="submit">Сохранить изменения</button>
    </form>
</section>
</body>
</html>
