<?php
$unit = htmlspecialchars($_GET['selectedUnit']); // Sanitize the 'unit' parameter from the query string
require 'database.php';
require 'request.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Checklist</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <script src="jquery-3.7.1.min.js"></script>
    <style>
        td{
            text-align: center;
        }
        .enum , .input-field{
            width: 100%;
            max-width: 65px;
            height: 25px;
            text-align: center;
            font-weight:700;
            cursor: pointer;
        }
        .input-field{
            cursor: text;
        }
        .clear-btn {
            float: right;
            background: none;
            border: none;
            color: red;
            font-size: 16px;
            cursor: pointer;
        }
        .clear-btn:hover {
            border: 1px solid red;
            border-radius: 4px;
        }
    </style>
</head>

<body>
<?php include 'header.php'; ?>    
<main>
    
<?php

$unit_headings = array(
    "genset_wartsila_01" => "Genset Wartsila 01",
    "genset_wartsila_02" => "Genset Wartsila 02"
);

if (array_key_exists($unit, $unit_headings)):
    ?>
    <h2><?php echo $unit_headings[$unit]; ?></h2>
<?php else: ?>
    <h2>Unknown Unit</h2>
<?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th colspan="3">Time</th>
                    <th>08.00</th>
                    <th>10.00</th>
                    <th>12.00</th>
                    <th>14.00</th>
                    <th>16.00</th>
                    <th>18.00</th>
                    <th>20.00</th>
                    <th>22.00</th>
                    <th>0.00</th>
                    <th>2.00</th>
                    <th>4.00</th>
                    <th>6.00</th>
                </tr>
            </thead>
            <tbody>
            <form method="post">
        <?php
            require 'database.php';
            $sql_select = "SELECT * FROM $unit WHERE tanggal = CURDATE()";
            $result_select = mysqli_query($conn, $sql_select);
            if (!$result_select) {
                die("Query failed: " . mysqli_error($conn));
            }                
            $existing_record = mysqli_fetch_assoc($result_select);

            // Function to format the value
            function formatValue($value) {
                // Check if the value is a float and has .00 as decimals
                if (is_numeric($value) && floor($value) == $value) {
                    return intval($value); // Return integer value
                } else {
                    return $value; // Otherwise, return the original value
                }
            }

            // Example usage:
            $value = 10.00;
            //echo formatValue($value); // Output: 10

            $value = 10.50;
            //echo formatValue($value); // Output: 10.5

                $parameters = array(
                    array("Running Hours", "-", "Hour", "running_hrs"),
                    array("Lube Oil Sump Level", "14~17", "Cm", "lube_oil_sump_lvl"),
                    array("Air Condensation Heater", "-", "On", "anti_cond_heater"),
                    array("Pre lube Pump", "-", "On", "prelube_pump", true),
                    array("Pre lube Pump Press", ">0.5", "Bar", "prelube_pump_press"),
                    array("Kebocoran Oil", "A/TA/RS", "-", "kebocoran_oil", true),
                    array("Preheating Unit", "-", "On", "preheat_unit", true),
                    array("HT Water Outlet Temp", ">50", "°C", "ht_water_outlet_temp"),
                    array("HT Expantion Tank lvl", "50~95", "Cm", "ht_expantion_tank_lvl"),
                    array("LT Expantion Tank lvl", "50~95", "Cm", "lt_expantion_tank_lvl"),
                    array("Warming Up", "2~3", "Week", "warming_up"),
                    array("Fuel Oil Inlet Temp", "-", "°C", "fuel_oil_inlet_temp"),
                    array("Fuel Oil Inlet Pressure", "4.0~7.0", "Bar", "fuel_oil_inlet_pressure"),
                    array("Kebocoran Fuel", "A/TA/RS", "-", "kebocoran_fuel", true)
                );

                foreach ($parameters as $parameter) {
                    $name = $parameter[0];
                    $param = $parameter[1];
                    $setting = $parameter[2];
                    $field_name = $parameter[3];
                    $is_select = isset($parameter[4]) ? $parameter[4] : false;
                    $times = array("8_14", "16_22", "0_6"); // Times for the fields
                    echo "<tr>";
                    echo "<th class='measure'>$name</th>";
                    echo "<th class='parameter'>$param</th>";
                    echo "<th class='parameter-setting'>$setting</th>";
                    
                    if ($is_select) {
                        for ($i = 8; $i <= 22; $i += 2) {
                            $field_key = "{$field_name}_$i";
                            $field_data = isset($existing_record[$field_key]) ? htmlspecialchars($existing_record[$field_key]) : '';                
                            if ($field_data !== '') {
                                echo '<td>' . htmlspecialchars(formatValue($field_data));
                                echo "<button type='button' class='clear-btn' data-field='{$field_name}_$i'>X</button>";
                                echo    '</td>';
                                } else {                            
                            echo "<td><select class='enum' name='{$field_name}_$i'>";
                            include $field_name === "kebocoran_oil" || $field_name === "kebocoran_fuel" ? 'enum-kebocoran.php' : 'enum-on-off.php';
                            echo "</select></td>";
                                }
                        }
                        for ($i = 0; $i <= 6; $i += 2) {
                            $field_key = "{$field_name}_$i";
                            $field_data = isset($existing_record[$field_key]) ? htmlspecialchars($existing_record[$field_key]) : '';                
                            if ($field_data !== '') {
                                echo '<td>' . htmlspecialchars(formatValue($field_data));
                                echo "<button type='button' class='clear-btn' data-field='{$field_name}_$i'>X</button>";
                                echo    '</td>';
                                } else {                            
                            echo "<td><select class='enum' name='{$field_name}_$i'>";
                            include $field_name === "kebocoran_oil" || $field_name === "kebocoran_fuel" ? 'enum-kebocoran.php' : 'enum-on-off.php';
                            echo "</select></td>";
                                }
                        }
                    } else {
                        // Add colspan for specific fields
                        if (in_array($name, array("Running Hours", "Lube Oil Sump Level", "HT Expantion Tank lvl", "LT Expantion Tank lvl"))) {
                            foreach ($times as $time) {
                                $field_data = "{$field_name}_$time";
                                if ($existing_record && isset($existing_record[$field_data])) {
                                    echo '<td colspan="4">' . htmlspecialchars(formatValue($existing_record[$field_data]));
                                    echo "<button type='button' class='clear-btn' data-field='$field_data'>X</button>";
                                    echo    '</td>';
                                    } else {        
                                echo "<td colspan='4'><input type='number' step='0.01' class='input-field' name='{$field_name}_{$time}'></td>";
                                    }
                            }
                        } else if ($name === "Air Condensation Heater") {
                            foreach ($times as $time) {
                                $field_data = "{$field_name}_$time";
                                if ($existing_record && isset($existing_record[$field_data])) {
                                    echo '<td colspan="4">' . htmlspecialchars(formatValue($existing_record[$field_data]));
                                    echo "<button type='button' class='clear-btn' data-field='$field_data'>X</button>";
                                    echo    '</td>';
                                    } else {        
                                echo "<td colspan='4'><select class='enum' name='{$field_name}_{$time}'>";
                                include 'enum-on-off.php'; 
                                echo "</select></td>";
                                    }
                            }                            
                        } else if ($name === "Warming Up") {
                            foreach ($times as $time) {
                                $field_data = "{$field_name}_$time";
                                if ($existing_record && isset($existing_record[$field_data])) {
                                    echo '<td colspan="4">' . htmlspecialchars(formatValue($existing_record[$field_data]));
                                    echo "<button type='button' class='clear-btn' data-field='$field_data'>X</button>";
                                    echo    '</td>';
                                    } else {        
                                echo "<td colspan='4'><select class='enum' name='{$field_name}_{$time}'>";
                                include 'enum-yes-no.php'; 
                                echo "</select></td>";
                                    }
                            }                        
                        } else {
                            for ($i = 8; $i <= 22; $i += 2) {
                                $field_key = "{$field_name}_$i";
                                $field_data = isset($existing_record[$field_key]) ? htmlspecialchars($existing_record[$field_key]) : '';                
                                if ($field_data !== '') {
                                    echo '<td>' . htmlspecialchars(formatValue($field_data));
                                    echo "<button type='button' class='clear-btn' data-field='{$field_name}_$i'>X</button>";
                                    echo    '</td>';
                                    } else {                          
                                echo "<td><input type='number' step='0.01' class='input-field' name='{$field_name}_$i'></td>";
                                    }
                            }
                            for ($i = 0; $i <= 6; $i += 2) {
                                $field_key = "{$field_name}_$i";
                                $field_data = isset($existing_record[$field_key]) ? htmlspecialchars($existing_record[$field_key]) : '';                
                                if ($field_data !== '') {
                                    echo '<td>' . htmlspecialchars(formatValue($field_data));
                                    echo "<button type='button' class='clear-btn' data-field='{$field_name}_$i'>X</button>";
                                    echo    '</td>';
                                    } else {                           
                                echo "<td><input type='number' step='0.01' class='input-field' name='{$field_name}_$i'></td>";
                                    }
                            }
                        }
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
            </table>
        <br>
        <button class="btn">SAVE</button>
    </form>
</main>
<script>
    document.getElementById("exit").onclick=function (){
    location.href = 'selection.php'
    }
    $(document).ready(function() {
        $(".enum").prop("selectedIndex", -1);
    });

    $(document).ready(function() {
        $('.clear-btn').click(function() {
            var fieldToClear = $(this).data('field');
            var confirmed = confirm('Are you sure you want to clear this field?');

            if (confirmed) {
                // Send an AJAX request to update the field to NULL
                $.ajax({
                    url: 'clear_field.php',
                    method: 'POST',
                    data: {
                        field_to_clear: fieldToClear,
                        unit: '<?php echo $unit; ?>' // Pass the unit parameter
                    },
                    success: function(response) {
                        // Reload the page after clearing the field
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
</body>
</html>