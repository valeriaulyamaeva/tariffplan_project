<?php
$contract_number = isset($_POST['contract_number']) ? $_POST['contract_number'] : '';
$new_tariff_plan = isset($_POST['new_tariff_plan']) ? $_POST['new_tariff_plan'] : '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($contract_number) && !empty($new_tariff_plan)) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tariff_plan";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
    $lastChangeQuery = "SELECT MAX(change_date) AS last_change FROM change_history WHERE id_sub = (SELECT id FROM subscribers WHERE contract_number = '$contract_number')";
    $lastChangeResult = $conn->query($lastChangeQuery);
    $lastChangeDate = null;
    if ($lastChangeResult->num_rows > 0) {
        $row = $lastChangeResult->fetch_assoc();
        $lastChangeDate = strtotime($row["last_change"]);
    }
    if ($lastChangeDate !== null && time() - $lastChangeDate < 24 * 60 * 60) {
        echo "Ошибка: Тарифный план можно изменить только раз в сутки.";
    } else {
        $updateQuery = "UPDATE subscribers SET tariff_plan = '$new_tariff_plan' WHERE contract_number = '$contract_number'";
        if ($conn->query($updateQuery) === TRUE) {
            $insertHistoryQuery = "INSERT INTO change_history (id_sub, old_tp, new_tp, change_date) VALUES ((SELECT id FROM subscribers WHERE contract_number = '$contract_number'), (SELECT tariff_plan FROM subscribers WHERE contract_number = '$contract_number'), '$new_tariff_plan', NOW())";
            if ($conn->query($insertHistoryQuery) === TRUE) {echo "Тарифный план успешно изменен.";}
            else {echo "Ошибка при добавлении записи в историю изменений: " . $conn->error;}}
        else {echo "Ошибка при обновлении тарифного плана: " . $conn->error;}}
    $conn->close();
} else {echo "Ошибка: Не удалось изменить тарифный план. Пожалуйста, убедитесь, что вы заполнили все поля и отправили форму.";}
?>
