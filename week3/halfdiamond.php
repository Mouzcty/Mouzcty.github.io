<!DOCTYPE html>
<html>

<head>
</head>

<body>
<?php
    echo "<pre>";
    for ($x = 1; $x < 6; $x++) {
        for ($y = 0; $y < $x; $y++) {
            echo "*";
        }
        echo "<br>";
    }
    for ($x = 6; $x > 0; $x--) {
        for ($y = 0; $y < $x; $y++) {
            echo "*";
        }
        echo "<br>";
    }
?>

</body>

</html>