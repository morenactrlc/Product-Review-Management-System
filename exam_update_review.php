<?php
$conn = new mysqli('localhost', 'root', '', 'exam');
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $review_id = (int)$_POST['review_id'];
    $review_text = $conn->real_escape_string($_POST['review_text']);
    $rating = (int)$_POST['rating'];

    $sql = "UPDATE reviews SET text = '$review_text', raiting = '$rating' WHERE id = $review_id";

    if ($conn->query($sql)) {
        echo "Отзыв обновлён! <a href='exam_view_review.php'>Вернуться к списку</a>";
    } else {
        echo "Ошибка при обновлении: " . $conn->error;
    }
}

$conn->close();
?>
