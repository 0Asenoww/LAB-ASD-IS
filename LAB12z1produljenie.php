<?php
$strUsername = 'David';
$strPassword = 'Regan';

$encryptedPassword = md5($strPassword);

$dblocalhost = mysqli_connect("localhost", "root", "", "users")
or die ("Could not connect: " . mysqli_connect_error());

$dbRecords = mysqli_query($dblocalhost, "SELECT * FROM users WHERE Username='$strUsername'");

$arrRecords = mysqli_fetch_array($dbRecords);

if (!$arrRecords || $encryptedPassword != $arrRecords["Password"]) {
    echo "<p>Invalid Password/Username</p>";
} else {
    echo "<p>Password and Username match!</p>";
}
?>