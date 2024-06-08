<!-- add_delivery.php -->
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<title>Нова доставка</title>
<script type="text/javascript">
function validateForm() {
    var productName = document.getElementById("ProductName").value;
    var quantity = document.getElementById("Quantity").value;
    var supplier = document.getElementById("Supplier").value;
    var deliveryDate = document.getElementById("DeliveryDate").value;

    if (!productName  !quantity  !supplier  !deliveryDate) {
        alert("Моля, попълнете всички полета.");
        return false;
    }
    return true;
}
</script>
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['username'])  $_SESSION['role'] != 'admin') {
    die("Нямате необходимите права за достъп до тази страница.");
}
?>
<div style="width:1000px">
    <div style="text-align:center">
        <h1>Въведи информация за новата доставка</h1><br>
    </div>
    <form method="post" action="process_delivery.php" onsubmit="return validateForm()"> 
        <div style="height:100px;width:140px;float:left;">
        </div>
        <div style="height:100px; width:380px; float:left;">
            <table style="text-align:left;font-weight:bold">
                <tr>
                    <td><label for="ProductName"> Име на продукта: </label></td>
                    <td><input type="text" name="ProductName" id="ProductName"></td>
                </tr>
                <tr>
                    <td><label for="Quantity"> Количество: </label></td>
                    <td><input type="text" name="Quantity" id="Quantity"></td>
                </tr>
            </table>
        </div>
        <div style="height:100px; width:380px; float:left;">
            <table style="text-align:left;font-weight:bold">
                <tr>
                    <td><label for="Supplier"> Доставчик: </label></td>
                    <td><input type="text" name="Supplier" id="Supplier"></td>
                </tr>
                <tr>
<td><label for="DeliveryDate"> Дата на доставка: </label></td>
                    <td><input type="date" name="DeliveryDate" id="DeliveryDate"></td>
                </tr>
            </table>
        </div>
        <div style="height:30px"></div>
        <div style="text-align:center">
            <span> <input type="submit" name="submit" value="Запис"> </span>
        </div>
    </form>
</div>
</body>
</html>
<?php
// process_delivery.php
session_start();
if (!isset($_SESSION['username'])  $_SESSION['role'] != 'admin') {
    die("Нямате необходимите права за добавяне на доставки.");
}

$con = mysqli_connect('localhost', 'root', '', 'ShoppingCenter');
if (!$con) {
    die('Неуспешно свързване. Получи се следната грешка: ' . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['ProductName'];
    $quantity = $_POST['Quantity'];
    $supplier = $_POST['Supplier'];
    $deliveryDate = $_POST['DeliveryDate'];

    // Check if all fields are filled
    if (empty($productName)  empty($quantity)  empty($supplier)  empty($deliveryDate)) {
        die('Моля, попълнете всички полета.');
    }

    $query = "INSERT INTO Delivery (ProductName, Quantity, Supplier, DeliveryDate) VALUES ('$productName', '$quantity', '$supplier', '$deliveryDate')";
    $dbreg = mysqli_query($con, $query);

    if (!$dbreg) {
        die('Получи се следната грешка: ' . mysqli_error($con));
    } else {
        echo "Вие успешно добавихте информацията за новата доставка";
    }

    mysqli_close($con);
}
?>