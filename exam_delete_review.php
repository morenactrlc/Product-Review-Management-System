<?php
// Проверка, что передан ID отзыва
if (!isset($_GET['id'])) {
    die("Ошибка: ID отзыва не указан.");
}

$review_id = (int)$_GET['id'];

// Подключение к базе
$conn = new mysqli('localhost', 'root', '', 'exam');
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Удаляем отзыв
$sql = "DELETE FROM reviews WHERE id = $review_id";
if ($conn->query($sql) === TRUE) {
    echo "Отзыв удалён. <a href='exam_view_review.php'>Вернуться к списку отзывов</a>";
} else {
    echo "Ошибка при удалении: " . $conn->error;
}

$conn->close();
?>
