<?php
require_once("database.php");

if (isset($_POST['submit'])) {    
    if (isset($_POST['price']) && $_POST['price'] != "") {
        $price = $_POST['price'];


        if ($_POST['compare'] == 'above') {
            $comparison = ">";
        } else {
            $comparison = "<";
        }
        $queryProducts = "SELECT * FROM products WHERE price $comparison $price";
        $result = mysqli_query($con, $queryProducts);

        if (!$result) {
            die('Неуспешно запитване. Получи следната грешка' . mysqli_error($con));
        }

        echo "<h2>Стоки с цена " . ($_POST['compare'] == 'above' ? "над" : "под") . " $price:</h2>";
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>" . $row['product_name'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "Моля, посочете цена.";
    }
}
?>

<form method="post" action="">
    <label for="price">Цена:</label>
    <input type="number" id="price" name="price" min="0" required>
    <select name="compare">
        <option value="above">Над</option>
        <option value="below">Под</option>
    </select>
    <input type="submit" name="submit" value="Генерирай">
</form>