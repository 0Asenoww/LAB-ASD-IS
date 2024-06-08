<?php

function password_strength($password) {
    $strength = 0;

    if (strlen($password) >= 6) {
        $strength += 1;
    }

    if (preg_match('/[A-Z]/', $password)) {
        $strength += 1;
    }

    if (preg_match('/[a-z]/', $password)) {
        $strength += 1;
    }

    if (preg_match('/[0-9]/', $password)) {
        $strength += 1;
    }

    if (preg_match('/[!$%^&*@#+]/', $password)) {
        $strength += 1;
    }

    return $strength;
}

$password = "P@ssw0rd";
echo "Силата на паролата '$password' е: " . password_strength($password) . " точки.";
?>
