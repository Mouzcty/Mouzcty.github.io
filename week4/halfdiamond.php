<!DOCTYPE html>
<html>

<head>
</head>

<body>
<?php
function generateStars($noOfStar) {
  return $noOfStar;
}

$m = generateStars (4);

 
echo "<pre>";
for ($x = 1; $x < $m; $x++) {
  for ($y = 0; $y < $x; $y++) {
    echo "*";
  }
  echo "<br>";
}
for ($x = $m; $x > 0; $x--) {
  for ($y = 0; $y < $x; $y++) {
    echo "*";
  }
  echo "<br>";
}
?>

</body>

</html>