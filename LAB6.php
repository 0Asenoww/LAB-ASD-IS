<?php
$conn=mysqli_connect('localhost', 'root', '', 'firma', '3308') or die(mysqli_connect_error());
echo "Connection to the server was succesfull! <br/>";
mysqli_select_db($conn, "firma") or die(mysqli_error($conn));
echo "Database was selected! <br/>";
$sql = "SELECT * FROM Products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
    <tr>
    <th>NameOfProduct</th>
    <th>Description</th>
    <th>Price</th>
    </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['NameOfProduct'] . "</td>";
        echo "<td>" . $row['Description'] . "</td>";
        echo "<td>" . $row['Price'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
echo"";

 echo "Products with price greater then 5.00 leva";
 echo"";
$sql = "SELECT * FROM Products WHERE Price > 5.00";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
    <tr>
    <th>NameOfProduct</th>
    <th>Description</th>
    <th>Price</th>
    </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['NameOfProduct'] . "</td>";
        echo "<td>" . $row['Description'] . "</td>";
        echo "<td>" . $row['Price'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$sql = "SELECT * FROM Products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product choice</title>
</head>
<body>


<h2>Choose product</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <select name="product">
        <?php
      
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['NameOfProduct'] . "'>" . $row['NameOfProduct'] . "</option>";
        }
        ?>
    </select>
    <input type="submit" name="submit" value="OK">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (isset($_POST['product'])) {
       
        $selected_product = $_POST['product'];
        $sql = "SELECT * FROM Products WHERE NameOfProduct = '$selected_product'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {      
            $row = $result->fetch_assoc();
            echo "<h3>NameOfProduct: " . $row['NameOfProduct'] . "</h3>";
            echo "<p>Description: " . $row['Description'] . "</p>";
            echo "<p>Price: " . $row['Price'] . "</p>";
        } else {
            echo "error";
        }
    } else {
        echo "Choose a product from the list.";
    }
}


$conn->close();
?>

</body>
</html>