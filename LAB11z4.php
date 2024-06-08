<?php
require_once("database.php");


if (isset($_POST['submit'])) {
  
    if (isset($_POST['category']) && $_POST['category'] != "") {
        $category = $_POST['category'];

        
        if (isset($_POST['sort_order'])) {
            $sort_order = ($_POST['sort_order'] == 'ascending') ? 'ASC' : 'DESC';
        } else {
         
            $sort_order = 'ASC';
        }

    
        $queryProducts = "SELECT * FROM products WHERE category='$category' ORDER BY price $sort_order";
        $result = mysqli_query($con, $queryProducts);

        if (!$result) {
            die('Неуспешно запитване. Получи следната грешка' . mysqli_error($con));
        }

        echo "<h2>Стоки от вид '$category', сортирани ";
        echo ($_POST['sort_order'] == 'ascending') ? "във възходящ ред:</h2>" : "в низходящ ред:</h2>";
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>" . $row['product_name'] . " - Цена: " . $row['price'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "Моля, изберете вид на стоките.";
    }
}
?>


<form method="post" action="">
    <label for="category">Изберете вид на стоките:</label>
    <select name="category" id="category" required>
        <option value="clothing">Облекло</option>
        <option value="electronics">Електроника</option>
     
    </select>
    <br>
    <label for="sort_order">Изберете начин на сортиране:</label>
    <select name="sort_order" id="sort_order">
        <option value="ascending">Възходящ</option>
        <option value="descending">Низходящ</option>
    </select>
    <br>
    <input type="submit" name="submit" value="Покажи стоките">
</form>