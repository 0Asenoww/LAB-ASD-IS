<!DOCTYPE html>
<html>
<head>
    <title>Избор на клиент</title>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "firma";
$port = "3308";

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$queryCust = "SELECT Id, Surname, Firstname FROM customers";
$dbCustRecords = mysqli_query($conn, $queryCust);
if (!$dbCustRecords) {
    die('Неуспешно запитване. Получи следната грешка: ' . mysqli_error($conn));
}
?>

<h2>Изберете клиент</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <select name="customerId">
        <?php
       
        while ($row = mysqli_fetch_assoc($dbCustRecords)) {
            echo "<option value='" . $row['Id'] . "'>" . $row['Firstname'] . " " . $row['Surname'] . "</option>";
        }
        ?>
    </select>
    <input type="submit" name="submit" value="OK">
</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['customerId'])) {
    $customerId = $_POST['customerId'];

    $queryPur = "SELECT * FROM purchases WHERE customers_Id='$customerId'";
    $dbPurRecords = mysqli_query($conn, $queryPur);
    if (!$dbPurRecords) {
        die('Неуспешно запитване. Получи следната грешка: ' . mysqli_error($conn));
    }

    if (mysqli_num_rows($dbPurRecords) == 0) {
        echo "<p>Не са направени покупки за този клиент.</p>";
    } else {
        echo "<h3>Поръчки за избрания клиент:</h3>";
        while ($PurRecords = mysqli_fetch_assoc($dbPurRecords)) {
            echo "<p>Поръчка на: " . $PurRecords['Day'] . " " . $PurRecords['Month'] . " " . $PurRecords['Year'] . "</p>";

           
            $intPurId = $PurRecords['Id'];
            $queryPurPro = "SELECT * FROM purchasesproducts WHERE purchases_Id='$intPurId'";
            $dbPurProRecords = mysqli_query($conn, $queryPurPro);
            if (!$dbPurProRecords) {
                die('Неуспешно запитване. Получи следната грешка: ' . mysqli_error($conn));
            }

            if (mysqli_num_rows($dbPurProRecords) == 0) {
                echo "<p>Няма продукти в тази поръчка.</p>";
            } else {
                while ($PurProRecords = mysqli_fetch_assoc($dbPurProRecords)) {
                    $intProId = $PurProRecords['products_Id'];
                    $queryPro = "SELECT * FROM products WHERE Id='$intProId'";
                    $dbProRecords = mysqli_query($conn, $queryPro);
                    if (!$dbProRecords) {
                        die('Неуспешно запитване. Получи следната грешка: ' . mysqli_error($conn));
                    }

                    if (mysqli_num_rows($dbProRecords) == 0) {
                        echo "<p>Продуктът не е намерен.</p>";
                    } else {
                        $ProRecords = mysqli_fetch_assoc($dbProRecords);
                        echo "<p>" . $PurProRecords['Quantity'] . " " . $ProRecords['Name'] . " (" . $ProRecords['Description'] . ") на &#163;" . $ProRecords['Cost'] . " всеки.</p>";
                    }
                }
            }
        }
    }
}

mysqli_close($conn);
?>

</body>
</html>