<!DOCTYPE html>
<html>

<head>
</head>

<body>
<?php
function generateStars($noOfStar) {

  for ($x = 1; $x < $noOfStar; $x++) {
    for ($y = 0; $y < $x; $y++) {
      echo "*";
    }
    echo "<br>";
  }
  for ($x = $noOfStar; $x > 0; $x--) {
    for ($y = 0; $y < $x; $y++) {
      echo "*";
    }
    echo "<br>";
  }
}

generateStars(4);
generateStars(5);
generateStars(6);
generateStars(7);

?>

</body>

</html>