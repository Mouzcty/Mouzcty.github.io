<?php
function dropdown($sday = "", $smonth = "", $syear = "",$datetype = ""){

    if (empty($sday)) {
        $sday = date('d');
    }

    if (empty($smonth)) {
        $smonth = date('m');
    }

    if (empty($syear)) {
        $syear = date('Y');
    }

    //---v---select day---v---//
    $mday = $datetype."day";
    $mmonth = $datetype."month";
    $myear = $datetype."year";
    echo "<select name= $mday>";
    for ($day = 1; $day <= 31; $day++) {
        $s = ($day == $sday) ? 'selected' : '';
        echo "<option value = $day $s> $day </option>";
    }
    echo '</select>';

    //---v---select month---v---//
    echo "<select name=$mmonth>";
    for ($month = 1; $month <= 12; $month++) {
        $s = ($month == $smonth) ? 'selected' : '';
        echo "<option value = $month $s>". date('F', mktime(0, 0, 0, $month)) ."</option>";
    }
    echo '</select>';

    //---v---select year---v---//
    $nowyear = date('Y');
    echo "<select name=$myear>";
    for ($year = 1990; $year <= $nowyear; $year++) {
        $s = ($year == $syear) ? 'selected' : '';
        echo "<option value = $year $s> $year </option>";
    }
    echo '</select>';
    echo "<br>";
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Create Product - PHP CRUD Tutorial</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Create Product</h1>
        </div>
        <!-- PHP insert code will be here -->
        <?php
        if (!empty($_POST)) {

            // include database connection
            include 'config/database.php';
            try {
                // insert query
                $query = "INSERT INTO products SET name=:name, description=:description, price=:price, manufacturedate=:manufacturedate, expirydate=:expirydate, status=:status, created=:created";
                // prepare query for execution
                $stmt = $con->prepare($query);
                // posted values
                $name = htmlspecialchars(strip_tags($_POST['name']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
                $price = htmlspecialchars(strip_tags($_POST['price']));
                $manufacturedate = htmlspecialchars(strip_tags($_POST['manufacturedate']));
                $expirydate = htmlspecialchars(strip_tags($_POST['expirydate']));
                $status = htmlspecialchars(strip_tags($_POST['status']));
                // bind the parameters
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':manufacturedate', $manufacturedate);
                $stmt->bindParam(':expirydate', $expirydate);
                $stmt->bindParam(':status', $status);
                // specify when this record was inserted to the database
                $created = date('Y-m-d H:i:s');
                $stmt->bindParam(':created', $created);
                // Execute the query
                if (!empty($stmt->execute())) {
                    echo "<div class='alert alert-success'>Record was saved.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Unable to save record.</div>";
                }
            }
            // show error
            catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>


        <!-- html form here where the product information will be entered -->
        <form name="productform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()" method="post" required>
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='name' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name='description' class='form-control'></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type='text' name='price' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Manufacture date </td>
                    <td>
                        <?php
                            dropdown($sday = "", $smonth = "", $syear = "",$datetype = "");
                        ?>
                    </td>
                    <input type="hidden" id="custId" name="custId" value="3487">

                </tr>
                <tr>
                    <td>Expiry date</td>
                    <td>
                        <?php
                            dropdown($sday = "", $smonth = "", $syear = "",$datetype = "");
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <input type="radio" name="status" value="available"><label for="html">Available</label>&nbsp;
                        <input type="radio" name="status" value="not_available"><label for="html">Not Available</label>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-primary' />
                        <a href='index.php' class='btn btn-danger'>Back to read products</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>
    <!-- end .container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        function validateForm() {
            var x = document.forms["productform"]["name", "price", "manufacturedate", "expirydate", "status"].value;
            if (x == "" || x == null) {
                alert("Empty must be filled out");
                return false;
            }
        }
    </script>

</body>

</html>