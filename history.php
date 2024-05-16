<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tariff_plan";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

$contract_number = isset($_GET['contract_number']) ? $_GET['contract_number'] : '';

if (!empty($contract_number)) {
    $sql = "SELECT old_tp, new_tp, change_date FROM change_history WHERE id_sub = (SELECT id FROM subscribers WHERE contract_number = '$contract_number')";
    $result = $conn->query($sql);
    $history = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $history[] = $row;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($history);
} else {
    header('Content-Type: application/json');
    echo json_encode(array("error" => "Ошибка: Не указан номер договора."));
}

$conn->close();
?>
