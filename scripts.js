function setCityCode() {
    var citySelect = document.getElementById("city");
    var contractNumberField = document.getElementById("contract_number");
    var cityCode = citySelect.value;
    contractNumberField.value = cityCode;
}
function setTariffPlan() {
    var tariffplanSelect = document.getElementById("tariff_plan");
    var contractNumberField = document.getElementById("contract_number");
    var tariffplanCode = tariffplanSelect.value;
    contractNumberField.value = tariffplanCode;
}
function openModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
}
function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}
function checkContractNumber() {
    var contractNumber = document.getElementById("modal_contract_number").value.trim();
    if (contractNumber === "") {
        alert("Пожалуйста, введите номер договора.");
        return;}
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {window.location.href = "view.php?contract_number=" + contractNumber;}
            else {
                console.error("Ошибка при выполнении запроса: " + xhr.status);
                alert("Произошла ошибка при выполнении запроса.");}
        }
    };
    xhr.open("GET", "view.php?contract_number=" + contractNumber, true);
    xhr.send();
}

