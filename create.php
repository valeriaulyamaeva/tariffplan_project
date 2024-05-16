<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tariff_plan";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
$full_name = $_POST['full_name'];
$contract_number = $_POST['contract_number'];
$phone_number = $_POST['phone_number'];
$address = $_POST['address'];
$tariff_plan = $_POST['tariff_plan'];
$blocking = isset($_POST['blocking']) ? $_POST['blocking'] : 0;
$sql = "INSERT INTO Subscribers (full_name, contract_number, phone_number, address, tariff_plan, blocking) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $full_name, $contract_number, $phone_number, $address, $tariff_plan, $blocking);
if ($stmt->execute()) {
    echo '<script>alert("Карточка абонента успешно создана");</script>';
} else {
    echo '<script>alert("Ошибка при создании карточки абонента: ' . $stmt->error . '");</script>';
}
$stmt->close();
$conn->close();
?>
