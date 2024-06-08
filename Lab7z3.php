<?php
//-------------------------------- Част 1 -----------------------------
require_once("database.php");
//---------------------------------------------------------------------
//-------------------------------- Част 2 -----------------------------
$strSurname='Jones';
$queryCust="SELECT * FROM customers WHERE Surname='$strSurname'";
$dbCustRecords=mysqli_query($con,$queryCust);
if (!$dbCustRecords) {
    die('Неуспешно запитване. Получи следната грешка: '.mysqli_error($con));
}

if (mysqli_num_rows($dbCustRecords) == 0) {
    die('Няма клиенти с такова име.');
}
//---------------------------------------------------------------------
//-------------------------------- Част 3 -----------------------------
while ($CustRecords=mysqli_fetch_array($dbCustRecords)) {
    $intCustId=$CustRecords["Id"];
    echo "<p> Customers: ";
    echo $CustRecords["Title"]." ";
    echo $CustRecords["Surname"]." ";
    echo $CustRecords["Firstname"]."</p>";
    //-----------------------------------------------------------------
    //-------------------------------- Част 4 -------------------------
    $queryPur="SELECT * FROM purchases WHERE customers_Id='$intCustId'";
    $dbPurRecords=mysqli_query($con,$queryPur);
    if (!$dbPurRecords) {
        die('Неуспешно запитване. Получи следната грешка: '.mysqli_error($con));
    }

    if (mysqli_num_rows($dbPurRecords) == 0) {
        echo "<p>Не са направени покупки.</p>";
        continue;
    }
    //-----------------------------------------------------------------
    //--------------------------------- Част 5 ------------------------
    while ($PurRecords=mysqli_fetch_array($dbPurRecords)) {
        $intPurId=$PurRecords["Id"];
        echo "<p> Purchases On: ";
        echo $PurRecords["Day"]." ";
        echo $PurRecords["Month"]." ";
        echo $PurRecords["Year"]."</p>";
        //-------------------------------------------------------------
        //--------------------------------- Част 6 --------------------
        $queryPurPro="SELECT * FROM purchasesproducts WHERE purchases_Id='$intPurId'";
        $dbPurProRecords=mysqli_query($con,$queryPurPro);
        if (!$dbPurProRecords) {
            die('Неуспешно запитване. Получи следната грешка: '.mysqli_error($con));
        }

        if (mysqli_num_rows($dbPurProRecords) == 0) {
            echo "<p>Няма продукти в тази покупка.</p>";
            continue;
        }
        //-------------------------------------------------------------
        //---------------------------------- Част 7 -------------------
        while ($PurProRecords=mysqli_fetch_array($dbPurProRecords)) {
            $intProId=$PurProRecords["products_Id"];
            echo "<p>".$PurProRecords["Quantity"]." ";
            //---------------------------------------------------------
            //----------------------------- Част 8 ----------------------
            $queryPro="SELECT * FROM products WHERE Id='$intProId'";
            $dbProRecords=mysqli_query($con,$queryPro);
            if (!$dbProRecords) {
                die('Неуспешно запитване. Получи следната грешка: '.mysqli_error($con));
            }

            if (mysqli_num_rows($dbProRecords) == 0) {
                echo "<p>Продуктът не е намерен.</p>";
                continue;
            }
            //---------------------------------------------------------
            //----------------------------- Част 9 ----------------------
            $ProRecords=mysqli_fetch_array($dbProRecords);
            echo $ProRecords["Name"]." (".$ProRecords["Description"].") at &#163;";
            echo $ProRecords["Cost"]." each. </p>";
        }
    }
}
//---------------------------------------------------------------------
//---------------------------- Част 10 --------------------------------
mysqli_close($con);
//---------------------------------------------------------------------
?>