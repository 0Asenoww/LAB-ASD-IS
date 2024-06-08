<?php
require_once("database.php");

if (isset($_POST['submit'])) {
    if (isset($_POST['quantity']) && $_POST['quantity'] != "") {
        $quantity = $_POST['quantity'];

      
        $queryProducts = "SELECT * FROM products WHERE stock_quantity < $quantity";
        $result = mysqli_query($con, $queryProducts);

        if (!$result) {
            die('Неуспешно запитване. Получи следната грешка' . mysqli_error($con));
        }

     
        echo "<h2>Стоки с наличност под $quantity бройки:</h2>";
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>" . $row['product_name'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "Моля, посочете брой.";
    }
}
?>

<!-- Форма за въвеждане на брой -->
<form method="post" action="">
    <label for="quantity">Брой стоки:</label>
    <input type="number" id="quantity" name="quantity" min="1" required>
    <input type="submit" name="submit" value="Генерирай">
</form>