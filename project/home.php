<!DOCTYPE html>
<html>
<body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<?php
session_start();
if(isset($_SESSION["email"])){
    //echo "Favorite color is " . $_SESSION["email"] . ".<br>";
}else{
    //echo "favcolor havent set";
    header('Location: index.php');
}
?>

<div class="container">
<?php include 'header.php';?>
<h1>Welcome to my home page!</h1>
<?php include 'footer.php';?>
</div>


</body>
</html>