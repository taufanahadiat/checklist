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
            width: 150px;
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
    <h2>AIR RECEIVER TANK LINE</h2>
        <table>
            <thead>
            <tr>
            <th>PARAMETER</th>
            <th>Uom</th>
            <th>STANDARD</th>
            <th>TANK 1</th>
            <th>TANK 2</th>
            <th>TANK 3</th>
            <th>TANK 5</th>
            <th>TANK 6</th>
            <th>TANK 7</th>
            </tr>
            </thead>
            <form method="post">
            <tbody>
            <?php
                $models = array("tank1", "tank2", "tank3", "tank5", "tank6", "tank7");
                $parameters = array("Air Pressure", "Auto Drain", "Kondensat", "Kandungan Oli");
                $uom = array("Bar", "-", "-", "-");
                $standard = array("6.0 ~ 7.5", "B", "TA", "TA");
                $fields = array("air_pressure", "auto_drain", "kondensat", "kandungan_oli");

                foreach ($parameters as $index => $parameter) {
                    echo "<tr>";
                    echo "<th class='measure2'>" . htmlspecialchars($parameter) . "</th>";
                    echo "<th class='parameter'>" . htmlspecialchars($uom[$index]) . "</th>";
                    echo "<th class='parameter-setting'>" . htmlspecialchars($standard[$index]) . "</th>";
                
                    foreach ($models as $key => $model) {
                        // Skip condition                    
                        $fieldName = strtolower(str_replace(" ", "_", $model)) . "_" . $fields[$index];
                        $dataType = ($index === 0) ? "input" : "select";
                        $dataClass = ($index === 0) ? "type='number' step='0.01' class='input-field'" : "class='enum'";
                        // Enum options
                        $enum = "";
                        if ($index === 1) {
                            $enum = "<option value='B'>B</option><option value='R'>R</option>";
                        } elseif ($index === 2 || $index === 3) {
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