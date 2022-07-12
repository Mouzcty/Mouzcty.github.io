<!DOCTYPE html>
<html>

<head>
</head>

<body>

    <?php
    function dropdown($sday = "", $smonth = "", $syear = ""){

        if (empty($sday)) {
            $sday = date('d');
        }

        if (empty($smonth)) {
            $smonth = date('F');
        }

        if (empty($syear)) {
            $syear = date('Y');
        }

        //---v---select day---v---//
        echo '<select id="day">';
        echo "<option> $sday </option>";
        for ($day = 1; $day <= 31; $day++) {
            echo "<option> $day </option>";
        }
        echo '</select>';

        //---v---select month---v---//
        echo '<select id="month">';
        echo "<option> $smonth </option>";
        for ($month = 1; $month <= 12; $month++) {
            echo "<option>" . date('F', mktime(0, 0, 0, $month)) . "</option>";
        }
        echo '</select>';

        //---v---select year---v---//
        $nowyear = date('Y');
        echo '<select id="year">';
        echo "<option> $syear </option>";
        for ($year = 1990; $year <= $nowyear; $year++) {
            echo "<option> $year </option>";
        }
        echo '</select>';
        echo "<br>";
    }

    dropdown(12, 'May', 2001);
    dropdown();


    ?>
</body>

</html>