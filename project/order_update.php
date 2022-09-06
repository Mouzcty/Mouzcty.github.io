<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Read One Record - PHP CRUD Tutorial</title>
    <!-- Latest compiled and minified Bootstrap CSS →
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
 
    <!-- container -->
    <div class="container">
    <?php include 'header.php';?>
        <div class="page-header">
            <h1>Update Order</h1>
        </div>

        <!-- PHP read one record will be here -->
        <?php
    //get order_id from url
    $orderid = isset($_GET['orderID']) ? $_GET['orderID'] : die('ERROR: Record ID not found.');
    
    
        include 'config/database.php';
        try{
            //customer order detail
            $query ="SELECT orders.id, orders.created, customer.firstname, customer.lastname FROM orders
            INNER JOIN customer ON orders.customer_id = customer.id WHERE orders.id =$orderid "; 
            
            $stmt = $con->prepare($query);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $created = $row['created'];

        }// show error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }

    


    ?>
    <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td><b>Order ID</b></td>
                <td><?php echo htmlspecialchars($id, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td><b>Customer Name</b></td>
                <td><?php echo htmlspecialchars($firstname.$lastname, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td><b>Order Date</b></td>
                <td><?php echo htmlspecialchars($created, ENT_QUOTES);  ?></td>
            </tr>
        </table>


            <?php
            include 'config/database.php';
            //order product detail
            $query = "SELECT * FROM order_details INNER JOIN products ON order_details.product_id = products.id WHERE order_details.order_id =$orderid";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':order_details_id', $order_details_id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $order_details_id = $row['order_details_id'];
            echo $order_details_id;
            $TotalAmount = 0;
            $num = $stmt->rowCount();
            if ($num > 0) {
                echo "<table class='table table-hover table-responsive table-bordered'>";

                echo "<tr>";
                echo "<th>Product Name</th>";
                echo "<th>Single Price</th>";
                echo "<th>Quantity</th>";
                echo "<th>Total Price</th>";
                echo "</tr>";
                

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // extract row
                    extract($row);

                    $totalPrice = $price*$Quantity;
                    $TotalAmount = $TotalAmount + $totalPrice;
                    
                    // creating new table row per record
                    echo "<tr>";
                    echo "<td>{$name}</td>";
                    echo "<td>RM&nbsp{$price}</td>";
                    echo "<td>{$Quantity}</td>";
                    echo "<td>RM&nbsp$totalPrice</td>";
                }
            }
            ?>

            <?php
             if($_POST){

                $query = "DELETE FROM order_details WHERE order_id = $orderid";
                $stmt = $con->prepare($query);
                $stmt->execute();

                //$customer_id = $_POST['customer'];
                // $query = "UPDATE orders SET customer_id=:customer_id, created=:created";
                // $stmt = $con->prepare($query);
                // $stmt->bindParam(':customer_id', $customer_id);
                // $created = date('Y-m-d H:i:s');
                // $stmt->bindParam(':created', $created);
                // $stmt->execute();
                //$order_id = $con->lastInsertId();
                
                $quantity = $_POST['quantity'];
                $product_id =$_POST['product'];
                for($i = 0; $i <count($product_id); $i++){
                    $query = "INSERT INTO order_details SET product_id=:product_id, quantity=:quantity";
                    $stmt = $con->prepare($query);
                    $stmt->bindParam(':product_id', $product_id[$i]);
                    $stmt->bindParam(':quantity', $quantity[$i]);
                    $stmt->execute();
                }
                header("Location: order_read.php");
                
            }
            ?>

            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td><b>Total Amount</b></td>
                    <td><?php echo"RM&nbsp $TotalAmount"?></td>
                </tr>
            </table>
            

 
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
            <table class='table'>

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
                                echo '<select name="product_id[]">';
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
    </div> <!-- end .container -->
    

    
    
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