<style>
    .alineright{
        text-align:right; 
         float: right;
         width:50%;
         display:block;
    }
</style>
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
            <h1>Read Order’s DETAILS</h1>
        </div>

        <!-- PHP read one record will be here -->
        <?php
    //get order_id from url
    $orderid = $_GET['orderID'];
    
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
                    extract($row);

                    $totalPrice = number_format($price*$Quantity,2);
                    $TotalAmount = number_format($TotalAmount + $totalPrice,2);
                    $priceformat = number_format($price,2)."<br>";
                    // creating new table row per record
                    echo "<tr>";
                    echo "<td>{$name}</td>";
                    echo "<td><div class='alineright'>RM&nbsp{$priceformat}</div></td>";
                    echo "<td>{$Quantity}</td>";
                    echo "<td><div class='alineright'>RM&nbsp$totalPrice</div></td>";
                }
            }
            ?>

            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td><b>Total Amount</b></td>
                    <td>
                    <div class="alineright">
                        <span>
                        <?php echo"RM&nbsp $TotalAmount"?>
                        </span>
                    </div>
                    </td>
                    
                </tr>
            </table>

    </div> <!-- end .container -->

    </body>

</html>