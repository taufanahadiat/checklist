<?php
// Sanitize the 'selectedUnit' parameter from the query string
$unit = htmlspecialchars($_GET['selectedUnit']); 
require 'database.php';
require 'request.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Checklist</title>
    <link rel="stylesheet" href="style.css">
    <script src="jquery-3.7.1.min.js"></script>
    <style>
        td {
            text-align: center;
            width: 100px;
        }
        .enum, .input-field {
            width: 100%;
            max-width: 65px;
            height: 25px;
            text-align: center;
            font-weight:700;
            cursor: pointer;
        }
        .input-field {
            cursor: text;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h2>AIR DRYER LINE</h2>
        <table>
            <thead>
            <tr>
            <th>PARAMETER</th>
            <th>Uom</th>
            <th>STANDARD</th>
            <th>SULLAIR 22</th>
            <th>BOGE 01</th>
            <th>BOGE 02</th>
            <th>AD. SULLAIR 23</th>
            <th>AD. SULLAIR 24</th>
            <th>AD. SULLAIR 27</th>
            <th>AD. SULLAIR 33</th>
            <th>AD. AUGUST 28</th>
            <th>AD. AUGUST 29</th>
            <th>AD. AUGUST 30</th>
            <th>AD. AUGUST 31</th>
            <th>AD. AUGUST 32</th>
            </tr>
            </thead>
            <form method="post">
            <tbody>
            <?php
                $models = array("sullair22", "boge01", "boge02", "adsullair23", "adsullair24", "adsullair27", "adsullair33", "adaugust28", "adaugust29", "adaugust30", "adaugust31", "adaugust32");
                $parameters = array("Dew Point Temp.", "Ref. Low Press", "Pre Filter", "After Filter", "Auto Drain Solenoid", "Vibration");
                $uom = array("°C", "Bar", "-", "-", "-", "-");
                $standard = array("2 ~ 10", "4 ~ 10", "HJ", "HJ", "B", "H ~ S");
                $fields = array("dewpoint_temp", "reflow_press", "pre_filter", "after_filter", "autodrain_solenoid", "vibration");

                foreach ($parameters as $index => $parameter) {
                    echo "<tr>";
                    echo "<th style='width: 40px' class='measure2'>" . htmlspecialchars($parameter) . "</th>";
                    echo "<th style='width:25px' class='parameter'>" . htmlspecialchars($uom[$index]) . "</th>";
                    echo "<th class='parameter-setting'>" . htmlspecialchars($standard[$index]) . "</th>";
                
                    foreach ($models as $key => $model) {
                        // Skip condition                    
                        $fieldName = strtolower(str_replace(" ", "_", $model)) . "_" . $fields[$index];
                        $dataType = ($index === 0 || $index === 1) ? "input" : "select";
                        $dataClass = ($index === 0 || $index === 1) ? "type='number' step='0.01' class='input-field'" : "class='enum'";
                        // Enum options
                        $enum = "";
                        if ($index === 2 || $index === 3) {
                            $enum = "<option value='HJ'>HJ</option><option value='M'>M</option>";
                        } elseif ($index === 4) {
                            $enum = "<option value='B'>B</option><option value='R'>R</option>";
                        } elseif ($index === 5) {
                            $enum = "<option value='H'>H</option><option value='S'>S</option><option value='T'>T</option>";
                        }
                        // Generate input row
                        $inputrow = "<$dataType $dataClass name='$fieldName'>$enum</$dataType>";
                        echo "<td>$inputrow</td>";
                    }
                    echo "</tr>";
                }
            ?>

            </tbody>
        </table>
        <br>
        <button type="submit" class="btn">SAVE</button>
    </form>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById("exit").onclick = function () {
            location.href = 'selection.php';
        };
        $(".enum").prop("selectedIndex", -1);
        $(".input-field").val('');

    });
</script>
</body>
</html>
