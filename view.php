<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscriber Information</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tariff_plan";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

$contract_number = $_GET['contract_number'];
$sql = "SELECT * FROM Subscribers WHERE contract_number = '$contract_number'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
        <div class="subscriber-info">
            <h2>Информация о абоненте:</h2>
            <p>ФИО: <?php echo $row["full_name"]; ?></p>
            <p>Номер договора: <?php echo $row["contract_number"]; ?></p>
            <p>Номер телефона: <?php echo $row["phone_number"]; ?></p>
            <p>Адрес: <?php echo $row["address"]; ?></p>
            <p>Тарифный план: <?php echo $row["tariff_plan"]; ?></p>
            <p>Блокировка: <?php echo ($row["blocking"] ? "Да" : "Нет"); ?></p>
            <a href="change_tariff_plan.html?contract_number=<?php echo $contract_number; ?>"><button>Изменить тарифный план</button></a>
        </div>
        <?php
    }
} else {
    echo "Абонент с номером договора '$contract_number' не найден.";
}
$conn->close();
?>
</body>
</html>
