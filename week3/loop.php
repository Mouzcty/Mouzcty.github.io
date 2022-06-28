<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
    $selected_day = date('d');

    echo '<select id="day" name="day">'."\n";
    for ($i_day = 1; $i_day <= 31; $i_day++) { 
        $selected = ($selected_day == $i_day ? ' selected' : '');
        echo '<option value="'.$i_day.'"'.$selected.'>'.$i_day.'</option>'."\n";
    }
    echo '</select>'."\n";  

    $selected_month = date('m');

    echo '<select id="month" name="month">'."\n";
    for ($i_month = 1; $i_month <= 12; $i_month++) { 
        $selected = ($selected_month == $i_month ? ' selected' : '');
        echo '<option value="'.$i_month.'"'.$selected.'>'. date('F', mktime(0,0,0,$i_month)).'</option>'."\n";
    }
    echo '</select>'."\n";

    $year_start  = 1990;
    $year_end = date('Y');

    echo '<select id="year" name="year">'."\n";
    for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
        $selected = ($user_selected_year == $i_year ? ' selected' : '');
        echo '<option value="'.$i_year.'"'.$selected.'>'.$i_year.'</option>'."\n";
    }
    echo '</select>'."\n";
?>  
</body>
</html>