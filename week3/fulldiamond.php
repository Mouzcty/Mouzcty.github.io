<!DOCTYPE html>
<html>
<body>

<?php  
echo "<pre>";
for ($i = 1; $i <=4; $i++) {
    for ($j = $i; $j <=4; $j++)
        echo "&nbsp;";
    for ($j = 2 * $i - 1; $j >= 1; $j--)
        echo ("*");
    echo "<br>";
}
for ($i = 3; $i >= 1; $i--) {
    for ($j = 5 - $i; $j >= 1; $j--)
        echo "&nbsp;";
    for ($j = 2 * $i - 1; $j >= 1; $j--)
        echo ("*");
    echo "<br>";
}
?>  

</body>
</html>