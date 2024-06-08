<?php
require_once("database.php");

if (isset($_POST['submit'])) {
    if ($_POST['name'] != "Name") {
        $strSurname = $_POST['name'];
    }
    if (isset($_POST['date1'])) {
        $ot_data = $_POST['date1'];
    }
    if (isset($_POST['date2'])) {
        $do_data = $_POST['date2'];
    }

    
    $queryPurchases = "SELECT * FROM purchases WHERE customer_surname='$strSurname' AND purchase_date BETWEEN '$ot_data' AND '$do_data'";
    $dbPurchasesRecords = mysqli_query($con, $queryPurchases);

    if (!$dbPurchasesRecords) {
        die('Неуспешно запитване. Получи следната грешка' . mysqli_error($con));
    }

    
    while ($purchase = mysqli_fetch_array($dbPurchasesRecords)) {
        :
        echo "Дата на покупка: " . $purchase['purchase_date'] . "<br>";
        echo "Сума: " . $purchase['amount'] . "<br>";
   
    }
}
?>