<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Формуляр за титли</title>
</head>
<body>
    <?php
    $displayTitle = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedTitle = $_POST["titleSelect"];
        $otherTitle = isset($_POST["otherTitle"]) ? trim($_POST["otherTitle"]) : "";

        if ($selectedTitle == "Other") {
            if (strlen($otherTitle) < 2) {
                echo "<script>alert('Титлата трябва да съдържа поне 2 символа.');</script>";
            } else {
                $displayTitle = $otherTitle;
            }
        } else {
            $displayTitle = $selectedTitle;
        }
    }
    ?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="titleSelect">Изберете титла:</label>
        <select id="titleSelect" name="titleSelect" onchange="toggleOtherTitleInput()">
            <option value="Mr">Mr</option>
            <option value="Miss">Miss</option>
            <option value="Mrs">Mrs</option>
            <option value="Dr">Dr</option>
            <option value="Other">Other</option>
        </select>
        <input type="text" id="otherTitle" name="otherTitle" placeholder="Въведете титла" style="display: none;" />
        <button type="submit">Изпрати</button>
    </form>

    <p id="displayTitle"><?php echo !empty($displayTitle) ? "Избраната титла е: " . $displayTitle : ""; ?></p>

    <script>
        function toggleOtherTitleInput() {
            const titleSelect = document.getElementById("titleSelect");
            const otherTitleInput = document.getElementById("otherTitle");
            if (titleSelect.value === "Other") {
                otherTitleInput.style.display = "inline";
            } else {
                otherTitleInput.style.display = "none";
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            toggleOtherTitleInput();
        });
    </script>
</body>
</html>