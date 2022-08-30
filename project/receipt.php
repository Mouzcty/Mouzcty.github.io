<!DOCTYPE HTML>
<html>

<head>
    <title>Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container">
    <h1>Receipt</h1>  
    <?php
    //get order_id from url
    $orderid = $_GET['order_id'];
    
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
            $stmt->execute();
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
                    // this will make $row['firstname'] to just $firstname only
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

            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td><b>Total Amount</b></td>
                    <td><?php echo"RM&nbsp $TotalAmount"?></td>
                </tr>
            </table>
    
    
    </div>

</body>

</html>