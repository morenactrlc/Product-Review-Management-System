<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить отзыв</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Добавить отзыв</h1>
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
        <form action="exam_submit_review.php" method="POST">
            <label for="product">Выберите товар:</label>
            <select name="product" id="product">
                <!-- Здесь динамически генерируются варианты товаров из базы данных -->
                <?php
                // Пример подключения к базе данных и выборки товаров
                $conn = new mysqli('localhost', 'root', '', 'exam');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT id, name FROM products";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
                $conn->close();
                ?>
            </select>
            <br>
            <label for="review_text">Текст отзыва:</label>
            <textarea name="review_text" id="review_text" required></textarea>
            <br>
            <label for="rating">Оценка (1–5):</label>
            <input type="number" name="rating" id="rating" min="1" max="5" required>
            <br>
            <label for="username">Имя пользователя:</label>
            <input type="text" name="username" id="username" required>
            <br>
            <button type="submit">Отправить</button>
        </form>
    </section>
</body>
</html>
