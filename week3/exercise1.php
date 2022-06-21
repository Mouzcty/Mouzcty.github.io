<!DOCTYPE html>
<html>

<head>
    <link href="styles.css" rel="stylesheet" />
</head>
<body>
    <div class="clock1">
        <div class="day">
            <?php
                echo date("d");
            ?>
        </div>
        <div class="udline"></div>
        <div class="month">
            <?php
                echo date("M") . " ". date("Y");
            ?>
        </div>
    </div>

    <div class="clock2">
        <div class="day">
            <?php
                echo date("d");
            ?>
        </div>
        <div class="month">
            <?php
                echo date("M") . " ". date("Y");
            ?>
        </div>
    </div>

    <div class="clock3">
        <div class="clockbox">
            <div class="day">
                <?php
                    echo date("d");
                ?>
            </div>
            <div class="month">
                <?php
                    echo date("F"). "<br>";
                    echo date("Y");
                ?>
            </div>
        </div>
    </div>

</body>