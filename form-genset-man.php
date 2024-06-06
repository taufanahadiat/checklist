<?php
$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string
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
    <?php include 'header.php'?>
<main>
    
<h2>Genset Man</h2>
    <table>
        <thead>
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
    </thead>
    <form method="post">
            <tbody>
                <?php
                require 'database.php';
                $sql_select = "SELECT * FROM $unit WHERE tanggal = CURDATE()";
                $result_select = mysqli_query($conn, $sql_select);
                if (!$result_select) {
                    die("Query failed: " . mysqli_error($conn));
                }                
                $existing_record = mysqli_fetch_assoc($result_select);
                $time_ranges = array('8_14', '16_22', '0_6');
                $times = array('8', '10', '12', '14', '16', '18', '20', '22', '0', '2', '4', '6');

                ?>
                <tr>
                <th class="measure">Running Hours</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">Hour</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            $field_name = "running_hours_$range";

                            if ($existing_record && isset($existing_record[$field_name])) {
                            echo '<td colspan="4">' . htmlspecialchars($existing_record[$field_name]);
                            echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                            echo    '</td>';
                            } else {
                                echo "<td colspan='4'><input type='number' step='0.01' class='input-field' name='$field_name'></td>";
                            }
                        }                    
                    ?>
                </tr>
                <tr>
                    <th class="measure">Breaker Position</th> 
                    <th class="parameter">-</th>
                    <th class="parameter-setting">On</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            $field_name = "breaker_position_$range";

                            if ($existing_record && isset($existing_record[$field_name])) {
                            echo '<td colspan="4">' . htmlspecialchars($existing_record[$field_name]);
                            echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                            echo    '</td>';

                            } else {
                                echo "<td colspan='4'>";
                                echo "<select class='enum' name='$field_name'>";
                                include 'enum-on-off.php';
                                echo "</select></td>";
                            }
                        }
                    ?>
                </tr>
                <tr>  
                    <th class="measure">Energy Switch Position</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">Off</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            $field_name = "energy_switch_$range";

                            if ($existing_record && isset($existing_record[$field_name])) {
                            echo '<td colspan="4">' . htmlspecialchars($existing_record[$field_name]);
                            echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                            echo    '</td>';
                            } else {
                                echo "<td colspan='4'>";
                                echo "<select class='enum' name='$field_name'>";
                                include 'enum-on-off.php';
                                echo "</select>";
                            echo "</td>";
                            }
                        }                   
                    ?>
                </tr>
                <tr>
                    <th class="measure">Switch Mode</th> 
                    <th class="parameter">-</th>
                    <th class="parameter-setting">Auto</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            $field_name = "switch_mode_$range";

                            if ($existing_record && isset($existing_record[$field_name])) {
                                echo '<td colspan="4">' . htmlspecialchars($existing_record[$field_name]);
                                echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                                echo    '</td>';
                                } else {
                                    echo "<td colspan='4'>";
                                    echo "<select class='enum' name='$field_name'>";
                                    include 'enum-auto-manual.php';
                                    echo "</select></td>";
                                }
                        }
                    ?>
                </tr>
                <tr>  
                    <th class="measure">Warming Up</th>
                    <th class="parameter">2~3</th>
                    <th class="parameter-setting">Week</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            $field_name = "warming_up_$range";

                            if ($existing_record && isset($existing_record[$field_name])) {
                            echo '<td colspan="4">' . htmlspecialchars($existing_record[$field_name]);
                            echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                            echo    '</td>';
                            } else {
                                echo "<td colspan='4'>";
                                echo "<select class='enum' name='$field_name'>";
                                include 'enum-yes-no.php';
                                echo "</select>";
                            echo "</td>";
                            }
                        }                   
                    ?>
                </tr>
                <tr>  
                    <th class="measure">Voltage Battery</th>
                    <th class="parameter">>24</th>
                    <th class="parameter-setting">Volt</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "voltage_battery_$time";

                            if ($existing_record && isset($existing_record[$field_name])) {
                            echo '<td>' . htmlspecialchars($existing_record[$field_name]);
                            echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                            echo    '</td>';
                            } else {
                                echo "<td><input type='number' step='0.01' class='input-field' name='$field_name'></td>";
                            }
                        }                   
                    ?>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Fuel</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "kebocoran_fuel_$time";

                            if ($existing_record && isset($existing_record[$field_name])) {
                            echo '<td>' . htmlspecialchars($existing_record[$field_name]);
                            echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                            echo    '</td>';

                            } else {
                                echo "<td>";
                                echo "<select class='enum' name='$field_name'>";
                                include 'enum-kebocoran.php';
                                echo "</select></td>";
                            }
                        }
                    ?>
                </tr>
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
        $(".enum").prop("selectedIndex", -1);
        $(".input-field").val('');

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