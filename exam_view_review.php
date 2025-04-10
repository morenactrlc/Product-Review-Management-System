<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Просмотр отзывов</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Отзывы</h1>
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
        <table>
            <tr>
                <th>Название товара</th>
                <th>Автор</th>
                <th>Рейтинг</th>
                <th>Текст</th>
                <th>Дата</th>
                <th>Действия</th>
            </tr>

            <?php
            // Подключение к базе
            $conn = new mysqli('localhost', 'root', '', 'exam');
            if ($conn->connect_error) {
                die("Ошибка подключения: " . $conn->connect_error);
            }

            // Запрос: берём отзывы с привязкой к товарам
            $sql = "SELECT r.id, r.text, r.date, r.raiting, r.user_id, r.username, r.product_id, p.name AS product_name
            FROM reviews r
            JOIN products p ON r.product_id = p.id
            ORDER BY r.date DESC";
    

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['username'] ?? 'Аноним') . "</td>";

                    echo "<td>" . (int)$row['raiting'] . "</td>";
                    echo "<td>" . nl2br(htmlspecialchars($row['text'])) . "</td>";
                    echo "<td>" . date("d.m.Y", strtotime($row['date'])) . "</td>";
                    echo "<td>
                            <a href='exam_edit_review.php?id=" . $row['id'] . "'>Редактировать</a> |
                            <a href='exam_delete_review.php?id=" . $row['id'] . "'>Удалить</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Отзывов пока нет</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </section>
</body>
</html>
