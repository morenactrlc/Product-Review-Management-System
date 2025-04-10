<?php
$conn = new mysqli('localhost', 'root', '', 'exam');
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $conn->real_escape_string($_POST['product']);
    $review_text = $conn->real_escape_string($_POST['review_text']);
    $rating = (int)$_POST['rating'];
    $username = $conn->real_escape_string(trim($_POST['username']));

    // 1. Проверяем, есть ли такой пользователь
    $user_check = $conn->query("SELECT id FROM users WHERE name = '$username' LIMIT 1");
    if ($user_check->num_rows > 0) {
        // Пользователь найден
        $user = $user_check->fetch_assoc();
        $user_id = $user['id'];
    } else {
        // Пользователя нет — добавим
        $conn->query("INSERT INTO users (name) VALUES ('$username')");
        $user_id = $conn->insert_id; // Получаем ID нового пользователя
    }

    // 2. Добавляем отзыв
    $sql = "INSERT INTO reviews (text, date, raiting, user_id, username, product_id)
            VALUES ('$review_text', NOW(), '$rating', '$user_id', '$username', '$product_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Отзыв добавлен! <a href='exam_view_review.php'>Смотреть отзывы</a>";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
