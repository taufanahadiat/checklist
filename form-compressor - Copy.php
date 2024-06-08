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
    <h2>COMPRESSOR LINE</h2>
        <table>
            <thead>
            <tr>
            <th>PARAMETER</th>
            <th>Uom</th>
            <th>STANDARD</th>
            <th>COMP. KAESER 19</th>
            <th>COMP.  BOGE 01 (26)</th>
            <th>COMP.  BOGE 02 (27)</th>
            <th>COMP. KAESER 22</th>
            <th>COMP. SULLAIR 18</th>
            <th>COMP. SULLAIR 20</th>
            <th>COMP. SULLAIR 21</th>
            <th>COMP. SULLAIR 23</th>
            <th>COMP. SULLAIR 24</th>
            <th>COMP. SULLAIR 25</th>
            <th>COMP. AUGUST 28</th>
            <th>COMP. AUGUST 29</th>
            <th>COMP. AUGUST 30</th>
            <th>AD. SULLAIR 34</th>
            </tr>
            </thead>
            <form method="post">
            <tbody>
            <?php
                $models = array("compkaeser19", "compboge01", "boge02", "kaeser22", "compsullair18", "compsullair20", "compsullair21", "compsullair23", "compsullair24", "compsullair25", "compaugust28", "compaugust29", "compaugust30", "adsullair34");
                $parameters = array("Air Dischrg. Press", "Air Dishrg. Temp", "Separator Δ Press.", "Oil Level (%Botm SG)", "Vibration", "Noise", "Running Hours", "Load Hours", "Δ Voltage", "Current", "Alarm");
                $uom = array("Bar", "°C", "Bar", "-", "-", "-", "H", "H", "%", "A", "-");
                $standard = array("6.4 ~ 8.0", "80 ~ 110", "0 ~ 0.8", "1/2 ~ 3/4", "H", "H", "-", "-", "5 ~ 15", "80 ~ 150", "TA");
                $fields = array("disc_press", "disc_temp", "separator_press", "oil_level", "vibration", "noise", "run_hours", "load_hours", "voltage", "current", "alarm");

                foreach ($parameters as $index => $parameter) {
                    echo "<tr>";
                    echo "<th style='width: 40px' class='measure2'>" . htmlspecialchars($parameter) . "</th>";
                    echo "<th style='width:25px' class='parameter'>" . htmlspecialchars($uom[$index]) . "</th>";
                    echo "<th class='parameter-setting'>" . htmlspecialchars($standard[$index]) . "</th>";
                
                    foreach ($models as $key => $model) {
                        // Skip condition
                        if ((($key === 0 || $key === 1 || $key === 2 || $key === 3 || $key === 13) && ($index === 8 || $index === 9)) || 
                            (($key !== 4 && $key !== 8 && $key !== 9) && ($index === 10)) || (($key === 13) && ($index === 6 || $index === 7))){
                            echo "<td></td>";
                            continue;
                        }
                    
                        $fieldName = strtolower(str_replace(" ", "_", $model)) . "_" . $fields[$index];
                        $dataType = ($index === 4 || $index === 5 || $index === 10) ? "select" : "input";
                        $dataClass = ($index === 4 || $index === 5 || $index === 10) ? "class='enum'" : "type='number' step='0.01' class='input-field'";
                        // Enum options
                        $enum = "";
                        if ($index === 4 || $index === 5) {
                            $enum = "<option value='H'>H</option><option value='S'>S</option><option value='T'>T</option>";
                        } elseif ($index === 10) {
                            $enum = "<option value='A'>A</option><option value='TA'>TA</option>";
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
