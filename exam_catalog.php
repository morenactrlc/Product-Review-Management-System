<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог товаров</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Каталог товаров</h1>
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
        <?php
        // Подключение к базе данных
        $conn = new mysqli('localhost', 'root', '', 'exam'); // <-- замени на свои данные
        if ($conn->connect_error) {
            die("Ошибка подключения: " . $conn->connect_error);
        }

        // Получение всех товаров
        $sql = "SELECT id, name, overview FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                echo "<p>" . htmlspecialchars($row['overview']) . "</p>";
                echo "<a href='exam_view_review.php?product_id=" . $row['id'] . "'>Посмотреть отзывы</a> ";
                echo "<a href='exam_add_review.php?product_id=" . $row['id'] . "'>Добавить отзыв</a>";
                echo "</div>";
            }
        } else {
            echo "<p>Нет доступных товаров.</p>";
        }

        $conn->close();
        ?>
    </section>
</body>
</html>
