<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
$sltday = date('d');
$sltmonth = date('F');
$sltyear = date('Y');
$date_st=date_create("0-1-0");
$date_ed=date_create("0-12-0");
//---v---select day---v---//
echo '<select id="day">';
echo "<option> $sltday </option>";
for($day = 1; $day <=31; $day++){
    echo "<option> $day </option>"; 
}
echo '</select>';

//---v---select month---v---//
echo '<select id="month">';
echo "<option> $sltmonth </option>";
for($month = 1; $month <=12; $month++){
    echo "<option>". date('F', mktime(0,0,0,$month))."</option>" ;//是不是有function在里面就必须要分开写？what is mktime？
}
echo '</select>';

//---v---select year---v---//
echo '<select id="year">';
echo "<option> $sltyear </option>";
for($year = 1990; $year <= $sltyear; $year++){
    echo "<option> $year </option>"; 
}
echo '</select>';
?>";
?>  
</body>
</html>