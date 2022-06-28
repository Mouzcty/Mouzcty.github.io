<!DOCTYPE html>
<html>

<head>
<link href="styles.css" rel="stylesheet" />
</head>

<body>
<?php
    for ($x = 0; $x <= 100; $x++){
        
        if ($x % 2 == 0){
            echo "<b>$x</b>";
        }else {
            echo $x;
        }
        echo "<br/>";
    }
?>
</body>
</html>