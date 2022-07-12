<!DOCTYPE html>
<html>
<body>

<?php  
function generateStars($onOfStar,$sign1) {
    
    $mm = $onOfStar - 3;
    
    echo "<pre>";
    for ($i = 1; $i <=$mm; $i++) {
        for ($j = $i; $j <=$mm; $j++)
            echo "&nbsp;";
        for ($j = 2 * $i - 1; $j >= 1; $j--)
            echo $sign1;
        echo "<br>";
    }
    for ($i = $mm -1; $i >= 1; $i--) {
        for ($j = 5 - $i; $j >= 1; $j--)
            echo "&nbsp;";
        for ($j = 2 * $i - 1; $j >= 1; $j--)
            echo $sign1;
        echo "<br>";
    }
  }

  generateStars ("7","*");
  generateStars ("7","*");


?>  

</body>
</html>