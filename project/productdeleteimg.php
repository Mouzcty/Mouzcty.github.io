<?php

if(isset($_GET)){
    $img ="";
    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
    include 'config/database.php';
    try {
        // prepare select query
        $query = "SELECT image FROM products WHERE id = ? ";
        $stmt = $con->prepare($query);

        // this is the first question mark
        $stmt->bindParam(1, $id);

        // execute our query
        $stmt->execute();

        // store retrieved row to a variable
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // values to fill up our form
        
        $image = $row['image'];

        $query = "UPDATE products SET image=:image WHERE id = :id";

        $stmt = $con->prepare($query);
        $stmt->bindParam(':image', $img);
        $stmt->bindParam(':id', $id);
     
        $stmt->execute();

        unlink("../uploads/".$image);
        header("Location: product_update.php?id=".$id."&action=deleteimg");
        
    }// show error
    catch (PDOException $exception) {
        die('ERROR: ' . $exception->getMessage());
    }
}

?>