<?php
session_start();
if(isset($_SESSION["email"])){
    //echo "Favorite color is " . $_SESSION["email"] . ".<br>";
}else{
    //echo "favcolor havent set";
    header('Location: login.php');
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Create Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<?php 
    
    include 'config/database.php';

    if($_POST){
        $customer_id = $_POST['customer'];
        $query = "INSERT INTO orders SET customer_id=:customer_id, created=:created";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':customer_id', $customer_id);
        $created = date('Y-m-d H:i:s');
        $stmt->bindParam(':created', $created);
        $stmt->execute();
        $order_id = $con->lastInsertId();
        
        $quantity = $_POST['quantity'];
        $product_id =$_POST['product'];
        for($i = 0; $i <count($product_id); $i++){
            $query = "INSERT INTO order_details SET order_id=:order_id, product_id=:product_id, quantity=:quantity";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':order_id', $order_id);
            $stmt->bindParam(':product_id', $product_id[$i]);
            $stmt->bindParam(':quantity', $quantity[$i]);
            $stmt->execute();
        }
        header("Location: receipt.php?order_id=$order_id");
    }

    
    
?>
<body>
    <div class="container">
    <?php include 'header.php';?>
        <div class="page-header">
            <h1>Create Order</h1>
        </div>
    <form action="" method="post">
        <table class="table">
        <tr class="customer-row">
                <td>Customer</td>
                <td>
                    <div class="row">
                        <div class="col">
                        <?php   
                            $query = "SELECT id, firstname FROM customer ORDER BY id DESC";
                            $stmt = $con->prepare($query);
                            $stmt->execute();

                            // this is how to get number of rows returned
                            $customer_num = $stmt->rowCount();
                            if($customer_num > 0){
                                echo '<select name="customer">';
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                        extract($row);
                                        echo "<option value='$id'>$firstname</option>";
                                    }
                                    
                                echo '</select>';
                            }     
                        ?>
                        </div>
                        </div>
                    </td>
                </tr>
                        
            <tr class="product-row">
                <td>Product</td>
                <td>
                    <div class="row">
                        <div class="col">
                        <?php   
                            $query = "SELECT id, name FROM products ORDER BY id DESC";
                            $stmt = $con->prepare($query);
                            $stmt->execute();

                            // this is how to get number of rows returned
                            $product_num = $stmt->rowCount();
                            if($product_num > 0){
                                echo '<select name="product[]">';
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                        extract($row);
                                        echo "<option value='$id'>$name</option>";
                                    }
                                    
                                echo '</select>';
                            }     
                        ?>
                        </div>
                        <div class="col">
                            <select name="quantity[]">
                                <option value="">Quantity</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <div class="d-flex justify-content-center flex-column flex-lg-row">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="add_one btn btn-primary">Add More Product</button>
                            <button type="button" class="del_last btn btn-info">Delete Last Product</button>
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </form>
    </div>
    <?php include 'footer.php';?>

    <script>
        document.addEventListener('click', function(event) {
            if (event.target.matches('.add_one')) {
                var element = document.querySelector('.product-row');
                var clone = element.cloneNode(true);
                element.after(clone);
            }
            if (event.target.matches('.del_last')) {
                var total = document.querySelectorAll('.product-row').length;
                if (total > 1) {
                    var element = document.querySelector('.product-row');
                    element.remove(element);
                }
            }
        }, false);
    </script>
</body>

</html>