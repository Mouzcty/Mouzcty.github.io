<!DOCTYPE html>
<html>

<head>

</head>

<body>
<?php
        $m = 99;
        var_dump ($m);

        if ($m >= 80 && $m <= 100){
            echo "Distinction";
            if ($m == 100){
                echo "welldone";
            }
        } elseif ($m >=60 && $m <= 79){
            echo "Good";
        } elseif ($m >=40 && $m <= 59){
            echo "Pass";
        } elseif ($m >=0 && $m <= 39){
            echo "Fail";
        } else {echo "wrong input";
        }
    ?>


</body>
</html>