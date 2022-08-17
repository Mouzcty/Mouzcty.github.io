<?php
if(isset($_POST['deletebtn'])){
    $delimg = $_POST['delimg'];

    $query = "DELETE FROM product WHERE id='$id'";
    $query_run = mysqli_query($con,$query);

    if($query_run){
        unlink("uploads/".$delimg);
        header("Location: product_update.php");
    }
}


// if(!unlink($path)){
//     echo "You have an error";
// }else{
//     header("Location:product_update.php");
// }
// ?>