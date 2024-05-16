<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список абонентов</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Статус блокировки</th>
    </tr>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tariff_plan";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
    $sql = "SELECT * FROM subscribers ORDER BY blocking ASC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Применяем стили в зависимости от статуса блокировки
            $class = ($row["blocking"] == 1) ? "subscriber-blocked" : "subscriber-active";
            echo "<tr class='$class'>";
            echo "<td>" . $row["id"]. "</td>";
            echo "<td>" . $row["full_name"]. "</td>";
            echo "<td>" . ($row["blocking"] == 1 ? "Заблокирован" : "Не заблокирован") . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Нет результатов</td></tr>";
    }
    $conn->close();
    ?>
</table>
</body>
</html>
