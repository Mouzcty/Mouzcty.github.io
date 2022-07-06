<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
function generateStars($sign1,$sign2) {
    echo "<pre>";
for ($i = 1; $i <=5; $i++) {
  for ($j = $i; $j <=7; $j++)
      echo "&nbsp;";
  for ($j = $i  ; $j >= 1; $j--)
        if($i % 2 == 0){
            echo $sign1;   
        }else{
            echo $sign2;
        }
    echo "<br>";
}
for ($i = 4; $i >=1; $i--) {
  for ($j = $i; $j <=7; $j++)
      echo "&nbsp;";
  for ($j = $i  ; $j >= 1; $j--)
        if($i % 2 == 0){
            echo $sign1;   
        }else{
            echo $sign2;
        }
    echo "<br>";
}
}

generateStars("*","-")
?>

</body>
</html>